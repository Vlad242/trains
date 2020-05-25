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
}
