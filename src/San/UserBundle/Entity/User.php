<?php

namespace San\UserBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="San\UserBundle\Repository\UserRepository")
 */
class User
{
      public function __construct()
    {
        $this->dateMod = new \Datetime();
        $this->dateInsc = new \Datetime();
        $this->competences = new ArrayCollection();
        $this->offres = new ArrayCollection();
    }
    
      /**
   * @ORM\ManyToMany(targetEntity="San\OffresBundle\Entity\Competence", cascade={"persist"})
   */
  private $competences;
  
     /**
   * @ORM\OneToOne(targetEntity="San\CoreBundle\Entity\Image", cascade={"persist", "remove"})
   */
  private $image;
  
      /**
   * @ORM\ManyToMany(targetEntity="San\OffresBundle\Entity\Offre", cascade={"persist"})
   */
    private $offres;
  
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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
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
     * @ORM\Column(name="date_insc", type="datetimetz")
     */
    private $dateInsc;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_mod", type="datetimetz", nullable=true)
     */
    private $dateMod;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="psw", type="string", length=255)
     */
    private $psw;

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
     * @var \DateTime
     *
     * @ORM\Column(name="date_dispo", type="datetime")
     */
    private $dateDispo;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="cp", type="string", length=255)
     */
    private $cp;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=255)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="pays", type="string", length=255)
     */
    private $pays;

    /**
     * @var string
     *
     * @ORM\Column(name="web", type="string", length=255, nullable=true)
     */
    private $web;

    /**
     * @var string
     *
     * @ORM\Column(name="linkdn", type="string", length=255, nullable=true)
     */
    private $linkdn;

    /**
     * @var string
     *
     * @ORM\Column(name="viadeo", type="string", length=255, nullable=true)
     */
    private $viadeo;

    /**
     * @var string
     *
     * @ORM\Column(name="twitter", type="string", length=255, nullable=true)
     */
    private $twitter;

    /**
     * @var string
     *
     * @ORM\Column(name="cv", type="string", length=255)
     */
    private $cv;

    /**
     * @var string
     *
     * @ORM\Column(name="realisations", type="text", nullable=true)
     */
    private $realisations;

    /**
     * @var string
     *
     * @ORM\Column(name="formation", type="text", nullable=true)
     */
    private $formation;

    /**
     * @var string
     *
     * @ORM\Column(name="techno", type="text", nullable=true)
     */
    private $techno;

    /**
     * @var string
     *
     * @ORM\Column(name="evolution", type="text", nullable=true)
     */
    private $evolution;

    /**
     * @var string
     *
     * @ORM\Column(name="spontane", type="string", length=255)
     */
    private $spontane;
    
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

    /**
     * Set psw
     *
     * @param string $psw
     *
     * @return User
     */
    public function setPsw($psw)
    {
        $this->psw = $psw;

        return $this;
    }

    /**
     * Get psw
     *
     * @return string
     */
    public function getPsw()
    {
        return $this->psw;
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
     * Set dateDispo
     *
     * @param \DateTime $dateDispo
     *
     * @return User
     */
    public function setDateDispo($dateDispo)
    {
        $this->dateDispo = $dateDispo;

        return $this;
    }

    /**
     * Get dateDispo
     *
     * @return \DateTime
     */
    public function getDateDispo()
    {
        return $this->dateDispo;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return User
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
     * Set adresse
     *
     * @param string $adresse
     *
     * @return User
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set cp
     *
     * @param string $cp
     *
     * @return User
     */
    public function setCp($cp)
    {
        $this->cp = $cp;

        return $this;
    }

    /**
     * Get cp
     *
     * @return string
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return User
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set pays
     *
     * @param string $pays
     *
     * @return User
     */
    public function setPays($pays)
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * Get pays
     *
     * @return string
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * Set web
     *
     * @param string $web
     *
     * @return User
     */
    public function setWeb($web)
    {
        $this->web = $web;

        return $this;
    }

    /**
     * Get web
     *
     * @return string
     */
    public function getWeb()
    {
        return $this->web;
    }

    /**
     * Set linkdn
     *
     * @param string $linkdn
     *
     * @return User
     */
    public function setLinkdn($linkdn)
    {
        $this->linkdn = $linkdn;

        return $this;
    }

    /**
     * Get linkdn
     *
     * @return string
     */
    public function getLinkdn()
    {
        return $this->linkdn;
    }

    /**
     * Set viadeo
     *
     * @param string $viadeo
     *
     * @return User
     */
    public function setViadeo($viadeo)
    {
        $this->viadeo = $viadeo;

        return $this;
    }

    /**
     * Get viadeo
     *
     * @return string
     */
    public function getViadeo()
    {
        return $this->viadeo;
    }

    /**
     * Set twitter
     *
     * @param string $twitter
     *
     * @return User
     */
    public function setTwitter($twitter)
    {
        $this->twitter = $twitter;

        return $this;
    }

    /**
     * Get twitter
     *
     * @return string
     */
    public function getTwitter()
    {
        return $this->twitter;
    }

    /**
     * Set cv
     *
     * @param string $cv
     *
     * @return User
     */
    public function setCv($cv)
    {
        $this->cv = $cv;

        return $this;
    }

    /**
     * Get cv
     *
     * @return string
     */
    public function getCv()
    {
        return $this->cv;
    }

    /**
     * Set realisations
     *
     * @param string $realisations
     *
     * @return User
     */
    public function setRealisations($realisations)
    {
        $this->realisations = $realisations;

        return $this;
    }

    /**
     * Get realisations
     *
     * @return string
     */
    public function getRealisations()
    {
        return $this->realisations;
    }

    /**
     * Set formation
     *
     * @param string $formation
     *
     * @return User
     */
    public function setFormation($formation)
    {
        $this->formation = $formation;

        return $this;
    }

    /**
     * Get formation
     *
     * @return string
     */
    public function getFormation()
    {
        return $this->formation;
    }

    /**
     * Set techno
     *
     * @param string $techno
     *
     * @return User
     */
    public function setTechno($techno)
    {
        $this->techno = $techno;

        return $this;
    }

    /**
     * Get techno
     *
     * @return string
     */
    public function getTechno()
    {
        return $this->techno;
    }

    /**
     * Set evolution
     *
     * @param string $evolution
     *
     * @return User
     */
    public function setEvolution($evolution)
    {
        $this->evolution = $evolution;

        return $this;
    }

    /**
     * Get evolution
     *
     * @return string
     */
    public function getEvolution()
    {
        return $this->evolution;
    }

    /**
     * Set spontane
     *
     * @param string $spontane
     *
     * @return User
     */
    public function setSpontane($spontane)
    {
        $this->spontane = $spontane;

        return $this;
    }

    /**
     * Get spontane
     *
     * @return string
     */
    public function getSpontane()
    {
        return $this->spontane;
    }

    /**
     * Add competence
     *
     * @param \San\OffresBundle\Entity\Competence $competence
     *
     * @return User
     */
    public function addCompetence(\San\OffresBundle\Entity\Competence $competence)
    {
        $this->competences[] = $competence;

        return $this;
    }

    /**
     * Remove competence
     *
     * @param \San\OffresBundle\Entity\Competence $competence
     */
    public function removeCompetence(\San\OffresBundle\Entity\Competence $competence)
    {
        $this->competences->removeElement($competence);
    }

    /**
     * Get competences
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCompetences()
    {
        return $this->competences;
    }

    /**
     * Add offre
     *
     * @param \San\OffresBundle\Entity\Offre $offre
     *
     * @return User
     */
    public function addOffre(\San\OffresBundle\Entity\Offre $offre)
    {
        $this->offres[] = $offre;

        return $this;
    }

    /**
     * Remove offre
     *
     * @param \San\OffresBundle\Entity\Offre $offre
     */
    public function removeOffre(\San\OffresBundle\Entity\Offre $offre)
    {
        $this->offres->removeElement($offre);
    }

    /**
     * Get offres
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOffres()
    {
        return $this->offres;
    }
}
