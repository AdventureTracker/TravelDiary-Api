<?php
/**
 * Created by PhpStorm.
 * User: jdubec
 * Date: 29/04/16
 * Time: 18:16
 */

namespace TravelDiary\InterfaceBundle\Exception;


class UserInterfaceException extends \Exception{

	private $path;

	/**
	 * UserInterfaceException constructor.
	 * @param string $message
	 * @param string $path
	 */
	public function __construct(string $message, string $path) {
		parent::__construct($message);
		$this->path = $path;
	}

	/**
	 * @return string
	 */
	public function getPath() {
		return $this->path;
	}

}