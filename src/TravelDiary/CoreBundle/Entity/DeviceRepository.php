<?php
/**
 * Created by PhpStorm.
 * User: jakub
 * Date: 28.03.2016
 * Time: 19:25
 */

namespace TravelDiary\CoreBundle\Entity;


use Doctrine\ORM\EntityRepository;

class DeviceRepository extends EntityRepository {

	public function findByUser(User $user, $uuid) {
		$query = $this->getEntityManager()->createQueryBuilder();
		$query->select("device");
		$query->from("TravelDiaryCoreBundle:Device", "device");
		$query->where("device.devUUID = :uuid");
		$query->setParameter("uuid", $uuid);
		$query->andWhere("device.idUser = :user");
		$query->setParameter("user", $user);
		return $query->getQuery()->getSingleResult();
	}

	public function getDevicesByUserPaginated(User $user, $page, $limit) {

		$query = $this->getEntityManager()->createQueryBuilder();
		$query->select("device");
		$query->from("TravelDiaryCoreBundle:Device", 'device');
		$query->where("device.idUser = :user");
		$query->setParameter("user", $user);
		$query->setFirstResult(($page - 1) * $limit);
		$query->setMaxResults($limit);
		$query->orderBy('device.devLastActivity', 'DESC');
		return $query->getQuery()->getResult();

	}

	public function getDevicesByUserPaginatedCount(User $user, $page, $limit) {

		$query = $this->getEntityManager()->createQueryBuilder();
		$query->select("COUNT(device)");
		$query->from("TravelDiaryCoreBundle:Device", 'device');
		$query->where("device.idUser = :user");
		$query->setParameter("user", $user);
		$query->setFirstResult(($page - 1) * $limit);
		$query->setMaxResults($limit);
		return $query->getQuery()->getSingleScalarResult();

	}

}