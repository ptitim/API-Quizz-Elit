<?php

namespace AppBundle\Entity;

/**
 * Reponse
 */
class Reponse
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $reponse;

    /**
     * @var string
     */
    private $catReponse;


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
     * Set reponse
     *
     * @param string $reponse
     *
     * @return Reponse
     */
    public function setReponse($reponse)
    {
        $this->reponse = $reponse;

        return $this;
    }

    /**
     * Get reponse
     *
     * @return string
     */
    public function getReponse()
    {
        return $this->reponse;
    }

    /**
     * Set catReponse
     *
     * @param string $catReponse
     *
     * @return Reponse
     */
    public function setCatReponse($catReponse)
    {
        $this->catReponse = $catReponse;

        return $this;
    }

    /**
     * Get catReponse
     *
     * @return string
     */
    public function getCatReponse()
    {
        return $this->catReponse;
    }
}

