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
 * GeoIP2 City
 *
 * @package Aijko\AijkoGeoip\Domain\Model
 */
class City extends \Aijko\AijkoGeoip\Domain\Model\Country {

	/**
	 * @var string
	 */
	protected $cityName;

	/**
	 * @var string
	 */
	protected $mostSpecificSubdivisionCityName;

	/**
	 * @var string
	 */
	protected $zip;

	/**
	 * @var float
	 */
	protected $latitude = 0.0;

	/**
	 * @var float
	 */
	protected $longitude = 0.0;

	/**
	 * @return string
	 */
	public function getAsJson() {
		$returnJson = parent::getAsJson(__CLASS__);
		return $returnJson;
	}

	/**
	 * @param string $cityName
	 */
	public function setCityName($cityName) {
		$this->cityName = $cityName;
	}

	/**
	 * @return string
	 */
	public function getCityName() {
		return $this->cityName;
	}

	/**
	 * @param mixed $mostSpecificSubdivisionCityName
	 */
	public function setMostSpecificSubdivisionCityName($mostSpecificSubdivisionCityName) {
		$this->mostSpecificSubdivisionCityName = $mostSpecificSubdivisionCityName;
	}

	/**
	 * @return mixed
	 */
	public function getMostSpecificSubdivisionCityName() {
		return $this->mostSpecificSubdivisionCityName;
	}

	/**
	 * @param string $zip
	 */
	public function setZip($zip) {
		$this->zip = $zip;
	}

	/**
	 * @return string
	 */
	public function getZip() {
		return $this->zip;
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