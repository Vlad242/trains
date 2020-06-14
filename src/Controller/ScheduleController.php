<?php

namespace App\Controller;

use App\Entity\Schedule;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ScheduleController extends AbstractController
{
    /**
     * @Route("/schedule", name="schedule")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $scheduleList = $em->getRepository(Schedule::class)->findAll();

        return $this->render('schedule/schedule.html.twig', [
            'scheduleList' => $scheduleList
        ]);
    }
}
