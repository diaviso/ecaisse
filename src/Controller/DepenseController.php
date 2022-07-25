<?php

namespace App\Controller;

use App\Entity\Depense;
use App\Form\DepenseType;
use App\Repository\DepenseRepository;
use Spipu\Html2Pdf\Html2Pdf;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/depense')]
class DepenseController extends AbstractController
{
    #[Route('/', name: 'app_depense_index', methods: ['GET', 'POST'])]
    public function index(Request $request, DepenseRepository $depenseRepository): Response
    {

        $depense = new Depense();
        $form = $this->createForm(DepenseType::class, $depense);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $depense->setNumero($this->generateNumero($depenseRepository->findAll()));
            $depenseRepository->add($depense, true);
            return $this->redirectToRoute('app_depense_index', [], Response::HTTP_SEE_OTHER);
        }


        return $this->renderForm('depense/index.html.twig', [
            'depenses' => $depenseRepository->findAll(),
            'depense' => $depense,
            'form' => $form,
        ]);
    }

    public function generateNumero($depenses): string
    {
        $numero = "";
        if ($depenses != null) {
            $el = $depenses[count($depenses) - 1];
            $last = $el->getNumero();
            $last++;
            if ($last < 10)
                $numero .= '0000' . $last;
            elseif ($last < 100)
                $numero .= '000' . $last;
            elseif ($last < 1000)
                $numero .= '00' . $last;
            elseif ($last < 10000)
                $numero .= '0' . $last;
            else
                $numero .= '' . $last;
        } else
            $numero .= '00001';


        return $numero;
    }

    #[Route('/new', name: 'app_depense_new', methods: ['GET', 'POST'])]
    public function new(Request $request, DepenseRepository $depenseRepository): Response
    {
        $depense = new Depense();
        $form = $this->createForm(DepenseType::class, $depense);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $depenseRepository->add($depense, true);

            return $this->redirectToRoute('app_depense_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('depense/new.html.twig', [
            'depense' => $depense,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_depense_show', methods: ['GET'])]
    public function show(Depense $depense): Response
    {
        return $this->render('depense/show.html.twig', [
            'depense' => $depense,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_depense_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Depense $depense, DepenseRepository $depenseRepository): Response
    {
        $form = $this->createForm(DepenseType::class, $depense);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $depenseRepository->add($depense, true);

            return $this->redirectToRoute('app_depense_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('depense/edit.html.twig', [
            'depense' => $depense,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_depense_delete', methods: ['POST'])]
    public function delete(Request $request, Depense $depense, DepenseRepository $depenseRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $depense->getId(), $request->request->get('_token'))) {
            $depenseRepository->remove($depense, true);
        }

        return $this->redirectToRoute('app_depense_index', [], Response::HTTP_SEE_OTHER);
    }


    #[Route('/recu/{id}', name: 'app_depense_recu', methods: ['GET'])]
    public function GenerateRecu(Depense $depense)
    {
        $title = 'mandat.pdf';

        $logo = str_replace('\\', '/', $this->getParameter('img_directory'));
        $logo .= '/lgo.png';

        $convertisseur = new ChiffresEnLettres();
        $lettre = $convertisseur->Conversion($depense->getMontant());

        $template = $this->renderView('depense/recu.html.twig', [
            'title' => $title,
            'depense' => $depense,
            'logo' => $logo,
            'lettre' => $lettre,
        ]);

        $pdf = new Html2Pdf('P', 'A4', 'fr', 'true', 'UTF-8', array(10, 6, 10, 6));
        $pdf->pdf->SetDisplayMode('fullpage');
        $pdf->pdf->setBookmark("CROUSZ");

        $pdf->writeHTML($template);
        ob_clean();
        $pdf->output($title);
    }
}
