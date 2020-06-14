<?php

namespace App\Entity;

use App\Repository\TrainRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TrainRepository::class)
 */
class Train
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
     * @ORM\Column(type="integer")
     */
    private $carr_ct;

    /**
     * @ORM\Column(type="integer")
     */
    private $place_ct;

    /**
     * @var Schedule[]| Collection
     * @ORM\OneToMany(targetEntity="App\Entity\Schedule", mappedBy="train", orphanRemoval=true)
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

    public function getcarrCt()
    {
        return $this->carr_ct;
    }

    public function setcarrCt(int $carr_ct)
    {
        $this->carr_ct = $carr_ct;

        return $this;
    }

    public function getPlaceCt()
    {
        return $this->place_ct;
    }

    public function setPlaceCt(int $place_ct)
    {
        $this->place_ct = $place_ct;

        return $this;
    }
}
