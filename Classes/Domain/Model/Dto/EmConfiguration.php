<?php
namespace Aijko\AijkoGeoip\Domain\Model\Dto;

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
 * Class EmConfiguration
 *
 * @package Aijko\AijkoGeoip\Domain\Model\Dto
 */
class EmConfiguration extends \Aijko\AijkoDefault\Domain\Model\Dto\AbstractEmConfiguration {

	/**
	 * Fill the properties properly
	 *
	 * @param array $configuration em configuration
	 */
	public function __construct(array $configuration) {
		parent::__construct($configuration, __CLASS__);
	}

	/**
	 * @var string
	 */
	protected $databaseFilePath = '';

	/**
	 * @param string $databaseFilePath
	 */
	public function setDatabaseFilePath($databaseFilePath) {
		$this->databaseFilePath = $databaseFilePath;
	}

	/**
	 * @return string
	 */
	public function getDatabaseFilePath() {
		return $this->databaseFilePath;
	}

}