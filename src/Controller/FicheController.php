<?php

namespace App\Controller;

use App\Entity\Fiche;
use App\Form\FicheType;
use App\Repository\DecadaireRepository;
use App\Repository\FicheRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/fiche')]
class FicheController extends AbstractController
{
    #[Route('/', name: 'app_fiche_index', methods: ['GET', 'POST'])]
    public function index(Request $request, FicheRepository $ficheRepository, DecadaireRepository $decadaireRepository): Response
    {

        $fiche = new Fiche();
        $form = $this->createForm(FicheType::class, $fiche, [
            'decadaires' => $decadaireRepository->findByEtat(true),
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ficheRepository->add($fiche, true);
            return $this->redirectToRoute('app_fiche_index', [], Response::HTTP_SEE_OTHER);
        }


        return $this->renderForm('fiche/index.html.twig', [
            'fiches' => $ficheRepository->findAll(),
            'fiche' => $fiche,
            'form' => $form,
        ]);
    }

    #[Route('/new', name: 'app_fiche_new', methods: ['GET', 'POST'])]
    public function new(Request $request, FicheRepository $ficheRepository): Response
    {
        $fiche = new Fiche();
        $form = $this->createForm(FicheType::class, $fiche);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ficheRepository->add($fiche, true);

            return $this->redirectToRoute('app_fiche_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('fiche/new.html.twig', [
            'fiche' => $fiche,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_fiche_show', methods: ['GET'])]
    public function show(Fiche $fiche): Response
    {
        return $this->render('fiche/show.html.twig', [
            'fiche' => $fiche,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_fiche_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Fiche $fiche, FicheRepository $ficheRepository): Response
    {
        $form = $this->createForm(FicheType::class, $fiche);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ficheRepository->add($fiche, true);

            return $this->redirectToRoute('app_fiche_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('fiche/edit.html.twig', [
            'fiche' => $fiche,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_fiche_delete', methods: ['POST'])]
    public function delete(Request $request, Fiche $fiche, FicheRepository $ficheRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $fiche->getId(), $request->request->get('_token'))) {
            $ficheRepository->remove($fiche, true);
        }

        return $this->redirectToRoute('app_fiche_index', [], Response::HTTP_SEE_OTHER);
    }
}
