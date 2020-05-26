<?php

namespace App\Controller;

use App\Entity\Region;
use App\Form\RegionMapNewFormType;
use App\Service\RegionImageUploader;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegionController extends AbstractController
{
    /**
     * @Route("/user/map-build", name="map_builder")
     * @param Request $request
     * @param RegionImageUploader $fileUploader
     * @return RedirectResponse|Response
     */
    public function mapBuilder(Request $request, RegionImageUploader $fileUploader)
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

    /**
     * @Route("/single-region/{region}", name="single_region")
     * @param Region $region
     * @return Response
     * @ParamConverter("region", class="App\Entity\Region")
     */
    public function singleRegion(Region $region)
    {
        $em = $this->getDoctrine()->getManager();
        $region = $em->getRepository(Region::class)
            ->findBy([
                'id' => $region
            ]);

        return $this->render('region/singleRegion.html.twig',[
            'region' => $region[0]
        ]);
    }

    /**
     * @Route("/region-list", name="region_list")
     * @return Response
     */
    public function regionList()
    {
        $em = $this->getDoctrine()->getManager();
        $regionList = $em->getRepository(Region::class)->findAll();

        return $this->render('region/regionList.html.twig',[
            'regionList' => $regionList
        ]);
    }
}
