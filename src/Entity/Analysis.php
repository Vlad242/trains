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
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $map;

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
     * @var Comments[]| Collection
     * @ORM\OneToMany(targetEntity="App\Entity\Comments", mappedBy="analysis", orphanRemoval=true)
     */
    private $comments;

    public function __construct()
    {
        $this->reports = new ArrayCollection();
        $this->comments = new ArrayCollection();
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

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getMap()
    {
        return $this->map;
    }

    public function setMap($map)
    {
        $this->map = $map;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
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

    public function addComment(Comments $comments)
    {
        $this->comments[] = $comments;
        $comments->setAnalysis($this);
        return $this;
    }

    public function removeComment (Comments $comments)
    {
        $this->comments->removeElement($comments);
        $comments->setAnalysis(null);
    }
}
