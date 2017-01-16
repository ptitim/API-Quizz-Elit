<?php

namespace AppBundle\Entity;

/**
 * Friendlist
 */
class Friendlist
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $idUser;

    /**
     * @var int
     */
    private $idFriend;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set idUser
     *
     * @param integer $idUser
     *
     * @return Friendlist
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get idUser
     *
     * @return int
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set idFriend
     *
     * @param integer $idFriend
     *
     * @return Friendlist
     */
    public function setIdFriend($idFriend)
    {
        $this->idFriend = $idFriend;

        return $this;
    }

    /**
     * Get idFriend
     *
     * @return int
     */
    public function getIdFriend()
    {
        return $this->idFriend;
    }
}

