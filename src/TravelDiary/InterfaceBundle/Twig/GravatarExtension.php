<?php
/**
 * Created by PhpStorm.
 * User: jdubec
 * Date: 03/04/16
 * Time: 15:40
 */

namespace TravelDiary\InterfaceBundle\Twig;

class GravatarExtension extends \Twig_Extension {

	public function getName() {
		return 'gravatar';
	}

	public function getFilters() {
		return array(
			new \Twig_SimpleFilter('gravatar', array($this, 'gravatarImageFilter'))
		);
	}

	public function gravatarImageFilter($email, $size = 60) {
		return 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($email))) . '?s=' . $size;
	}

}