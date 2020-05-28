<?php

namespace App\Controller;

use App\Entity\Analysis;
use App\Entity\Comments;
use App\Form\CommentNewFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentsController extends AbstractController
{
    /**
     * @Route("/new-commet/{analysis}", name="new_comment")
     * @param Request $request
     * @param Analysis $analysis
     * @return RedirectResponse|Response
     * @ParamConverter("analysis", class="App\Entity\Analysis")
     */
    public function newComment(Request $request, Analysis $analysis)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $comment = new Comments();
        $form = $this->createForm(CommentNewFormType::class, $comment);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setUser($this->getUser());
            $comment->setAnalysis($analysis);
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();

            $this->addFlash('success', 'Новий коментарій додано!');
            return $this->redirect($this->generateUrl('single_analysis', [
                'analysis' => $analysis->getId()
            ]));
        }

        return $this->redirect($this->generateUrl('single_analysis', [
            'analysis' => $analysis->getId()
        ]));
    }
}
