<?php

namespace AppBundle\Entity;

use AppBundle\Entity\UserInformation;

/**
 * User
 */
class User
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $email;

    public function __consctruct(){
        $this->accountType = "local";
        return $this;
    }


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
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = md5($password);

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    private $userInformation;

    /**
     * @var string
     */
    private $idExt;

    /**
     * @var string
     */
    private $accountType;


    /**
     * Set idExt
     *
     * @param string $idExt
     *
     * @return User
     */
    public function setIdExt($idExt)
    {
        $this->idExt = $idExt;

        return $this;
    }

    /**
     * Get idExt
     *
     * @return string
     */
    public function getIdExt()
    {
        return $this->idExt;
    }

    /**
     * Set accountType
     *
     * @param string $accountType
     *
     * @return User
     */
    public function setAccountType($accountType)
    {
        $this->accountType = $accountType;

        return $this;
    }

    /**
     * Get accountType
     *
     * @return string
     */
    public function getAccountType()
    {
        return $this->accountType;
    }

    /**
     * Set userInformation
     *
     * @param \AppBundle\Entity\User $userInformation
     *
     * @return User
     */
    public function setUserInformation(\AppBundle\Entity\User $userInformation = null)
    {
        $this->userInformation = $userInformation;

        return $this;
    }

    /**
     * Get userInformation
     *
     * @return \AppBundle\Entity\User
     */
    public function getUserInformation()
    {
        return $this->userInformation;
    }
    /**
     * @var string
     */
    private $token;


    /**
     * Set token
     *
     * @param string $token
     *
     * @return User
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get token
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }
}
