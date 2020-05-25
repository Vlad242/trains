<?php

namespace App\Entity;

use App\Repository\ReportRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass=ReportRepository::class)
 */
class Report
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
     * @ORM\Column(type="string", length=255)
     */
    private $document;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Birds", inversedBy="reports")
     */
    private $bird;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Analysis", inversedBy="reports")
     */
    private $analysis;

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

    public function getDocument()
    {
        return $this->document;
    }

    public function setDocument(string $document)
    {
        $this->document = $document;

        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;

        return $this;
    }

    public function getBird()
    {
        return $this->bird;
    }

    public function setBird($bird)
    {
        $this->bird = $bird;
    }

    public function getAnalysis()
    {
        return $this->analysis;
    }

    public function setAnalysis($analysis)
    {
        $this->analysis = $analysis;
    }
}
