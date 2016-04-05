<?php
/**
 * Created by PhpStorm.
 * User: jdubec
 * Date: 05/04/16
 * Time: 13:06
 */

namespace TravelDiary\InterfaceBundle\Twig;


use CrEOF\Spatial\PHP\Types\Geometry\Point;

class GoogleMapsExtension extends \Twig_Extension{

	/**
	 * Google browser API key
	 * @var string
	 */
	private $apiKey;

	/**
	 * GoogleMapsExtension constructor.
	 * @param string $apiKey
	 */
	public function __construct($apiKey) {
		$this->apiKey = $apiKey;
	}

	/**
	 * Returns the name of the extension.
	 *
	 * @return string The extension name
	 */
	public function getName() {
		return 'google_maps_extension';
	}

	public function getFunctions() {
		return [
			new \Twig_SimpleFunction('pointToAddress', array($this, 'pointToAddress'))
		];
	}

	/**
	 * @param Point $point
	 * @param string $result_type
	 * @return string
	 */
	public function pointToAddress(Point $point, $result_type = 'political') {
		$ch 		= curl_init();
		$url 		= sprintf("https://maps.googleapis.com/maps/api/geocode/json?latlng=%s,%s&key=%s&result_type=%s", (string) $point->getLatitude(), (string) $point->getLongitude(), $this->apiKey, $result_type);

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