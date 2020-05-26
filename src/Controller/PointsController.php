<?php

namespace App\Controller;

use App\Entity\Analysis;
use App\Entity\Points;
use App\Entity\Region;
use App\Entity\Report;
use App\Form\PointNewFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PointsController extends AbstractController
{
    /**
     * @Route("/user/new-point/{analysis}/{report}", name="new_point")
     * @param Request $request
     * @param Analysis $analysis
     * @param Report $report
     * @return RedirectResponse|Response
     * @ParamConverter("report", class="App\Entity\Report")
     * @ParamConverter("analysis", class="App\Entity\Analysis")
     */
    public function newPoint(Request $request, Analysis $analysis, Report $report)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $point = new Points();
        $form = $this->createForm(PointNewFormType::class, $point);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $point->setReport($report);
            $em = $this->getDoctrine()->getManager();
            $em->persist($point);
            $em->flush();

            $this->addFlash('success', 'Точку додано до маршруту!');
            return $this->redirect($this->generateUrl('single_analysis', [
                'analysis' => $analysis->getId()
            ]));
        }

        return $this->render('points/newPoint.html.twig',[
            'form' => $form->createView(),
            'report' => $report,
            'analysis' => $analysis
        ]);
    }
}
