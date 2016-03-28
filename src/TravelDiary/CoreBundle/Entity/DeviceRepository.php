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

}