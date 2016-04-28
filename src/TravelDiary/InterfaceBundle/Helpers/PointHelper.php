<?php
/**
 * Created by PhpStorm.
 * User: jdubec
 * Date: 29/04/16
 * Time: 00:09
 */

namespace TravelDiary\InterfaceBundle\Helpers;


use CrEOF\Spatial\PHP\Types\Geometry\Point;

abstract class PointHelper {

	public static function createHasForPoint(Point $point) : string {
		return md5(sprintf("%s:%s", $point->getLatitude(), $point->getLongitude()));
	}

	public static function pointToAddressFromGoogle(Point $point, $result_type = 'political', $apiKey) {
		$ch 		= curl_init();
		$url 		= sprintf("https://maps.googleapis.com/maps/api/geocode/json?latlng=%s,%s&key=%s&result_type=%s", (string) $point->getLatitude(), (string) $point->getLongitude(), $apiKey, $result_type);

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		$response = curl_exec($ch);

		$response = json_decode($response, true);

		if (empty($response['results']))
			return null;

		$response = $response['results'][0];

		return array_key_exists('formatted_address', $response) ? $response['formatted_address'] : null;
	}

}