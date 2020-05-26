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
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Report", inversedBy="points")
     */
    private $report;


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

    public function getReport()
    {
        return $this->report;
    }

    public function setReport($report)
    {
        $this->report = $report;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }
}
