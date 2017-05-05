<?php

namespace San\OffresBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Candidature
 *
 * @ORM\Table(name="candidature")
 * @ORM\Entity(repositoryClass="San\OffresBundle\Repository\CandidatureRepository")
 * @Vich\Uploadable
 */
class Candidature
{
     public function __construct()
    {
        $this->pubdate = new \Datetime();
        $this->categories = new ArrayCollection();
        $this->competences = new ArrayCollection();
        $this->contrats = new ArrayCollection();
    }
    
   /**
   * @ORM\ManyToOne(targetEntity="San\UserBundle\Entity\Statut", cascade={"persist"})
   */
    private $statut;
  
    
    /**
    * @ORM\ManyToOne(targetEntity="San\UserBundle\Entity\User", inversedBy="candidatures")
   
    */
    private $user;
    
    /**
    * @ORM\ManyToOne(targetEntity="San\OffresBundle\Entity\Offre")
    * @ORM\JoinColumn(nullable=false)
    */
    private $offre;
  
      /**
   * @ORM\ManyToMany(targetEntity="San\OffresBundle\Entity\Contrat", cascade={"persist"})
   */
  private $contrats;
  
     /**
   * @ORM\ManyToMany(targetEntity="San\OffresBundle\Entity\Competence", cascade={"persist"})
   */
  private $competences;
  
    /**
   * @ORM\ManyToMany(targetEntity="San\OffresBundle\Entity\Categorie", cascade={"persist"})
   */
  private $categories;
  
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
     * @ORM\Column(name="date_dispo", type="datetime")
     */
    private $dateDispo;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="pubdate", type="datetime")
     */
    private $pubdate;

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
    private $spontane='non';

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
     * Set dateDispo
     *
     * @param \DateTime $dateDispo
     *
     * @return Candidature
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
     * @return Candidature
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
     * @return Candidature
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
     * @return Candidature
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
     * @return Candidature
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
     * @return Candidature
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
     * @return Candidature
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
     * @return Candidature
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
     * @return Candidature
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
     * @return Candidature
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
     * Set realisations
     *
     * @param string $realisations
     *
     * @return Candidature
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
     * @return Candidature
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
     * @return Candidature
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
     * @return Candidature
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
     * @return Candidature
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
     * Set offre
     *
     * @param \San\OffresBundle\Entity\Offre $offre
     *
     * @return Candidature
     */
    public function setOffre(\San\OffresBundle\Entity\Offre $offre)
    {
        $this->offre = $offre;

        return $this;
    }

    /**
     * Get offre
     *
     * @return \San\OffresBundle\Entity\Offre
     */
    public function getOffre()
    {
        return $this->offre;
    }

    /**
     * Set pubdate
     *
     * @param \DateTime $pubdate
     *
     * @return Candidature
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
     * Set statut
     *
     * @param \San\UserBundle\Entity\Statut $statut
     *
     * @return Candidature
     */
    public function setStatut(\San\UserBundle\Entity\Statut $statut = null)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut
     *
     * @return \San\UserBundle\Entity\Statut
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Add competence
     *
     * @param \San\OffresBundle\Entity\Competence $competence
     *
     * @return Candidature
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
     * Add category
     *
     * @param \San\OffresBundle\Entity\Categorie $category
     *
     * @return Candidature
     */
    public function addCategory(\San\OffresBundle\Entity\Categorie $category)
    {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * Remove category
     *
     * @param \San\OffresBundle\Entity\Categorie $category
     */
    public function removeCategory(\San\OffresBundle\Entity\Categorie $category)
    {
        $this->categories->removeElement($category);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Set user
     *
     * @param \San\UserBundle\Entity\User $user
     *
     * @return Candidature
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
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $cv;

    /**
     * @Vich\UploadableField(mapping="candidature_cv", fileNameProperty="cv")
     * @var File
     */
    private $cvFile;
    
    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $cv
     *
     * @return Candidature
     */
    public function setCvFile(File $cv = null)
    {
        $this->cvFile = $cv;
        
        return $this;
    }

    /**
     * @return File|null
     */
    public function getCvFile()
    {
        return $this->cvFile;
    }

    /**
     * @param string $cvName
     *
     * @return Candidature
     */
    public function setCv($cv)
    {
        $this->cv = $cv;
        
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCv()
    {
        return $this->cv;
    }

    /**
     * Add contrat
     *
     * @param \San\OffresBundle\Entity\Contrat $contrat
     *
     * @return Candidature
     */
    public function addContrat(\San\OffresBundle\Entity\Contrat $contrat)
    {
        $this->contrats[] = $contrat;

        return $this;
    }

    /**
     * Remove contrat
     *
     * @param \San\OffresBundle\Entity\Contrat $contrat
     */
    public function removeContrat(\San\OffresBundle\Entity\Contrat $contrat)
    {
        $this->contrats->removeElement($contrat);
    }

    /**
     * Get contrats
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getContrats()
    {
        return $this->contrats;
    }
}
