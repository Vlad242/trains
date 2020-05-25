<?php

namespace App\Entity;

use App\Repository\BirdsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BirdsRepository::class)
 */
class Birds
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $age;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $gender;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\EcoGroup", inversedBy="birds")
     */
    private $ecoGroup;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Classification", inversedBy="birds")
     */
    private $classification;

    /**
     * @var Report[]| Collection
     * @ORM\OneToMany(targetEntity="App\Entity\Report", mappedBy="bird", orphanRemoval=true)
     */
    private $reports;

    /**
     * @var RegionBird[]| Collection
     * @ORM\OneToMany(targetEntity="App\Entity\RegionBird", mappedBy="bird", orphanRemoval=true)
     */
    private $regionBird;

    public function __construct()
    {
        $this->reports = new ArrayCollection();
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

    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    public function getAge()
    {
        return $this->age;
    }

    public function setAge(string $age)
    {
        $this->age = $age;

        return $this;
    }

    public function getGender()
    {
        return $this->gender;
    }

    public function setGender(string $gender)
    {
        $this->gender = $gender;

        return $this;
    }

    public function getEcoGroup()
    {
        return $this->ecoGroup;
    }

    public function setEcoGroup($ecoGroup)
    {
        $this->ecoGroup = $ecoGroup;
    }

    public function getClassification()
    {
        return $this->classification;
    }

    public function setClassification($classification)
    {
        $this->classification = $classification;
    }

    public function addReport (Report $report)
    {
        $this->reports[] = $report;
        $report->setAnalysis($this);
        return $this;
    }

    public function removeReport (Report $report)
    {
        $this->reports->removeElement($report);
        $report->setAnalysis(null);
    }

    public function addRegionBird (RegionBird $regionBird)
    {
        $this->regionBird[] = $regionBird;
        $regionBird->setBird($this);
        return $this;
    }

    public function removeRegionBird (RegionBird $regionBird)
    {
        $this->regionBird->removeElement($regionBird);
        $regionBird->setBird(null);
    }
}
