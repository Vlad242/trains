<?php

namespace App\Controller;

use App\Entity\Ticket;
use App\Form\TicketNewFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TicketController extends AbstractController
{
    /**
     * @Route("/user/ticket-new", name="ticket_new")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function birdAdd(Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $ticket = new Ticket();
        $form = $this->createForm(TicketNewFormType::class, $ticket);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $ticket->setUser($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($ticket);
            $em->flush();

            $this->addFlash('success', 'Бронювання завершено!');
            return $this->redirect($this->generateUrl('user_panel'));
        }

        return $this->render('ticket/ticket_new.html.twig',[
            'form' => $form->createView()
        ]);
    }
}
