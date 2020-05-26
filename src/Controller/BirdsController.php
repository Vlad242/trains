<?php

namespace App\Controller;

use App\Entity\Birds;
use App\Entity\RegionBird;
use App\Form\BirdsNewFormType;
use App\Service\BirdImageUploader;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BirdsController extends AbstractController
{
    /**
     * @Route("/user/bird-add", name="bird_add")
     * @param Request $request
     * @param BirdImageUploader $fileUploader
     * @return RedirectResponse|Response
     */
    public function birdAdd(Request $request, BirdImageUploader $fileUploader)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $birds = new Birds();
        $form = $this->createForm(BirdsNewFormType::class, $birds);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $file = $birds->getImage();
            $fileName = $fileUploader->upload($file);
            $birds->setImage($fileName);
            $em = $this->getDoctrine()->getManager();
            $em->persist($birds);
            $em->flush();

            $this->addFlash('success', 'Птах доданий до бази даних!');
            return $this->redirect($this->generateUrl('birds_list'));
        }

        return $this->render('birds/newBirds.html.twig',[
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/birds-list", name="birds_list")
     * @return Response
     */
    public function birdsList()
    {
        $em = $this->getDoctrine()->getManager();
        $birdsList = $em->getRepository(Birds::class)->findAll();

        return $this->render('birds/birdsList.html.twig',[
            'birdsList' => $birdsList
        ]);
    }

    /**
     * @Route("/birds-list-gallery", name="birds_list_gallery")
     * @return Response
     */
    public function birdsListGallery()
    {
        $em = $this->getDoctrine()->getManager();
        $birdsGalleryList = $em->getRepository(Birds::class)->findForGalleryField();

        return $this->render('birds/birdsGalleryList.html.twig',[
            'birdsGalleryList' => $birdsGalleryList
        ]);
    }

    /**
     * @Route("/single-bird/{bird}", name="single_bird")
     * @param Birds $bird
     * @return Response
     * @ParamConverter("bird", class="App\Entity\Birds")
     */
    public function singleBird(Birds $bird)
    {
        $em = $this->getDoctrine()->getManager();
        $bird = $em->getRepository(Birds::class)
            ->findBy([
                'id' => $bird
            ]);
        $populationPoints = $em->getRepository(RegionBird::class)
            ->findBy([
                'bird' => $bird
            ]);

        $populationSum = 0;
        /** @var RegionBird $point */
        foreach ($populationPoints as $point) {
            $populationSum = $populationSum + $point->getPopulation();
        }

        return $this->render('birds/singleBird.html.twig',[
            'bird' => $bird[0],
            'populationPoints' => $populationPoints,
            'populationSum' => $populationSum
        ]);
    }
}
