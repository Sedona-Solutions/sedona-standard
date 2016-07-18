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
class Album
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $title;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Artist", inversedBy="album")
     */
    private $artist;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Track", mappedBy="album", cascade={"all"})
     */
    private $track;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $datetime;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $time;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->artist = new \Doctrine\Common\Collections\ArrayCollection();
        $this->track = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title.
     *
     * @param string $title
     *
     * @return Album
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set date.
     *
     * @param \DateTime $date
     *
     * @return Album
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date.
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Add artist.
     *
     * @param \Sedona\SBOTestBundle\Entity\Artist $artist
     *
     * @return Album
     */
    public function addArtist(\AppBundle\Entity\Artist $artist)
    {
        $this->artist[] = $artist;
        if ($artist->getAlbum()->contains($this) == false) {
            $artist->addAlbum($this);
        }

        return $this;
    }

    /**
     * Remove artist.
     *
     * @param \Sedona\SBOTestBundle\Entity\Artist $artist
     */
    public function removeArtist(\AppBundle\Entity\Artist $artist)
    {
        $this->artist->removeElement($artist);
        if ($artist->getAlbum()->contains($this)) {
            $artist->removeAlbum($this);
        }
    }

    /**
     * Get artist.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArtist()
    {
        return $this->artist;
    }

    /**
     * Add track.
     *
     * @param \Sedona\SBOTestBundle\Entity\Track $track
     *
     * @return Album
     */
    public function addTrack(\AppBundle\Entity\Track $track)
    {
        $track->setAlbum($this);
        $this->track[] = $track;

        return $this;
    }

    /**
     * Remove track.
     *
     * @param \Sedona\SBOTestBundle\Entity\Track $track
     */
    public function removeTrack(\AppBundle\Entity\Track $track)
    {
        $track->setAlbum(null);
        $this->track->removeElement($track);
    }

    /**
     * Get track.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTrack()
    {
        return $this->track;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getTitle();
    }

    /**
     * Set datetime.
     *
     * @param \DateTime $datetime
     *
     * @return Album
     */
    public function setDatetime($datetime)
    {
        $this->datetime = $datetime;

        return $this;
    }

    /**
     * Get datetime.
     *
     * @return \DateTime
     */
    public function getDatetime()
    {
        return $this->datetime;
    }

    /**
     * Set time.
     *
     * @param \DateTime $time
     *
     * @return Album
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time.
     *
     * @return \DateTime
     */
    public function getTime()
    {
        return $this->time;
    }
}
