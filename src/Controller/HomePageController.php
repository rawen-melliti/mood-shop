<?php

namespace App\Controller;

use App\Repository\ProduitRepository; // <--- Importi hadhi!
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request; // <--- W hadhi!
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{
    #[Route('/', name: 'app_home')] // <--- Na7i kelmet 'home' bech iwalli houwa el par défaut
public function index(ProduitRepository $produitRepository, Request $request): Response
{
    $mood = $request->query->get('mood');

    if ($mood) {
        $produits = $produitRepository->findBy(['mood' => $mood]);
    } else {
        $produits = $produitRepository->findAll();
    }

    return $this->render('home/index.html.twig', [
        'produits' => $produits, // <--- Houni zeda baddelha 'produits' (mouch findAll mra okhra)
    ]);

    }
}