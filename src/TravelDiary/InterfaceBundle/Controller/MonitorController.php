<?php

namespace TravelDiary\InterfaceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MonitorController extends Controller {
	public function overviewAction() {

		$begin = new \DateTime();
		$begin->modify("-6 day");
		$end = new \DateTime();
		$end->modify("+1 day");
		$interval = new \DateInterval('P1D');

		$daterange = new \DatePeriod($begin, $interval ,$end);

		$stats = [];

		/** @var \DateTime $day */
		foreach ($daterange as $day) {
			$key = sprintf("api_requests:%s", $day->format("Y-m-d"));
			$stats[$day->format('Y-m-d')] = $this->get('snc_redis.cache')->llen($key);

		}

		$lastRequests = [];
		$key = sprintf("api_requests:%s", date("Y-m-d"));

		foreach ($this->get('snc_redis.cache')->lrange($key, 0, 19) as $request) {
			$lastRequests[] = json_decode($request, true);
		}

		return $this->render('TravelDiaryInterfaceBundle:Monitor:overview.html.twig', array(
			'stats' => $stats,
			'lastRequests' => $lastRequests
		));
	}

}
