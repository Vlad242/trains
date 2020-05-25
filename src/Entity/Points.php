<?php

namespace App\Entity;

use App\Repository\PointsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PointsRepository::class)
 */
class Points
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $point_x;

    /**
     * @ORM\Column(type="float")
     */
    private $point_y;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Map", inversedBy="points")
     */
    private $map;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Analysis", inversedBy="points")
     */
    private $analisys;

    public function getId()
    {
        return $this->id;
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

    public function getMap()
    {
        return $this->map;
    }

    public function setMap($map)
    {
        $this->map = $map;
    }

    public function getAnalisys()
    {
        return $this->analisys;
    }

    public function setAnalisys($analisys)
    {
        $this->analisys = $analisys;
    }
}
