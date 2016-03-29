<?php
/**
 * Created by PhpStorm.
 * User: jakub
 * Date: 29.03.2016
 * Time: 14:02
 */

namespace TravelDiary\ApiBundle\Helper;


use Symfony\Component\HttpFoundation\Request;
use TravelDiary\CoreBundle\Entity\ApiEntity;

abstract class ApiRequestProcessor {

	/**
	 * @param Request $request
	 * @return array
	 */
	public static function requestBodyToArray(Request $request) {

		if (!(($request->getMethod() == Request::METHOD_POST) || ($request->getMethod() == Request::METHOD_PUT)))
			return [];

		if ($request->headers->get('Content-Type') != 'application/json')
			return [];

		return json_decode($request->getContent(), true);

	}

	public static function validateArrayBody(array $data, ApiEntity $entity) {
		$missingFields 					= [];

		foreach ($entity->getRequiredFields() as $requiredField) {
			if (!array_key_exists($requiredField, $data))
				$missingFields[] 		= $requiredField;
		}

		return $missingFields;
	}

}