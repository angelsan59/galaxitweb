<?php

namespace San\OffresBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categorie
 *
 * @ORM\Table(name="categorie")
 * @ORM\Entity(repositoryClass="San\OffresBundle\Repository\CategorieRepository")
 */
class Categorie
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

     /**
   * @ORM\OneToMany(targetEntity="San\OffresBundle\Entity\Competence", mappedBy="categorie")
   */
  private $competences; // Notez le « s », une annonce est liée à plusieurs candidatures
  
  public function __construct()
  {
    $this->competences = new ArrayCollection();
    
  }
  public function addCompetence(Competence $competence)
  {
    $this->competences[] = $competence;
  }

  public function removeCompetence(Competence $competence)
  {
    $this->competences->removeElement($competence);
  }

  public function getCompetences()
  {
    return $this->competences;
  }
    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", nullable=true)
     */
    private $content;


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
     * @return Categorie
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
     * @return Categorie
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
}

