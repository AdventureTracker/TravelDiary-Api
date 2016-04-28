<?php
/**
 * Created by PhpStorm.
 * User: jdubec
 * Date: 05/04/16
 * Time: 13:06
 */

namespace TravelDiary\InterfaceBundle\Twig;


use CrEOF\Spatial\PHP\Types\Geometry\Point;
use Predis\Client;
use TravelDiary\InterfaceBundle\Helpers\PointHelper;

class GoogleMapsExtension extends \Twig_Extension{

	/**
	 * Google browser API key
	 * @var string
	 */
	private $apiKey;

	/**
	 * @var Client
	 */
	private $redis;

	/**
	 * GoogleMapsExtension constructor.
	 * @param string $apiKey
	 * @param Client $redis
	 */
	public function __construct($apiKey, Client $redis) {
		$this->apiKey = $apiKey;
		$this->redis = $redis;
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

		$redisKey = sprintf("geolocation:%s", PointHelper::createHasForPoint($point));

		if (!$this->redis->exists($redisKey)) {
			$address = PointHelper::pointToAddressFromGoogle($point, $result_type, $this->apiKey);
			$this->redis->set($redisKey, $address);
		}
		else {
			$address = $this->redis->get($redisKey);
		}

		return $address;

	}
}