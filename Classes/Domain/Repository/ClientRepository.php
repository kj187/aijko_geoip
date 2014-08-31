<?php
namespace Aijko\AijkoGeoip\Domain\Repository;

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
use GeoIp2\Database\Reader;
use \TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class ClientRepository
 *
 * @package Aijko\AijkoGeoip\Domain\Repository
 */
class ClientRepository implements \Aijko\AijkoGeoip\Domain\Repository\ClientRepositoryInterface {

	/**
	 * @var \TYPO3\CMS\Extbase\Object\ObjectManagerInterface
	 */
	protected $objectManager;

	/**
	 * @var \GeoIp2\Database\Reader|NULL
	 */
	protected $reader = NULL;

	/**
	 * @throws \InvalidArgumentException|\UnexpectedValueException
	 */
	public function __construct() {
		$this->objectManager = GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager');
		$extensionConfiguration = \Aijko\AijkoGeoip\Utility\EmConfiguration::getConfiguration('aijko_geoip', '\Aijko\AijkoGeoip\Domain\Model\Dto\EmConfiguration');
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
	}

	/**
	 * @param string $clientIp
	 * @return \Aijko\AijkoGeoip\Domain\Model\Client|NULL
	 */
	public function findByClientIp($clientIp) {
		$record = $this->reader->city($clientIp);
		if (NULL === $record) {
			return NULL;
		}

		return $this->buildClientObject($record, $clientIp);
	}

	/**
	 * @param \GeoIp2\Model\AbstractModel $geoIp
	 * @param string $clientIp
	 * @return \Aijko\AijkoGeoip\Domain\Model\Client
	 */
	protected function buildClientObject(\GeoIp2\Model\AbstractModel $geoIp, $clientIp) {
		// Continent
		$continent = $this->objectManager->get('Aijko\\AijkoGeoip\\Domain\\Model\\Continent');
		$continent->setCode($geoIp->continent->code);
		$continent->setName($geoIp->continent->name);

		// Country
		$country = $this->objectManager->get('Aijko\\AijkoGeoip\\Domain\\Model\\Country');
		$country->setName($geoIp->country->name);
		$country->setTranslations($geoIp->country->names);
		$country->setIsoCode($geoIp->country->isoCode);
		$country->setDefaultCurrency('USD'); // TODO typoscript
		$country->setCurrency();

		// City
		$city = $this->objectManager->get('Aijko\\AijkoGeoip\\Domain\\Model\\City');
		$city->setName($geoIp->city->name);
		$city->setMostSpecificSubdivisionName($geoIp->mostSpecificSubdivision->name);
		$city->setZip($geoIp->postal->code);

		// Client
		$client = $this->objectManager->get('Aijko\\AijkoGeoip\\Domain\\Model\\Client');
		$client->setIp($clientIp);
		$client->setCity($city);
		$client->setCountry($country);
		$client->setContinent($continent);
		$client->setLatitude($geoIp->location->latitude);
		$client->setLongitude($geoIp->location->longitude);

		return $client;
	}

}