<?php
/**
 * Created by PhpStorm.
 * User: jdubec
 * Date: 30/04/16
 * Time: 22:39
 */

namespace TravelDiary\ApiBundle\EventListener;


use Predis\Client;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class RequestListener {

	/** @var  Client */
	private $redis;

	/**
	 * RequestListener constructor.
	 * @param Client $redis
	 */
	public function __construct(Client $redis) {
		$this->redis = $redis;
	}

	public function onKernelRequest(GetResponseEvent $event) {

		if ($event->isPropagationStopped())
			return;

		$subdomain = explode('.', $event->getRequest()->getHost());
		$subdomain = $subdomain[0];

		if ($subdomain != 'api')
			return;

		$key = sprintf("api_requests:%s", date("Y-m-d"));

		$record = [
			'uri' => $event->getRequest()->getRequestUri(),
			'method' => $event->getRequest()->getMethod(),
			'timestamp' => date('c')
		];

		$record = json_encode($record);
		
		$this->redis->lpush($key, [$record]);
	}


}