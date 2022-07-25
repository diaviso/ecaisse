<?php

namespace App\Controller;

use App\Entity\CompteDivisionnaire;
use App\Form\CompteDivisionnaireType;
use App\Repository\CompteDivisionnaireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/comptedivisionnaire')]
class CompteDivisionnaireController extends AbstractController
{
    #[Route('/', name: 'app_compte_divisionnaire_index', methods: ['GET', 'POST'])]
    public function index(Request $request, CompteDivisionnaireRepository $compteDivisionnaireRepository): Response
    {

        $compteDivisionnaire = new CompteDivisionnaire();
        $form = $this->createForm(CompteDivisionnaireType::class, $compteDivisionnaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $compteDivisionnaireRepository->add($compteDivisionnaire, true);
            return $this->redirectToRoute('app_compte_divisionnaire_index', [], Response::HTTP_SEE_OTHER);
        }


        return $this->renderForm('compte_divisionnaire/index.html.twig', [
            'compte_divisionnaires' => $compteDivisionnaireRepository->findAll(),
            'compte_divisionnaire' => $compteDivisionnaire,
            'form' => $form,
        ]);
    }

    #[Route('/new', name: 'app_compte_divisionnaire_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CompteDivisionnaireRepository $compteDivisionnaireRepository): Response
    {
        $compteDivisionnaire = new CompteDivisionnaire();
        $form = $this->createForm(CompteDivisionnaireType::class, $compteDivisionnaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $compteDivisionnaireRepository->add($compteDivisionnaire, true);

            return $this->redirectToRoute('app_compte_divisionnaire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('compte_divisionnaire/new.html.twig', [
            'compte_divisionnaire' => $compteDivisionnaire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_compte_divisionnaire_show', methods: ['GET'])]
    public function show(CompteDivisionnaire $compteDivisionnaire): Response
    {
        return $this->render('compte_divisionnaire/show.html.twig', [
            'compte_divisionnaire' => $compteDivisionnaire,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_compte_divisionnaire_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CompteDivisionnaire $compteDivisionnaire, CompteDivisionnaireRepository $compteDivisionnaireRepository): Response
    {
        $form = $this->createForm(CompteDivisionnaireType::class, $compteDivisionnaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $compteDivisionnaireRepository->add($compteDivisionnaire, true);

            return $this->redirectToRoute('app_compte_divisionnaire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('compte_divisionnaire/edit.html.twig', [
            'compte_divisionnaire' => $compteDivisionnaire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_compte_divisionnaire_delete', methods: ['POST'])]
    public function delete(Request $request, CompteDivisionnaire $compteDivisionnaire, CompteDivisionnaireRepository $compteDivisionnaireRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $compteDivisionnaire->getId(), $request->request->get('_token'))) {
            $compteDivisionnaireRepository->remove($compteDivisionnaire, true);
        }

        return $this->redirectToRoute('app_compte_divisionnaire_index', [], Response::HTTP_SEE_OTHER);
    }
}
