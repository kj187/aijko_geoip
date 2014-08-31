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
 * Serialize a object into JSON
 *
 * @package Aijko\AijkoGeoip\Utility
 */
class JsonSerializerUtility {

	/**
	 * Local cache of a property getters per class - optimize reflection code if the same object appears several times
	 *
	 * @var array
	 */
	private $classPropertyGetters = array();

	/**
	 * @param mixed $object
	 * @return string|FALSE
	 */
	public function serialize($object) {
		return json_encode($this->serializeInternal($object));
	}

	/**
	 * @param mixed $object
	 * @return array
	 */
	private function serializeInternal($object) {
		if (is_array($object)) {
			$result = $this->serializeArray($object);
		} elseif (is_object($object)) {
			$result = $this->serializeObject($object);
		} else {
			$result = $object;
		}

		return $result;
	}

	/**
	 * @param mixed $object
	 * @return \ReflectionClass
	 */
	private function getClassPropertyGetters($object) {
		$className = get_class($object);
		if (!isset($this->classPropertyGetters[$className])) {
			$reflector = new \ReflectionClass($className);
			$properties = $reflector->getProperties(\ReflectionProperty::IS_PUBLIC | \ReflectionProperty::IS_PROTECTED);

			$getters = array();
			foreach ($properties as $property) {
				$name = $property->getName();
				$getter = 'get' . ucfirst($name);

				try {
					$reflector->getMethod($getter);
					$getters[$name] = $getter;
				} catch (\Exception $e) {
					// if no getter for a specific property - ignore it
				}
			}

			$this->classPropertyGetters[$className] = $getters;
		}

		return $this->classPropertyGetters[$className];
	}

	/**
	 * @param mixed $object
	 * @return array
	 */
	private function serializeObject($object) {
		$properties = $this->getClassPropertyGetters($object);

		$data = array();
		foreach ($properties as $name => $property) {
			$data[$name] = $this->serializeInternal($object->$property());
		}

		return $data;
	}

	/**
	 * @param array $array
	 * @return array
	 */
	private function serializeArray(array $array) {
		$result = array();
		foreach ($array as $key => $value) {
			$result[$key] = $this->serializeInternal($value);
		}

		return $result;
	}

}