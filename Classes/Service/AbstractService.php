<?php
namespace Aijko\AijkoGeoip\Service;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 AIJKO GmbH <info@aijko.com>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

require_once \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('aijko_geoip') . 'Resources/Private/Php/vendor/autoload.php';
use \TYPO3\CMS\Core\Utility\GeneralUtility;
use GeoIp2\Database\Reader;

/**
 * GeoIp Service based on Maxminds databases
 *
 * @package Aijko\AijkoGeoip\Service
 */
class AbstractService {

	/**
	 * @var \GeoIp2\Database\Reader|NULL
	 */
	protected $reader = NULL;

	/**
	 * @var string
	 */
	protected $clientIp = '';

	/**
	 * @var array
	 */
	protected $extensionConfiguration = array();

	/**
	 * Constructor
	 *
	 * @param string $clientIp
	 * @throws \InvalidArgumentException|\UnexpectedValueException
	 */
	public function __construct($clientIp = '') {
		$extensionConfiguration = \Aijko\AijkoDefault\Utility\EmConfiguration::getConfiguration('aijko_geoip', '\Aijko\AijkoGeoip\Domain\Model\Dto\EmConfiguration');
		if (!$extensionConfiguration->getDatabaseFilePath()) {
			throw new \UnexpectedValueException('You must set a path to the database file in the extension managaer', 1409315403);
		}

		try {
			$this->reader = new Reader($extensionConfiguration->getDatabaseFilePath());
		} catch(\InvalidArgumentException $exception) {
			throw new \InvalidArgumentException($exception->getMessage(), 1409315902);
		} catch(\UnexpectedValueException $exception) {
			throw new \UnexpectedValueException($exception->getMessage(), 1409315903);
		}

		$this->setClientIp($clientIp);
	}

	/**
	 * @param string $clientIp
	 * @return void
	 * @throws \UnexpectedValueException
	 */
	public function setClientIp($clientIp) {
		if ('' === $clientIp) {
			$remoteAddress = GeneralUtility::makeInstance('Aijko\\AijkoGeoip\\Service\\RemoteAddress');
			$clientIp = $remoteAddress->getIpAddress();
		}

		$clientIp = filter_var($clientIp, FILTER_VALIDATE_IP);
		if ($clientIp === FALSE) {
			throw new \UnexpectedValueException('Your ip address is not valid', 1409315903);
		}

		$this->clientIp = $clientIp;
	}

}
