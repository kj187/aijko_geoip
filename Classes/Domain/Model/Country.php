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
 * GeoIP2 Country
 *
 * @package Aijko\AijkoGeoip\Domain\Model
 */
class Country extends \Aijko\AijkoGeoip\Domain\Model\AbstractEntity {

	/**
	 * @var \SJBR\StaticInfoTables\Domain\Repository\CountryRepository
	 */
	protected $countryRepository = NULL;

	/**
	 * @var string
	 */
	protected $name = '';

	/**
	 * @var array
	 */
	protected $translations = '';

	/**
	 * @var string
	 */
	protected $isoCode = '';

	/**
	 * @var string
	 */
	protected $currency = '';

	/**
	 * @var string
	 */
	private $defaultCurrency = '';

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct();
		$this->countryRepository = $this->objectManager->get('SJBR\\StaticInfoTables\\Domain\\Repository\\CountryRepository');
	}

	/**
	 * @return string
	 */
	public function setCurrency() {
		$currency = $this->getDefaultCurrency();
		$staticCountry = $this->countryRepository->findOneByIsoCodeA2($this->getIsoCode());
		if (NULL !== $staticCountry) {
			$currency = $staticCountry->getCurrencyIsoCodeA3();
		}

		$this->currency = strtolower($currency);
	}

	/**
	 * @return string
	 */
	public function getCurrency() {
		return $this->currency;
	}

	/**
	 * @param string $defaultCurrency
	 */
	public function setDefaultCurrency($defaultCurrency) {
		$this->defaultCurrency = strtolower($defaultCurrency);
	}

	/**
	 * @return string
	 */
	public function getDefaultCurrency() {
		return $this->defaultCurrency;
	}

	/**
	 * @param string $isoCode
	 */
	public function setIsoCode($isoCode) {
		$this->isoCode = $isoCode;
	}

	/**
	 * @return string
	 */
	public function getIsoCode() {
		return $this->isoCode;
	}

	/**
	 * @param string $name
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param array $translations
	 */
	public function setTranslations(array $translations) {
		$this->translations = $translations;
	}

	/**
	 * @return array
	 */
	public function getTranslations() {
		return $this->translations;
	}

}
