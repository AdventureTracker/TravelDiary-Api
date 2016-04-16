<?php
/**
 * Created by PhpStorm.
 * User: jdubec
 * Date: 15/04/16
 * Time: 17:38
 */

namespace TravelDiary\ApiBundle\File;


class ApiUploadedFile
{

	private $mime;
	private $extension;
	private $path;

	public function __construct($base64, $path)
	{
		$data = explode(",", $base64);
		$meta = explode(";", $data[0]);
		$meta = explode(':', $meta[0]);

		$this->mime = $meta[1];
		$this->extension = explode("/", $this->mime);
		$this->extension = $this->extension[1];

		$this->path = $path . '.' . $this->extension;

		$file = fopen($this->path, "w");
		fwrite($file, base64_decode($data[1]));
		fclose($file);
	}

	/**
	 * @return mixed
	 */
	public function getMime()
	{
		return $this->mime;
	}

	/**
	 * @return mixed
	 */
	public function getExtension()
	{
		return $this->extension;
	}

	/**
	 * @return string
	 */
	public function getPath()
	{
		return $this->path;
	}



}