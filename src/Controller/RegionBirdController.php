<?php

namespace App\Controller;

use App\Entity\Region;
use App\Entity\RegionBird;
use App\Form\RegionBirdNewFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegionBirdController extends AbstractController
{
    /**
     * @Route("/user/check-population", name="check_population")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function checkPopulation(Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $em = $this->getDoctrine()->getManager();
        $regionList = $em->getRepository(Region::class)->findAll();

        $population = new RegionBird();
        $form = $this->createForm(RegionBirdNewFormType::class, $population);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($population);
            $em->flush();

            $this->addFlash('success', 'Ареал відмічений!');
            return $this->redirect($this->generateUrl('user_panel'));
        }

        return $this->render('region_bird/newRegionBird.html.twig',[
            'form' => $form->createView(),
            'regionList' => $regionList
        ]);
    }
}
