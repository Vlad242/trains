<?php

namespace App\Entity;

use App\Repository\RegionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RegionRepository::class)
 */
class Region
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="float")
     */
    private $area;

    /**
     * @ORM\Column(type="float")
     */
    private $point_x;

    /**
     * @ORM\Column(type="float")
     */
    private $point_y;

    /**
     * @ORM\Column(type="text")
     */
    private $polygon;

    /**
     * @ORM\Column(type="text")
     */
    private $image;

    /**
     * @ORM\Column(type="text")
     */
    private $climate;

    /**
     * @ORM\Column(type="text")
     */
    private $soil_char;

    /**
     * @ORM\Column(type="text")
     */
    private $animal_char;

    /**
     * @ORM\Column(type="text")
     */
    private $plants_char;

    /**
     * @var RegionBird[]| Collection
     * @ORM\OneToMany(targetEntity="App\Entity\RegionBird", mappedBy="region", orphanRemoval=true)
     */
    private $regionBird;

    public function __construct()
    {
        $this->regionBird = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getArea()
    {
        return $this->area;
    }

    public function setArea(float $area)
    {
        $this->area = $area;

        return $this;
    }

    public function getPointX()
    {
        return $this->point_x;
    }

    public function setPointX(float $point_x)
    {
        $this->point_x = $point_x;

        return $this;
    }

    public function getPointY()
    {
        return $this->point_y;
    }

    public function setPointY(float $point_y)
    {
        $this->point_y = $point_y;

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    public function getClimate()
    {
        return $this->climate;
    }

    public function setClimate(string $climate)
    {
        $this->climate = $climate;

        return $this;
    }

    public function getSoilChar()
    {
        return $this->soil_char;
    }

    public function setSoilChar(string $soil_char)
    {
        $this->soil_char = $soil_char;

        return $this;
    }

    public function getAnimalChar()
    {
        return $this->animal_char;
    }

    public function setAnimalChar(string $animal_char)
    {
        $this->animal_char = $animal_char;

        return $this;
    }

    public function getPlantsChar()
    {
        return $this->plants_char;
    }

    public function setPlantsChar(string $plants_char)
    {
        $this->plants_char = $plants_char;

        return $this;
    }

    public function getPolygon()
    {
        return $this->polygon;
    }

    public function setPolygon($polygon)
    {
        $this->polygon = $polygon;
    }

    public function addRegionBird (RegionBird $regionBird)
    {
        $this->regionBird[] = $regionBird;
        $regionBird->setRegion($this);
        return $this;
    }

    public function removeRegionBird (RegionBird $regionBird)
    {
        $this->regionBird->removeElement($regionBird);
        $regionBird->setRegion(null);
    }
}
