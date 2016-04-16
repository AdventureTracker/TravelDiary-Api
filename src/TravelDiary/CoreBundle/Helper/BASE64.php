<?php
/**
 * Created by PhpStorm.
 * User: jdubec
 * Date: 15/04/16
 * Time: 17:32
 */

namespace TravelDiary\CoreBundle\Helper;


abstract class BASE64
{

	/**
	 * @param string $filename
	 * @param string $mime
	 * @return string
	 */
	public static function encodeFile(string $filename, string $mime) : string {

		$img = fread(fopen($filename, "r"), filesize($filename));
		return 'data:' . $mime . ';base64,' . base64_encode($img);

	}
}