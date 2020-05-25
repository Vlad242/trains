<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BirdsController extends AbstractController
{
    /**
     * @Route("/birds", name="birds")
     */
    public function index()
    {
        return $this->render('birds/index.html.twig', [
            'controller_name' => 'BirdsController',
        ]);
    }

    /**
     * @Route("/user/bird-add", name="bird_add")
     * @param Request $request
     * @param RegionImageUploader $fileUploader
     * @return RedirectResponse|Response
     */
    public function birdAdd(Request $request, RegionImageUploader $fileUploader)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $em = $this->getDoctrine()->getManager();
        $regionList = $em->getRepository(Region::class)->findAll();

        $region = new Region();
        $form = $this->createForm(RegionMapNewFormType::class, $region);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $file = $region->getImage();
            $fileName = $fileUploader->upload($file);
            $region->setImage($fileName);
            $em = $this->getDoctrine()->getManager();
            $em->persist($region);
            $em->flush();

            $this->addFlash('success', 'Регіон додано до бази даних!');
            return $this->redirect($this->generateUrl('user_panel'));
        }

        return $this->render('region/newRegion.html.twig',[
            'form' => $form->createView(),
            'regionList' => $regionList
        ]);
    }
}
