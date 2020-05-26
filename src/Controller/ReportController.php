<?php

namespace App\Controller;

use App\Entity\Report;
use App\Form\ReportNewFormType;
use App\Service\ReportDocUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReportController extends AbstractController
{
    /**
     * @Route("/user/report-add", name="report_add")
     * @param Request $request
     * @param ReportDocUploader $docUploader
     * @return RedirectResponse|Response
     */
    public function reportAdd(Request $request, ReportDocUploader $docUploader)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $report = new Report();
        $form = $this->createForm(ReportNewFormType::class, $report, [
            'userId' => $this->getUser()->getId()
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $file = $report->getDocument();
            $fileName = $docUploader->upload($file);
            $report->setDocument($fileName);
            $em = $this->getDoctrine()->getManager();
            $em->persist($report);
            $em->flush();

            $this->addFlash('success', 'Звіт успішно створено!');
            return $this->redirect($this->generateUrl('user_panel'));
        }

        return $this->render('report/newReport.html.twig',[
            'form' => $form->createView()
        ]);
    }
}
