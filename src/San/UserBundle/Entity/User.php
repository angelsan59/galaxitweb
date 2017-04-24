<?php

namespace San\UserBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 * @ORM\Entity(repositoryClass="San\UserBundle\Repository\UserRepository")
 * 
 */
class User extends BaseUser
{
      public function __construct()
    {
        $this->dateMod = new \Datetime();
        
        parent::__construct();
    }
    
     /**
   * @ORM\OneToOne(targetEntity="San\CoreBundle\Entity\Image", cascade={"persist", "remove"})
   * @ORM\JoinColumn(nullable=true)
   */
  private $image;
  
    /**
    * @ORM\ManyToOne(targetEntity="San\OffresBundle\Entity\Candidature")
   
    */
    private $candidature;
    
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=true)
     *  @Assert\NotBlank(message="Please enter your name.", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=3,
     *     max=255,
     *     minMessage="The name is too short.",
     *     maxMessage="The name is too long.",
     *     groups={"Registration", "Profile"}
     * )
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255, nullable=true)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="societe", type="string", length=255, nullable=true)
     */
    private $societe;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_insc", type="datetimetz", nullable=true)
     */
    private $dateInsc;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_mod", type="datetimetz", nullable=true)
     */
    private $dateMod;

    /**
     * @var int
     *
     * @ORM\Column(name="portable", type="integer", nullable=true)
     */
    private $portable;

    /**
     * @var int
     *
     * @ORM\Column(name="telephone", type="integer", nullable=true)
     */
    private $telephone;

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
     * @return User
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
     * Set prenom
     *
     * @param string $prenom
     *
     * @return User
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set societe
     *
     * @param string $societe
     *
     * @return User
     */
    public function setSociete($societe)
    {
        $this->societe = $societe;

        return $this;
    }

    /**
     * Get societe
     *
     * @return string
     */
    public function getSociete()
    {
        return $this->societe;
    }

    /**
     * Set dateInsc
     *
     * @param \DateTime $dateInsc
     *
     * @return User
     */
    public function setDateInsc($dateInsc)
    {
        $this->dateInsc = $dateInsc;

        return $this;
    }

    /**
     * Get dateInsc
     *
     * @return \DateTime
     */
    public function getDateInsc()
    {
        return $this->dateInsc;
    }

    /**
     * Set dateMod
     *
     * @param \DateTime $dateMod
     *
     * @return User
     */
    public function setDateMod($dateMod)
    {
        $this->dateMod = $dateMod;

        return $this;
    }

    /**
     * Get dateMod
     *
     * @return \DateTime
     */
    public function getDateMod()
    {
        return $this->dateMod;
    }

    /**
     * Set portable
     *
     * @param integer $portable
     *
     * @return User
     */
    public function setPortable($portable)
    {
        $this->portable = $portable;

        return $this;
    }

    /**
     * Get portable
     *
     * @return int
     */
    public function getPortable()
    {
        return $this->portable;
    }

    /**
     * Set telephone
     *
     * @param integer $telephone
     *
     * @return User
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return int
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set image
     *
     * @param \San\CoreBundle\Entity\Image $image
     *
     * @return User
     */
    public function setImage(\San\CoreBundle\Entity\Image $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \San\CoreBundle\Entity\Image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set candidature
     *
     * @param \San\OffresBundle\Entity\Candidature $candidature
     *
     * @return User
     */
    public function setCandidature(\San\OffresBundle\Entity\Candidature $candidature)
    {
        $this->candidature = $candidature;

        return $this;
    }

    /**
     * Get candidature
     *
     * @return \San\OffresBundle\Entity\Candidature
     */
    public function getCandidature()
    {
        return $this->candidature;
    }
}
