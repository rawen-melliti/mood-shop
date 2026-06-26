<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class MainController extends AbstractController
{
    // Baddelna el thneya l' "/" bech toul y7el el Home Page
    #[Route('/', name: 'app_home')] 
    public function index(ProduitRepository $repository, Request $request): Response
    {
        // Nejdou el "mood" mel URL (ken el user nzel 3la bouton)
        $mood = $request->query->get('mood');
        
        if ($mood) {
            // Ken famma mood, n'jibou ken el parfums elli maktoub fiha el mood hedhaka
            $produits = $repository->findBy(['mood' => $mood]);
        } else {
            // Ken mafammach, n'jibou el parfums l'kol
            $produits = $repository->findAll();
        }

        return $this->render('main/index.html.twig', [
            'produits' => $produits,
            'currentMood' => $mood
        ]);
    }
}