<?php

namespace San\EventBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Inscription
 *
 * @ORM\Table(name="inscription")
 * @ORM\Entity(repositoryClass="San\EventBundle\Repository\InscriptionRepository")
 */
class Inscription
{
     public function __construct()
    {
        $this->pubDate = new \Datetime();
    }
    /**
   * @ORM\ManyToOne(targetEntity="San\UserBundle\Entity\User", cascade={"persist"})
   */
  private $user;
  
  /**
   * @ORM\ManyToOne(targetEntity="San\EventBundle\Entity\Event", cascade={"persist"})
   */
  private $event;
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var bool
     *
     * @ORM\Column(name="venue", type="boolean")
     */
    private $venue;

/**
     * @var \DateTime
     *
     * @ORM\Column(name="pub_date", type="datetimetz")
     */
    private $pubDate;
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
     * Set venue
     *
     * @param boolean $venue
     *
     * @return Inscription
     */
    public function setVenue($venue)
    {
        $this->venue = $venue;

        return $this;
    }

    /**
     * Get venue
     *
     * @return bool
     */
    public function getVenue()
    {
        return $this->venue;
    }

    /**
     * Set pubDate
     *
     * @param \DateTime $pubDate
     *
     * @return Inscription
     */
    public function setPubDate($pubDate)
    {
        $this->pubDate = $pubDate;

        return $this;
    }

    /**
     * Get pubDate
     *
     * @return \DateTime
     */
    public function getPubDate()
    {
        return $this->pubDate;
    }

    /**
     * Set user
     *
     * @param \San\UserBundle\Entity\User $user
     *
     * @return Inscription
     */
    public function setUser(\San\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \San\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set event
     *
     * @param \San\EventBundle\Entity\Event $event
     *
     * @return Inscription
     */
    public function setEvent(\San\EventBundle\Entity\Event $event = null)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * Get event
     *
     * @return \San\EventBundle\Entity\Event
     */
    public function getEvent()
    {
        return $this->event;
    }
}
