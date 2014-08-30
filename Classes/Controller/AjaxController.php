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
	 * Deliver a json object which includes all information about the users city, country, continent and currency
	 *
	 * @param string $content
	 * @param array $configuration
	 * @return string
	 */
	public function jsonAction($content = '', array $configuration) {
		$clientIp = (isset($configuration['clientIp']) ? $configuration['clientIp'] : '');
		$client = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('Aijko\\AijkoGeoip\\Service\\Client', $clientIp);
		return $client->getAsJson();
	}

}