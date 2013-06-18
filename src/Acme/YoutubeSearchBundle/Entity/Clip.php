<?php

namespace Acme\YoutubeSearchBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Acme\YoutubeSearchBundle\Entity\Tag;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="clip", indexes={
 *
@ORM\Index(name="clip_url_idx",columns={"url"})
 * })
 */
class Clip
{

    /**
     * @ORM\ManyToMany(targetEntity="Tag", inversedBy="clips")
     * @ORM\JoinTable(name="clips_tags")
     *
     **/
    private $tags;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Enter URL")
     * @Assert\Url(message="Enter valid URL", protocols={"http", "https"})
     */
    protected $url;

    /**
     * @ORM\Column(name="time_start", type="integer")
     * @Assert\NotBlank(message="Enter Start Time")
     * @Assert\Type(type="integer")
     */
    protected $timeStart;

    /**
     * @ORM\Column(name="time_finish", type="integer")
     * @Assert\NotBlank(message="Enter Start Time")
     * @Assert\Type(type="integer")
     */
    protected $timeFinish;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
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
     * Set url
     *
     * @param string $url
     * @return Clip
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set timeStart
     *
     * @param integer $timeStart
     * @return Clip
     */
    public function setTimeStart($timeStart)
    {
        $this->timeStart = $timeStart;

        return $this;
    }

    /**
     * Get timeStart
     *
     * @return integer
     */
    public function getTimeStart()
    {
        return $this->timeStart;
    }

    /**
     * Set timeFinish
     *
     * @param integer $timeFinish
     * @return Clip
     */
    public function setTimeFinish($timeFinish)
    {
        $this->timeFinish = $timeFinish;

        return $this;
    }

    /**
     * Get timeFinish
     *
     * @return integer
     */
    public function getTimeFinish()
    {
        return $this->timeFinish;
    }


    /**
     * Add tags
     *
     * @param Tag $tags
     * @return Clip
     */
    public function addTag(Tag $tags)
    {
        $this->tags[] = $tags;

        return $this;
    }

    /**
     * Remove tags
     *
     * @param Tag $tags
     */
    public function removeTag(Tag $tags)
    {
        $this->tags->removeElement($tags);
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTags()
    {
        return $this->tags;
    }
}
