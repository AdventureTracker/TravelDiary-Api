<?php
/**
 * Created by PhpStorm.
 * User: jdubec
 * Date: 19/04/16
 * Time: 16:15
 */

namespace TravelDiary\InterfaceBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BaseController extends Controller
{

	protected $apiClient = null;
	private $apiClientFactory = null;

	/**
	 * @return null
	 */
	public function getApiClient()
	{

		if ($this->apiClientFactory = null) {
//			$this->apiClientFactory = new \ApiClientFactory($this->getParameter("api_url"), $this->getUser(),) 
		}

		return $this->apiClient;
	}

}