<?php
/**
 * Created by PhpStorm.
 * User: jakub
 * Date: 24.03.2016
 * Time: 11:44
 */

namespace TravelDiary\CoreBundle\Entity;


use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository {

	public function countUsers() {
		$query = $this->getEntityManager()->createQueryBuilder();
		$query->select("COUNT(u)");
		$query->from("TravelDiaryCoreBundle:User", 'u');
		return $query->getQuery()->getScalarResult();
	}

}