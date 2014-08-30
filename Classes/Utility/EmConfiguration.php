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
 * Extension Manager Configuration Class
 *
 * @package Aijko\AijkoGeoip\Utility\Backend
 */
class EmConfiguration {

	/**
	 * Get the extension manager configuration
	 *
	 * The dataTransferObject (DTO) must be place in the same extension in the following file and directory
	 * 		Classes/Domain/Model/Dto/EmConfiguration.php
	 *
	 * Example call:
	 * $extensionConfiguration = \Aijko\AijkoGeoip\Utility\EmConfiguration::getConfiguration('EXTKEY', '\Aijko\ExtKey\Domain\Model\Dto\EmConfiguration');
	 *
	 * @param string $extKey
	 * @param object $dataTransferObject
	 * @return array | object
	 */
	public static function getConfiguration($extKey, $dataTransferObject = NULL) {
		if (!isset($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$extKey])) {
			return array();
		}

		$configuration = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$extKey]);
		if (!is_array($configuration)) {
			return array();
		}

		if (NULL !== $dataTransferObject) {
			\TYPO3\CMS\Core\Utility\GeneralUtility::requireOnce(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($extKey) . 'Classes/Domain/Model/Dto/EmConfiguration.php');
			$configuration = new $dataTransferObject($configuration);
		}

		return $configuration;
	}

}
