<?php

namespace San\NewsBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * News
 *
 * @ORM\Table(name="news")
 * @ORM\Entity(repositoryClass="San\NewsBundle\Repository\NewsRepository")
 */
class News
{
    public function __construct()
    {
        $this->pubDate = new \Datetime();
        $this->newscats = new ArrayCollection();
    }
    
      /**
   * @ORM\ManyToOne(targetEntity="San\UserBundle\Entity\User", cascade={"persist"})
   */
  private $user;
       /**
   * @ORM\ManyToMany(targetEntity="San\NewsBundle\Entity\newscat", cascade={"persist"})
   */
  private $newscats;
  
      /**
   * @ORM\ManyToOne(targetEntity="San\CoreBundle\Entity\Image")
   * @ORM\JoinColumn(nullable=true)
   */
  private $image;
  
   /**
    * @ORM\Column(name="published", type="boolean")
    */
    private $published = true;
    
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
     * @ORM\Column(name="content", type="text", nullable=true)
     */
    private $content;

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
     * Set titre
     *
     * @param string $titre
     *
     * @return News
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
     * @return News
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
     * @return News
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
     * Set image
     *
     * @param \San\CoreBundle\Entity\Image $image
     *
     * @return News
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
     * Set published
     *
     * @param boolean $published
     *
     * @return News
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
     * Add newscat
     *
     * @param \San\NewsBundle\Entity\newscat $newscat
     *
     * @return News
     */
    public function addNewscat(\San\NewsBundle\Entity\newscat $newscat)
    {
        $this->newscats[] = $newscat;

        return $this;
    }

    /**
     * Remove newscat
     *
     * @param \San\NewsBundle\Entity\newscat $newscat
     */
    public function removeNewscat(\San\NewsBundle\Entity\newscat $newscat)
    {
        $this->newscats->removeElement($newscat);
    }

    /**
     * Get newscats
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNewscats()
    {
        return $this->newscats;
    }

    /**
     * Set user
     *
     * @param \San\UserBundle\Entity\User $user
     *
     * @return News
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
}
