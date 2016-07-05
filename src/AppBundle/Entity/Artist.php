<?php

/*
 * This file is part of sedona-sbo Demo.
 *
 * (c) Sedona <http://www.sedona.fr/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Artist
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Album", mappedBy="artist")
     */
    private $album;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $biography;

    /**
     * @ORM\Column(type="bigint", nullable=true)
     */
    private $music_story_id;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->album = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Artist
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
     * Set biography
     *
     * @param string $biography
     * @return Artist
     */
    public function setBiography($biography)
    {
        $this->biography = $biography;

        return $this;
    }

    /**
     * Get biography
     *
     * @return string 
     */
    public function getBiography()
    {
        return $this->biography;
    }

    /**
     * Set music_story_id
     *
     * @param integer $musicStoryId
     * @return Artist
     */
    public function setMusicStoryId($musicStoryId)
    {
        $this->music_story_id = $musicStoryId;

        return $this;
    }

    /**
     * Get music_story_id
     *
     * @return integer 
     */
    public function getMusicStoryId()
    {
        return $this->music_story_id;
    }

    /**
     * Add album
     *
     * @param \AppBundle\Entity\Album $album
     * @return Artist
     */
    public function addAlbum(\AppBundle\Entity\Album $album)
    {
        $this->album[] = $album;
        if ($album->getArtist()->contains($this) == false) {
            $album->addArtist($this);
        }

        return $this;
    }

    /**
     * Remove album
     *
     * @param \AppBundle\Entity\Album $album
     */
    public function removeAlbum(\AppBundle\Entity\Album $album)
    {
        $this->album->removeElement($album);
        if ($album->getArtist()->contains($this)) {
            $album->removeArtist($this);
        }
    }

    /**
     * Get album
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAlbum()
    {
        return $this->album;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }
}
