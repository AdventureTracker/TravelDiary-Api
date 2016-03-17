<?php

namespace TravelDiary\CoreBundle\Entity;

/**
 * Role
 */
class Role
{
    /**
     * @var integer
     */
    private $idRole;

    /**
     * @var string
     */
    private $rolName = '0';


    /**
     * Get idRole
     *
     * @return integer
     */
    public function getIdRole()
    {
        return $this->idRole;
    }

    /**
     * Set rolName
     *
     * @param string $rolName
     *
     * @return Role
     */
    public function setRolName($rolName)
    {
        $this->rolName = $rolName;

        return $this;
    }

    /**
     * Get rolName
     *
     * @return string
     */
    public function getRolName()
    {
        return $this->rolName;
    }
}

