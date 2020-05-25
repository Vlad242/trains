<?php

namespace App\Entity;

use App\Repository\EcoGroupRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EcoGroupRepository::class)
 */
class EcoGroup
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
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @var Birds[]| Collection
     * @ORM\OneToMany(targetEntity="App\Entity\Birds", mappedBy="ecoGroup", orphanRemoval=true)
     */
    private $birds;

    public function __construct()
    {
        $this->birds = new ArrayCollection();
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

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;

        return $this;
    }

    public function addBirds(Birds $birds)
    {
        $this->birds[] = $birds;
        $birds->setEcoGroup($this);
        return $this;
    }

    public function removeBirds (Birds $birds)
    {
        $this->birds->removeElement($birds);
        $birds->setEcoGroup(null);
    }
}
