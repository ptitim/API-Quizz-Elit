<?php

namespace AppBundle\Entity;

/**
 * Question
 */
class Question
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $body;

    /**
     * @var string
     */
    private $reponse;

    /**
     * @var string
     */
    private $catQuestion;

    /**
     * @var string
     */
    private $catReponse;

    /**
     * @var int
     */
    private $popularite;


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
     * Set body
     *
     * @param string $body
     *
     * @return Question
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set reponse
     *
     * @param string $reponse
     *
     * @return Question
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
     * Set catQuestion
     *
     * @param string $catQuestion
     *
     * @return Question
     */
    public function setCatQuestion($catQuestion)
    {
        $this->catQuestion = $catQuestion;

        return $this;
    }

    /**
     * Get catQuestion
     *
     * @return string
     */
    public function getCatQuestion()
    {
        return $this->catQuestion;
    }

    /**
     * Set catReponse
     *
     * @param string $catReponse
     *
     * @return Question
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

    /**
     * Set popularite
     *
     * @param integer $popularite
     *
     * @return Question
     */
    public function setPopularite($popularite)
    {
        $this->popularite = $popularite;

        return $this;
    }

    /**
     * Get popularite
     *
     * @return int
     */
    public function getPopularite()
    {
        return $this->popularite;
    }
}

