<?php

namespace App\Entity;

use App\Repository\AnalysisRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass=AnalysisRepository::class)
 */
class Analysis
{
    use TimestampableEntity;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $theme;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="analysis")
     */
    private $user;

    /**
     * @var Report[]| Collection
     * @ORM\OneToMany(targetEntity="App\Entity\Report", mappedBy="analysis", orphanRemoval=true)
     */
    private $reports;

    /**
     * @var Points[]| Collection
     * @ORM\OneToMany(targetEntity="App\Entity\Points", mappedBy="analisys", orphanRemoval=true)
     */
    private $points;

    public function __construct()
    {
        $this->reports = new ArrayCollection();
        $this->points = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTheme()
    {
        return $this->theme;
    }

    public function setTheme(string $theme)
    {
        $this->theme = $theme;

        return $this;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }

    public function addReport(Report $report)
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

    public function addPoint(Points $points)
    {
        $this->points[] = $points;
        $points->setAnalisys($this);
        return $this;
    }

    public function removePoint (Points $points)
    {
        $this->points->removeElement($points);
        $points->setAnalisys(null);
    }
}
