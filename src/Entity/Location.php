<?php

namespace App\Entity;

use App\Repository\LocationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LocationRepository::class)
 */
class Location
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
    private $position;

    /**
     * @var Schedule[]| Collection
     * @ORM\OneToMany(targetEntity="App\Entity\Schedule", mappedBy="location", orphanRemoval=true)
     */
    private $schedules;

    public function __construct()
    {
        $this->schedules = new ArrayCollection();
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

    public function getPosition()
    {
        return $this->position;
    }

    public function setPosition(string $position)
    {
        $this->position = $position;

        return $this;
    }

    public function addSchedule (Schedule $schedule)
    {
        $this->schedules[] = $schedule;
        $schedule->setLocation($this);
        return $this;
    }

    public function removeSchedule (Schedule $schedule)
    {
        $this->schedules->removeElement($schedule);
        $schedule->setLocation(null);
    }
}
