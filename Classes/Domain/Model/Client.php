<?php
namespace Aijko\AijkoGeoip\Domain\Model;

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

/**
 * Class Client
 *
 * @package Aijko\AijkoGeoip\Domain\Model
 */
class Client extends \Aijko\AijkoGeoip\Domain\Model\AbstractEntity {

	/**
	 * @var \Aijko\AijkoGeoip\Domain\Model\City
	 */
	protected $city = NULL;

	/**
	 * @var \Aijko\AijkoGeoip\Domain\Model\Country
	 */
	protected $country = NULL;

	/**
	 * @var \Aijko\AijkoGeoip\Domain\Model\Continent
	 */
	protected $continent = NULL;

	/**
	 * @var float
	 */
	protected $latitude = 0.0;

	/**
	 * @var float
	 */
	protected $longitude = 0.0;

	/**
	 * @var string
	 */
	protected $ip = '';

	/**
	 * @param \Aijko\AijkoGeoip\Domain\Model\City $city
	 */
	public function setCity(\Aijko\AijkoGeoip\Domain\Model\City $city) {
		$this->city = $city;
	}

	/**
	 * @return \Aijko\AijkoGeoip\Domain\Model\City
	 */
	public function getCity() {
		return $this->city;
	}

	/**
	 * @param string $ip
	 */
	public function setIp($ip) {
		$this->ip = $ip;
	}

	/**
	 * @return string
	 */
	public function getIp() {
		return $this->ip;
	}

	/**
	 * @param \Aijko\AijkoGeoip\Domain\Model\Continent $continent
	 */
	public function setContinent(\Aijko\AijkoGeoip\Domain\Model\Continent $continent) {
		$this->continent = $continent;
	}

	/**
	 * @return \Aijko\AijkoGeoip\Domain\Model\Continent
	 */
	public function getContinent() {
		return $this->continent;
	}

	/**
	 * @param \Aijko\AijkoGeoip\Domain\Model\Country $country
	 */
	public function setCountry(\Aijko\AijkoGeoip\Domain\Model\Country $country) {
		$this->country = $country;
	}

	/**
	 * @return \Aijko\AijkoGeoip\Domain\Model\Country
	 */
	public function getCountry() {
		return $this->country;
	}

	/**
	 * @param float $latitude
	 */
	public function setLatitude($latitude) {
		$this->latitude = $latitude;
	}

	/**
	 * @return float
	 */
	public function getLatitude() {
		return $this->latitude;
	}

	/**
	 * @param float $longitude
	 */
	public function setLongitude($longitude) {
		$this->longitude = $longitude;
	}

	/**
	 * @return float
	 */
	public function getLongitude() {
		return $this->longitude;
	}

}
