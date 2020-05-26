<?php

namespace App\Controller;

use App\Entity\Analysis;
use App\Entity\Points;
use App\Entity\Report;
use App\Form\AnalysisNewFormType;
use App\Service\AnalysisImageUploader;
use App\Service\MapImageUploader;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnalysisController extends AbstractController
{
    /**
     * @Route("/user/analysis-add", name="analysis_add")
     * @param Request $request
     * @param AnalysisImageUploader $AnalysisUploader
     * @param MapImageUploader $mapUploader
     * @return RedirectResponse|Response
     */
    public function analysisAdd(Request $request, AnalysisImageUploader $AnalysisUploader, MapImageUploader $mapUploader)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $analysis = new Analysis();
        $form = $this->createForm(AnalysisNewFormType::class, $analysis);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $file = $analysis->getImage();
            $fileName = $AnalysisUploader->upload($file);
            $analysis->setImage($fileName);
            $fileMap = $analysis->getMap();
            $fileName = $mapUploader->upload($fileMap);
            $analysis->setMap($fileName);
            $analysis->setUser($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($analysis);
            $em->flush();

            $this->addFlash('success', 'Аналіз створено!');
            return $this->redirect($this->generateUrl('user_panel'));
        }

        return $this->render('analysis/newAnalysis.html.twig',[
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/analysis/{analysis}", name="single_analysis")
     * @param Analysis $analysis
     * @return Response
     * @ParamConverter("analysis", class="App\Entity\Analysis")
     */
    public function singleAnalysis(Analysis $analysis)
    {
        $em = $this->getDoctrine()->getManager();
        $analys = $em->getRepository(Analysis::class)
            ->findBy([
                'id' => $analysis,
            ]);
        $reports = $em->getRepository(Report::class)
            ->findBy([
                'analysis' => $analysis,
            ]);

        $points = $em->getRepository(Points::class)
            ->findBy([
                'report' => $reports,
            ]);

        return $this->render('analysis/singleAnalysis.html.twig',[
            'analys' => $analys[0],
            'reports' => $reports,
            'points' => $points
        ]);
    }

    /**
     * @Route("/analysis-list", name="analysis_list")
     * @return Response
     */
    public function analysisList()
    {
        $em = $this->getDoctrine()->getManager();
        $analysis = $em->getRepository(Analysis::class)->findAll();


        return $this->render('analysis/AnalysisList.html.twig',[
            'analysis' => $analysis
        ]);
    }
}
