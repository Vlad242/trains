<?php

namespace App\Entity;

use App\Repository\ScheduleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ScheduleRepository::class)
 */
class Schedule
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $movedate;

    /**
     * @var Ticket[]| Collection
     * @ORM\OneToMany(targetEntity="App\Entity\Ticket", mappedBy="scedule", orphanRemoval=true)
     */
    private $tickets;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Location", inversedBy="schedules")
     */
    private $locationFrom;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Location", inversedBy="schedules")
     */
    private $locationTo;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Train", inversedBy="scedules")
     */
    private $train;

    public function __construct()
    {
        $this->tickets = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getMovedate()
    {
        return $this->movedate;
    }

    public function setMovedate($movedate)
    {
        $this->movedate = $movedate;

        return $this;
    }

    public function getLocationFrom()
    {
        return $this->locationFrom;
    }

    public function setLocationFrom($locationFrom)
    {
        $this->locationFrom = $locationFrom;
    }

    public function getLocationTo()
    {
        return $this->locationTo;
    }

    public function setLocationTo($locationTo)
    {
        $this->locationTo = $locationTo;
    }

    public function getTrain()
    {
        return $this->train;
    }

    public function setTrain($train)
    {
        $this->train = $train;
    }

    public function addTicket (Ticket $ticket)
    {
        $this->tickets[] = $ticket;
        $ticket->setSchedule($this);
        return $this;
    }

    public function removeTicket (Ticket $ticket)
    {
        $this->tickets->removeElement($ticket);
        $ticket->setSchedule(null);
    }
}
