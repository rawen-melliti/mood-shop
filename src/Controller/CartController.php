<?php

namespace App\Controller;

use App\Repository\ProduitRepository; // <--- HEDHI LEZEM T-KOUN HUNI
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    private $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    #[Route('/cart', name: 'cart_index')]
    public function index(ProduitRepository $produitRepository): Response
    {
        $session = $this->requestStack->getSession();
        $panier = $session->get('panier', []);

        $panierComplet = [];

        foreach ($panier as $id => $quantite) {
            $produit = $produitRepository->find($id);
            if ($produit) {
                $panierComplet[] = [
                    'produit' => $produit,
                    'quantite' => $quantite
                ];
            }
        }

        return $this->render('cart/index.html.twig', [
            'items' => $panierComplet
        ]);
    }
    
    // ... baqi el code (add, etc.)


#[Route('/cart/add/{id}', name: 'cart_add')]
public function add(int $id): Response
{
    $session = $this->requestStack->getSession();
    $panier = $session->get('panier', []);

    if (!empty($panier[$id])) {
        $panier[$id]++;
    } else {
        $panier[$id] = 1;
    }

    $session->set('panier', $panier);

    // HEDHI EL KHOTWA EL NAQSA: lezem return Response
    return $this->redirectToRoute('app_home'); 
}
#[Route('/cart/remove/{id}', name: 'cart_remove')]
public function remove($id): Response
{
    $session = $this->requestStack->getSession();
    $panier = $session->get('panier', []);

    if (!empty($panier[$id])) {
        unset($panier[$id]);
    }

    $session->set('panier', $panier);

    return $this->redirectToRoute('cart_index');
}

#[Route('/cart/validate', name: 'cart_validate')]
public function validate(): Response
{
    $session = $this->requestStack->getSession();

    
    if (!$this->getUser()) {
        $this->addFlash('warning', 'Veuillez vous connecter pour valider votre commande.');
        return $this->redirectToRoute('app_login');
    }

    
    $session->remove('panier');

    
    $this->addFlash('success', 'Commande validée ! Nous vous contacterons bientôt. 🎉');

    
    return $this->redirectToRoute('app_home');
}
}