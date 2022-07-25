<?php

namespace App\Controller;

use App\Entity\Decadaire;
use App\Form\DecadaireType;
use App\Repository\DecadaireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

    #[Route('/decadaire')]
class DecadaireController extends AbstractController
{
    #[Route('/', name: 'app_decadaire_index', methods: ['GET', 'POST'])]
    public function index(Request $request, DecadaireRepository $decadaireRepository): Response{

        $decadaire = new Decadaire();
        $form = $this->createForm(DecadaireType::class, $decadaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $decadaireRepository->add($decadaire, true);
            return $this->redirectToRoute('app_decadaire_index', [], Response::HTTP_SEE_OTHER);
        }


        return $this->renderForm('decadaire/index.html.twig', [
            'decadaires' => $decadaireRepository->findAll(),
            'decadaire' => $decadaire,
            'form' => $form,
        ]);
    }

    #[Route('/new', name: 'app_decadaire_new', methods: ['GET', 'POST'])]
    public function new(Request $request, DecadaireRepository $decadaireRepository): Response
    {
        $decadaire = new Decadaire();
        $form = $this->createForm(DecadaireType::class, $decadaire);
        $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
            $decadaireRepository->add($decadaire, true);

            return $this->redirectToRoute('app_decadaire_index', [], Response::HTTP_SEE_OTHER);
        }
    
        return $this->renderForm('decadaire/new.html.twig', [
            'decadaire' => $decadaire,
            'form' => $form,
        ]);
}

        #[Route('/{id}', name: 'app_decadaire_show', methods: ['GET'])]
    public function show(Decadaire $decadaire): Response
    {
        return $this->render('decadaire/show.html.twig', [
            'decadaire' => $decadaire,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_decadaire_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Decadaire $decadaire, DecadaireRepository $decadaireRepository): Response
    {
        $form = $this->createForm(DecadaireType::class, $decadaire);
        $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
            $decadaireRepository->add($decadaire, true);

            return $this->redirectToRoute('app_decadaire_index', [], Response::HTTP_SEE_OTHER);
        }
    
            return $this->renderForm('decadaire/edit.html.twig', [
            'decadaire' => $decadaire,
            'form' => $form,
        ]);
        }

        #[Route('/{id}', name: 'app_decadaire_delete', methods: ['POST'])]
            public function delete(Request $request, Decadaire $decadaire, DecadaireRepository $decadaireRepository): Response
        {
                if ($this->isCsrfTokenValid('delete'.$decadaire->getId(), $request->request->get('_token'))) {
                $decadaireRepository->remove($decadaire, true);
            }
    
        return $this->redirectToRoute('app_decadaire_index', [], Response::HTTP_SEE_OTHER);
    }
}