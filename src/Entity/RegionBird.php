<?php

namespace App\Entity;

use App\Repository\RegionBirdRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RegionBirdRepository::class)
 */
class RegionBird
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Birds", inversedBy="regionBird")
     */
    private $bird;

    /**
     * @ORM\Column(type="integer")
     */
    private $population;

    /**
     * @ORM\Column(type="float")
     */
    private $point_x;

    /**
     * @ORM\Column(type="float")
     */
    private $point_y;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Region", inversedBy="regionBird")
     */
    private $region;

    public function getId()
    {
        return $this->id;
    }

    public function getBird()
    {
        return $this->bird;
    }

    public function setBird($bird)
    {
        $this->bird = $bird;
    }

    public function getRegion()
    {
        return $this->region;
    }

    public function setRegion($region)
    {
        $this->region = $region;
    }

    public function getPopulation()
    {
        return $this->population;
    }

    public function setPopulation($population)
    {
        $this->population = $population;
    }

    public function getPointY()
    {
        return $this->point_y;
    }

    public function setPointY($point_y)
    {
        $this->point_y = $point_y;
    }

    public function getPointX()
    {
        return $this->point_x;
    }

    public function setPointX($point_x)
    {
        $this->point_x = $point_x;
    }
}
