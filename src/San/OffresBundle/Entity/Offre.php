<?php

namespace San\OffresBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Offre
 *
 * @ORM\Table(name="offre")
 * @ORM\Entity(repositoryClass="San\OffresBundle\Repository\OffreRepository")
 * @Vich\Uploadable
 */
class Offre
{
     public function __construct()
    {
        $this->pubDate = new \Datetime();
        $this->categories = new ArrayCollection();
        $this->competences = new ArrayCollection();
        
    }
    
   /**
   * @ORM\ManyToMany(targetEntity="San\OffresBundle\Entity\Competence", cascade={"persist"})
   */
  private $competences;
  
    /**
   * @ORM\ManyToMany(targetEntity="San\OffresBundle\Entity\Categorie", cascade={"persist"})
   */
  private $categories;
  
  
    /**
   * @ORM\ManyToOne(targetEntity="San\UserBundle\Entity\User", cascade={"persist"})
   */
    private $user;
  
    /**
   * @ORM\ManyToOne(targetEntity="San\OffresBundle\Entity\Contrat")
   * @ORM\JoinColumn(nullable=true)
   */
  private $contrat;
  
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
     * @var \DateTime
     *
     * @ORM\Column(name="pub_date", type="datetimetz")
     */
    private $pubDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fin", type="datetimetz", nullable=true)
     */
    private $fin;

    /**
     * @var string
     *
     * @ORM\Column(name="mission", type="text")
     */
    private $mission;

    /**
     * @var string
     *
     * @ORM\Column(name="formation", type="text")
     */
    private $formation;

    /**
    * @ORM\Column(name="published", type="boolean")
    */
    private $published = true;

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
     * Set titre
     *
     * @param string $titre
     *
     * @return Offre
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
     * @return Offre
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
     * Set pubDate
     *
     * @param \DateTime $pubDate
     *
     * @return Offre
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
     * Set fin
     *
     * @param \DateTime $fin
     *
     * @return Offre
     */
    public function setFin($fin)
    {
        $this->fin = $fin;

        return $this;
    }

    /**
     * Get fin
     *
     * @return \DateTime
     */
    public function getFin()
    {
        return $this->fin;
    }

    /**
     * Set mission
     *
     * @param string $mission
     *
     * @return Offre
     */
    public function setMission($mission)
    {
        $this->mission = $mission;

        return $this;
    }

    /**
     * Get mission
     *
     * @return string
     */
    public function getMission()
    {
        return $this->mission;
    }

    /**
     * Set formation
     *
     * @param string $formation
     *
     * @return Offre
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
     * Set published
     *
     * @param boolean $published
     *
     * @return Offre
     */
    public function setPublished($published)
    {
        $this->published = $published;

        return $this;
    }

    /**
     * Get published
     *
     * @return boolean
     */
    public function getPublished()
    {
        return $this->published;
    }

    /**
     * Set contrat
     *
     * @param \San\OffresBundle\Entity\Contrat $contrat
     *
     * @return Offre
     */
    public function setContrat(\San\OffresBundle\Entity\Contrat $contrat = null)
    {
        $this->contrat = $contrat;

        return $this;
    }

    /**
     * Get contrat
     *
     * @return \San\OffresBundle\Entity\Contrat
     */
    public function getContrat()
    {
        return $this->contrat;
    }


    /**
     * Add competence
     *
     * @param \San\OffresBundle\Entity\Competence $competence
     *
     * @return Offre
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
     * @return Offre
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
     * @return Offre
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
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * 
     * @Vich\UploadableField(mapping="offre_image", fileNameProperty="imageName", size="imageSize")
     * 
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string
     */
    private $imageName;

    
    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     *
     * @return Offre
     */
    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        if ($image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
        
        return $this;
    }

    /**
     * @return File|null
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * @param string $imageName
     *
     * @return Offre
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;
        
        return $this;
    }

    /**
     * @return string|null
     */
    public function getImageName()
    {
        return $this->imageName;
    }
    
   

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Offre
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}
