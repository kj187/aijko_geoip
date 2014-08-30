<?php
namespace Aijko\AijkoGeoip\Utility;

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
 * Class CurrencyUtility
 *
 * @package Aijko\AijkoGeoip\Utility
 */
class CurrencyUtility {

	/**
	 * @var array
	 */
	protected static $mapping = array(
		// ISO3166 => CurrencyCode

		// EuroZone http://de.wikipedia.org/wiki/Eurozone
		'BE' => 'EUR',
		'DE' => 'EUR',
		'EE' => 'EUR',
		'FI' => 'EUR',
		'FR' => 'EUR',
		'GR' => 'EUR',
		'IE' => 'EUR',
		'IT' => 'EUR',
		'LU' => 'EUR',
		'LV' => 'EUR',
		'NL' => 'EUR',
		'MT' => 'EUR',
		'AT' => 'EUR',
		'PT' => 'EUR',
		'SK' => 'EUR',
		'SI' => 'EUR',
		'ES' => 'EUR',
		'CY' => 'EUR',

		'CH' => 'CHF',
		'US' => 'USD',
	);

	/**
	 * @param string $countryCode
	 * @return string
	 */
	public static function getCurrency($countryCode = 'US') {
		if(isset(self::$mapping[$countryCode])) {
			return self::$mapping[$countryCode];
		}

		return 'USD'; // Default to USD
	}

}