<?php

namespace App\Controller;

use App\Entity\Versement;
use App\Form\VersementType;
use App\Repository\VersementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Spipu\Html2Pdf\Html2Pdf;

#[Route('/versement')]
class VersementController extends AbstractController
{
    #[Route('/', name: 'app_versement_index', methods: ['GET', 'POST'])]
    public function index(Request $request, VersementRepository $versementRepository): Response
    {

        $versement = new Versement();
        $form = $this->createForm(VersementType::class, $versement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $versement->setNumero($this->generateNumero($versementRepository->findAll()));
            $versementRepository->add($versement, true);
            return $this->redirectToRoute('app_versement_index', [], Response::HTTP_SEE_OTHER);
        }


        return $this->renderForm('versement/index.html.twig', [
            'versements' => $versementRepository->findAll(),
            'versement' => $versement,
            'form' => $form,
        ]);
    }


    public function generateNumero($versements): string
    {
        $numero = "";
        if ($versements != null) {
            $el = $versements[count($versements) - 1];
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

    #[Route('/new', name: 'app_versement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, VersementRepository $versementRepository): Response
    {
        $versement = new Versement();
        $form = $this->createForm(VersementType::class, $versement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $versementRepository->add($versement, true);

            return $this->redirectToRoute('app_versement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('versement/new.html.twig', [
            'versement' => $versement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_versement_show', methods: ['GET'])]
    public function show(Versement $versement): Response
    {
        return $this->render('versement/show.html.twig', [
            'versement' => $versement,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_versement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Versement $versement, VersementRepository $versementRepository): Response
    {
        $form = $this->createForm(VersementType::class, $versement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $versementRepository->add($versement, true);

            return $this->redirectToRoute('app_versement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('versement/edit.html.twig', [
            'versement' => $versement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_versement_delete', methods: ['POST'])]
    public function delete(Request $request, Versement $versement, VersementRepository $versementRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $versement->getId(), $request->request->get('_token'))) {
            $versementRepository->remove($versement, true);
        }

        return $this->redirectToRoute('app_versement_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/recu/{id}', name: 'app_versement_recu', methods: ['GET'])]
    public function GenerateRecu(Versement $versement)
    {
        $title = 'mandat.pdf';

        $logo = str_replace('\\', '/', $this->getParameter('img_directory'));
        $logo .= '/lgo.png';

        $template = $this->renderView('versement/recu.html.twig', [
            'title' => $title,
            'versement' => $versement,
            'logo' => $logo,
        ]);

        $pdf = new Html2Pdf('P', 'A4', 'fr', 'true', 'UTF-8', array(10, 6, 10, 6));
        $pdf->pdf->SetDisplayMode('fullpage');
        $pdf->pdf->setBookmark("CROUSZ");

        $pdf->writeHTML($template);
        ob_clean();
        $pdf->output($title);
    }
}
