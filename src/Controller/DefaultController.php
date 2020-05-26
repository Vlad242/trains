<?php

namespace App\Controller;

use App\Entity\Analysis;
use App\Entity\Birds;
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
        $birds = $em->getRepository(Birds::class)->findLastSixBirdsField();
        $birdsGallery = $em->getRepository(Birds::class)->findForGalleryIndexField();
        $analysis = $em->getRepository(Analysis::class)->findLastTen();

        return $this->render('default/index.html.twig', [
            'birds' => $birds,
            'birdsGallery' => $birdsGallery,
            'analysis' => $analysis
        ]);
    }

    /**
     * @Route("/user/panel", name="user_panel")
     */
    public function userPanel()
    {
        $em = $this->getDoctrine()->getManager();
        $analysis = $em->getRepository(Analysis::class)->findBy([
            'user' => $this->getUser()->getId()
        ]);

        return $this->render('default/userPanel.html.twig', [
            'analysis' => $analysis
        ]);
    }
}
