<?php

namespace AppBundle\Entity;

/**
 * UserInformation
 */
class UserInformation
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
    private $scoreTotal;

    /**
     * @var string
     */
    private $username;

    /**
    *@var int
    */
    private $socket;


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
     * @return UserInformation
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
     * Set scoreTotal
     *
     * @param integer $scoreTotal
     *
     * @return UserInformation
     */
    public function setScoreTotal($scoreTotal)
    {
        $this->scoreTotal = $scoreTotal;

        return $this;
    }

    /**
     * Get scoreTotal
     *
     * @return int
     */
    public function getScoreTotal()
    {
        return $this->scoreTotal;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return UserInformation
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }
}

