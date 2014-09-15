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

use \TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class AbstractEntity
 *
 * @package Aijko\AijkoGeoip\Domain\Model
 */
abstract class AbstractEntity {

	/**
	 * @var int
	 */
	protected $code = 0;

	/**
	 * @var string
	 */
	protected $errorMessage = '';

	/**
	 * @var \TYPO3\CMS\Extbase\Object\ObjectManagerInterface
	 */
	protected $objectManager;

	/**
	 * @var array
	 */
	protected $configuration = array();

	/**
	 * Constructor
	 */
	public function __construct(array $configuration = array()) {
		$this->objectManager = GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager');
		if (!count($configuration)) {
			// Get configuration
			$configurationManager = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Configuration\\ConfigurationManager');
			$typoscriptConfiguration = $configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FULL_TYPOSCRIPT);
			$configuration = $typoscriptConfiguration['plugin.']['tx_aijkogeoip.']['settings.'];
			$configuration = \TYPO3\CMS\Core\Utility\GeneralUtility::removeDotsFromTS($configuration);
		}

		$this->configuration = $configuration;
	}

	/**
	 * @param string $errorMessage
	 */
	public function setErrorMessage($errorMessage) {
		$this->errorMessage = $errorMessage;
	}

	/**
	 * @return string
	 */
	public function getErrorMessage() {
		return $this->errorMessage;
	}

	/**
	 * @param int $code
	 */
	public function setCode($code) {
		$this->code = $code;
	}

	/**
	 * @return int
	 */
	public function getCode() {
		return $this->code;
	}

}