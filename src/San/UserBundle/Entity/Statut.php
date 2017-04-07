<?php

namespace San\UserBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Statut
 *
 * @ORM\Table(name="statut")
 * @ORM\Entity(repositoryClass="San\UserBundle\Repository\StatutRepository")
 */
class Statut
{
     public function __construct()
    {
       $this->user = new \Doctrine\Common\Collections\ArrayCollection();
        $this->modDate = new \Datetime();
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
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, unique=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

     /**
     * @var \DateTime
     *
     * @ORM\Column(name="mod_date", type="datetimetz")
     */
    private $modDate;

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
     * Set nom
     *
     * @param string $nom
     *
     * @return Statut
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Statut
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
     * @return Statut
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
     * Set modDate
     *
     * @param \DateTime $modDate
     *
     * @return Statut
     */
    public function setModDate($modDate)
    {
        $this->modDate = $modDate;

        return $this;
    }

    /**
     * Get modDate
     *
     * @return \DateTime
     */
    public function getModDate()
    {
        return $this->modDate;
    }
}
