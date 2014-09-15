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

use \TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * GeoIp Service Client
 *
 * @package Aijko\AijkoGeoip\Service
 */
class Client {

	/**
	 * @var \TYPO3\CMS\Extbase\Object\ObjectManagerInterface
	 */
	protected $objectManager;

	/**
	 * @var \Aijko\AijkoGeoip\Domain\Repository\ClientRepository
	 */
	protected $clientRepository = NULL;

	/**
	 * @var \Aijko\AijkoGeoip\Domain\Model\Client
	 */
	protected $client = NULL;

	/**
	 * @var string
	 */
	protected $clientIp = '';

	/**
	 * @param string $clientIp
	 * @return \Aijko\AijkoGeoIp\Service\Client|NULL
	 * @throws \InvalidArgumentException
	 */
	public function __construct($clientIp = '') {
		$this->objectManager = GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager');
		$this->clientRepository = $this->objectManager->get('Aijko\\AijkoGeoip\\Domain\\Repository\\ClientRepositoryInterface');
		$this->setClientIp($clientIp);

		try {
			$this->client = $this->clientRepository->findByClientIp($this->clientIp);
		} catch (\Exception $exception) {
			$this->client = $this->objectManager->get('Aijko\\AijkoGeoip\\Domain\\Model\\Client');
			$this->client->setCode($exception->getCode());
			$this->client->setErrorMessage($exception->getMessage());
		}

		return $this;
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

	/**
	 * @return string
	 */
	public function getAsJson() {
		$jsonSerializerUtility = $this->objectManager->get('Aijko\\AijkoGeoip\\Utility\\JsonSerializerUtility');
		$returnValue = $jsonSerializerUtility->serialize($this->client);
		return $returnValue;
	}

}
