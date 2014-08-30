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
 * GeoIP2 Client
 *
 * @package Aijko\AijkoGeoip\Service
 */
class Client extends \Aijko\AijkoGeoip\Service\AbstractService {

	/**
	 * @var \Aijko\AijkoGeoip\Domain\Model\City
	 */
	protected $record = NULL;

	/**
	 * @param string $clientIp
	 * @return \Aijko\AijkoGeoIp\Service\Client|NULL
	 * @throws \InvalidArgumentException
	 */
	public function __construct($clientIp = '') {
		parent::__construct($clientIp);

		try {
			$city = $this->reader->city($this->clientIp);
		} catch (\InvalidArgumentException $exception) {
			throw new \InvalidArgumentException($exception->getMessage(), 1409315909);
		}

		$this->record = GeneralUtility::makeInstance('Aijko\\AijkoGeoip\\Domain\\Model\\City');
		$this->record->setClientIp($this->clientIp);

		// City
		$this->record->setCityName($city->city->name);
		$this->record->setMostSpecificSubdivisionCityName($city->mostSpecificSubdivision->name);
		$this->record->setZip($city->postal->code);
		$this->record->setLatitude($city->location->latitude);
		$this->record->setLongitude($city->location->longitude);

		// Country
		$this->record->setCountryName($city->country->name);
		$this->record->setCountryNames($city->country->names);
		$this->record->setIsoCode($city->country->isoCode);

		// Continent
		$this->record->setContinentCode($city->continent->code);
		$this->record->setContinentName($city->continent->name);

		return $this;
	}

	/**
	 * @return string
	 */
	public function getAsJson() {
		return $this->record->getAsJson();
	}

}
