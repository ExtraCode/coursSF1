<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\JeuRepository;

class JeuController extends AbstractController
{
    #[Route('/jeu', name: 'app_jeu')]
    public function index(JeuRepository $jeuRepository): Response
    {

        $jeux = $jeuRepository->listJeuWithLimitOrderByDateSortie(3);

        return $this->render('jeu/index.html.twig', [
            'jeux' => $jeux
        ]);
    }
}
