<?php
namespace Aijko\AijkoGeoip\Controller;

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
 * Class AjaxController
 *
 * @package Aijko\AijkoGeoip\Controller
 */
class AjaxController {

	/**
	 * Deliver a json object with all information about the users country, continent and currency
	 *
	 * @return string
	 */
	public function jsonAction() {
		$client = new \Aijko\AijkoGeoip\Service\Client('212.76.202.228'); // AIJKO feste IP
		#$client = new \Aijko\AijkoGeoip\Service\Client('213.144.132.109'); // Fake Schweiz
		#$client = new \Aijko\AijkoGeoip\Service\Client('66.85.131.18'); // Fake USA
		#$client = new \Aijko\AijkoGeoip\Service\Client('219.157.200.18'); // Fake China
		#$client = new \Aijko\AijkoGeoip\Service\Client();
		#$client = new \Aijko\AijkoGeoip\Service\Client('xxxxxxx');
		return $client->getAsJson();
	}

}