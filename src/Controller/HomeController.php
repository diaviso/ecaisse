<?php

namespace App\Controller;

use App\Entity\Decadaire;
use App\Repository\DecadaireRepository;
use App\Repository\FicheRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(DecadaireRepository $decadaireRepository, FicheRepository $ficheRepository): Response
    {

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'decadaires' => $decadaireRepository->findAll(),
            'fiches' => $ficheRepository->findAll(),
        ]);
    }
}
