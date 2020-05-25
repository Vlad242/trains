<?php

namespace App\Controller;

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
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    /**
     * @Route("/user/panel", name="user_panel")
     */
    public function userPanel()
    {
        $this->session->set('attribute-name', 'attribute-value');

        $foo = $this->session->get('foo');

        $filters = $this->session->get('filters', []);
        return $this->render('default/userPanel.html.twig');
    }
}
