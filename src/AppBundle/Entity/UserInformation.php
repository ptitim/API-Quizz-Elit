<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
    * @var int
    */
    private $socket;

    /**
    * @var boolean
    */
    private $playing;


    private $friendsList;

    public function __construct(int $idUser){
        $this->idUser = $idUser;
        $this->playing = false;
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

    /**
    *Get socket
    *
    *@return int
    */
    public function getSocket(){
        return $this->socket;
    }

    /**
    *Set socket
    *
    *@param int $socket
    *
    *@return UserInformation
    */
    public function setSocket($socket){
        $this->socket = $socket;
        return $this;
    }

    /**
    *Set playing
    *@param bool $playing
    *@return UserInformation
    *
    */
    public function setPlaying($playing){
        if(gettype($playing) == "bool"){
            $this->playing = $playing;
            return $this;
        }else{
            return $this;
        }
    }

    /**
    *Get playing
    *@return bool
    */
    public function getPlaying(){
        return $this->playing;
    }


    public function getFriendslist(){
        return $this->friendsList;
    }

}

