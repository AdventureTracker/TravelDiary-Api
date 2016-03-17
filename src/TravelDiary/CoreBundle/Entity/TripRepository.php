<?php
/**
 * Created by PhpStorm.
 * User: jakub
 * Date: 18.03.2016
 * Time: 0:19
 */

namespace TravelDiary\CoreBundle\Entity;


use Doctrine\ORM\EntityRepository;

class TripRepository extends EntityRepository {

	public function getTripByUser(User $user) {
		$query = $this->getEntityManager()->createQueryBuilder();
		$query->select("t");
		$query->from("TravelDiaryCoreBundle:Trip", "t");
		$query->where("t.idUser = :idUser");
		$query->setParameter(":idUser", $user->getIdUser());
		return $query->getQuery()->getResult();
	}

}