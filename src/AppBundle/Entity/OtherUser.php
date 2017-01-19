<?php

namespace AppBundle\Entity;

/**
 * OtherUser
 */
class OtherUser
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $mail;

    /**
     * @var string
     */
    private $idExt;


    /**
    *@param string $mail
    *@param string $idExt
    */
    public function __construct(string $mail, string $idExt){
        $this->mail = $mail;
        $this->idExt = $idExt;
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
     * Set mail
     *
     * @param string $mail
     *
     * @return OtherUser
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set idExt
     *
     * @param string $idExt
     *
     * @return OtherUser
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
}

