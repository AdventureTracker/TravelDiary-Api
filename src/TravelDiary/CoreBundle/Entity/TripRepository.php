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

	public function getTripByUser(User $user, $uuid) {
		$query = $this->getEntityManager()->createQueryBuilder();
		$query->select("t");
		$query->from("TravelDiaryCoreBundle:Trip", "t");
		$query->where("t.trpUUID = :uuid");
		$query->setParameter("uuid", $uuid);
		$query->andWhere(":idUser MEMBER OF t.users");
		$query->setParameter(":idUser", $user);
		return $query->getQuery()->getSingleResult();
	}
	
	public function countTrips() {
		$query = $this->getEntityManager()->createQueryBuilder();
		$query->select("COUNT(t)");
		$query->from("TravelDiaryCoreBundle:Trip", 't');
		return $query->getQuery()->getSingleScalarResult();
	}

	public function getTripsByUserPaginated(User $user, $page, $limit) {
		$query = $this->getEntityManager()->createQueryBuilder();
		$query->select("trip");
		$query->from("TravelDiaryCoreBundle:Trip", "trip");
		$query->where(":idUser MEMBER OF trip.users");
		$query->setParameter("idUser", $user);
		$query->orderBy("trip.trpCreatedAt", "DESC");
		$query->setFirstResult($page - 1);
		$query->setMaxResults($limit);
		return $query->getQuery()->getResult();
	}

}