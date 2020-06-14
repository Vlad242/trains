<?php

namespace App\Controller;

use App\Entity\Schedule;
use App\Entity\Ticket;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class DefaultController extends AbstractController
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * @Route("/", name="homepage")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $scheduleList = $em->getRepository(Schedule::class)->findFixedByDateField();
        return $this->render('default/index.html.twig', [
            'scheduleList' => $scheduleList
        ]);
    }

    /**
     * @Route("/user/panel", name="user_panel")
     */
    public function userPanel()
    {
        $em = $this->getDoctrine()->getManager();
        $tickets = $em->getRepository(Ticket::class)->findBy([
            'user' => $this->getUser()->getId()
        ]);

        return $this->render('default/userPanel.html.twig', [
            'tickets' => $tickets
        ]);
    }
}
