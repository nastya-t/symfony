<?php


namespace Acme\YoutubeSearchBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Acme\YoutubeSearchBundle\Entity\Clip;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="tag")
 */
class Tag
{
    /**
     * @ORM\ManyToMany(targetEntity="Clip", mappedBy="tags")
     **/
    private $clips;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Enter Name")
     */
    protected $name;

    public function __construct()
    {
        $this->clips = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Tag
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }


    /**
     * Add clips
     *
     * @param Clip $clips
     * @return Tag
     */
    public function addClip(Clip $clips)
    {
        $this->clips[] = $clips;

        return $this;
    }

    /**
     * Remove clips
     *
     * @param Clip $clips
     */
    public function removeClip(Clip $clips)
    {
        $this->clips->removeElement($clips);
    }

    /**
     * Get clips
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getClips()
    {
        return $this->clips;
    }
}
