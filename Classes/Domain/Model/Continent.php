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
 * GeoIP2 Continent
 *
 * @package Aijko\AijkoGeoip\Domain\Model
 */
class Continent extends \Aijko\AijkoGeoip\Domain\Model\AbstractEntity {

	/**
	 * @var string
	 */
	protected $continentCode = '';

	/**
	 * @var string
	 */
	protected $continentName = '';

	/**
	 * @param string $continentCode
	 */
	public function setContinentCode($continentCode) {
		$this->continentCode = $continentCode;
	}

	/**
	 * @return string
	 */
	public function getContinentCode() {
		return $this->continentCode;
	}

	/**
	 * @param string $continentName
	 */
	public function setContinentName($continentName) {
		$this->continentName = $continentName;
	}

	/**
	 * @return string
	 */
	public function getContinentName() {
		return $this->continentName;
	}

}
