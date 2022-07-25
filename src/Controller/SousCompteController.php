<?php

namespace App\Controller;

use App\Entity\SousCompte;
use App\Form\SousCompteType;
use App\Repository\SousCompteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/souscompte')]
class SousCompteController extends AbstractController
{
    #[Route('/', name: 'app_sous_compte_index', methods: ['GET', 'POST'])]
    public function index(Request $request, SousCompteRepository $sousCompteRepository): Response
    {

        $sousCompte = new SousCompte();
        $form = $this->createForm(SousCompteType::class, $sousCompte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sousCompteRepository->add($sousCompte, true);
            return $this->redirectToRoute('app_sous_compte_index', [], Response::HTTP_SEE_OTHER);
        }


        return $this->renderForm('sous_compte/index.html.twig', [
            'sous_comptes' => $sousCompteRepository->findAll(),
            'sous_compte' => $sousCompte,
            'form' => $form,
        ]);
    }

    #[Route('/new', name: 'app_sous_compte_new', methods: ['GET', 'POST'])]
    public function new(Request $request, SousCompteRepository $sousCompteRepository): Response
    {
        $sousCompte = new SousCompte();
        $form = $this->createForm(SousCompteType::class, $sousCompte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sousCompteRepository->add($sousCompte, true);

            return $this->redirectToRoute('app_sous_compte_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('sous_compte/new.html.twig', [
            'sous_compte' => $sousCompte,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_sous_compte_show', methods: ['GET'])]
    public function show(SousCompte $sousCompte): Response
    {
        return $this->render('sous_compte/show.html.twig', [
            'sous_compte' => $sousCompte,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_sous_compte_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, SousCompte $sousCompte, SousCompteRepository $sousCompteRepository): Response
    {
        $form = $this->createForm(SousCompteType::class, $sousCompte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sousCompteRepository->add($sousCompte, true);

            return $this->redirectToRoute('app_sous_compte_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('sous_compte/edit.html.twig', [
            'sous_compte' => $sousCompte,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_sous_compte_delete', methods: ['POST'])]
    public function delete(Request $request, SousCompte $sousCompte, SousCompteRepository $sousCompteRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $sousCompte->getId(), $request->request->get('_token'))) {
            $sousCompteRepository->remove($sousCompte, true);
        }

        return $this->redirectToRoute('app_sous_compte_index', [], Response::HTTP_SEE_OTHER);
    }
}
