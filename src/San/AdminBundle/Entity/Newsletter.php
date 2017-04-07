<?php

namespace San\AdminBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Newsletter
 *
 * @ORM\Table(name="newsletter")
 * @ORM\Entity(repositoryClass="San\AdminBundle\Repository\NewsletterRepository")
 */
class Newsletter
{
      public function __construct()
    {
        $this->pubDate = new \Datetime();
        $this->user = new \Doctrine\Common\Collections\ArrayCollection();
    }
    /**
   * @ORM\ManyToMany(targetEntity="San\UserBundle\Entity\User", cascade={"persist"})
   */
  private $user;
  
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="pubdate", type="datetimetz")
     */
    private $pubdate;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(name="auteur_id", type="integer")
     */
    private $auteurid;

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
     * Set pubdate
     *
     * @param \DateTime $pubdate
     *
     * @return Newsletter
     */
    public function setPubdate($pubdate)
    {
        $this->pubdate = $pubdate;

        return $this;
    }

    /**
     * Get pubdate
     *
     * @return \DateTime
     */
    public function getPubdate()
    {
        return $this->pubdate;
    }

    /**
     * Set titre
     *
     * @param string $titre
     *
     * @return Newsletter
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Newsletter
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }
   
    /**
     * Add user
     *
     * @param \San\UserBundle\Entity\User $user
     *
     * @return Newsletter
     */
    public function addUser(\San\UserBundle\Entity\User $user)
    {
        $this->user[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \San\UserBundle\Entity\User $user
     */
    public function removeUser(\San\UserBundle\Entity\User $user)
    {
        $this->user->removeElement($user);
    }

    /**
     * Get user
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set auteurid
     *
     * @param integer $auteurid
     *
     * @return Newsletter
     */
    public function setAuteurid($auteurid)
    {
        $this->auteurid = $auteurid;

        return $this;
    }

    /**
     * Get auteurid
     *
     * @return integer
     */
    public function getAuteurid()
    {
        return $this->auteurid;
    }
}
