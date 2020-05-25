<?php

namespace App\Entity;

use App\Repository\MapRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MapRepository::class)
 */
class Map
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $map_path;

    /**
     * @var Points[]| Collection
     * @ORM\OneToMany(targetEntity="App\Entity\Points", mappedBy="map", orphanRemoval=true)
     */
    private $points;

    public function __construct()
    {
        $this->points = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getMapPath()
    {
        return $this->map_path;
    }

    public function setMapPath(string $map_path)
    {
        $this->map_path = $map_path;

        return $this;
    }

    public function addPoint(Points $points)
    {
        $this->points[] = $points;
        $points->setMap($this);
        return $this;
    }

    public function removePoint (Points $points)
    {
        $this->points->removeElement($points);
        $points->setMap(null);
    }
}
