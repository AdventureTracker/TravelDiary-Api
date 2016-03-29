<?php
/**
 * Created by PhpStorm.
 * User: jakub
 * Date: 28.03.2016
 * Time: 23:00
 */

namespace TravelDiary\CoreBundle\Entity;


abstract class ApiEntity {

	protected $required_fields = [];

	abstract function toArray();

	/**
	 * @param ApiEntity[] $entities
	 * @return array
	 */
	public static function prepare(array $entities) {

		$result = [];

		foreach ($entities as $entity) {
			$result[] = $entity->toArray();
		}

		return $result;
	}

	/**
	 * Return array of required fields in API request
	 * @return array
	 */
	public function getRequiredFields() {
		return $this->required_fields;
	}

}