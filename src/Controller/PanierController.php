<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use App\Entity\User;

class PanierController extends AbstractController
{
    /**
     * @Route("/panier", name="panier")
     */
    public function index(): Response
    {  

        return $this->render('panier/index.html.twig', [
            'panier' => $_SESSION['panier'],
        ]);
    }

    /**
     * @Route("/panier/{idArticle}/{idUser}", name="panier/{idArticle}/{idUser}")
     */
    public function panier($idArticle, $idUser): Response
    {
        $article = $this->getDoctrine()
                        ->getRepository(Article::class)
                        ->find($idArticle);

        $array = ["article" => $article, "userId" => $idUser];
        
        array_push($_SESSION["panier"], $array);
        return $this->render('panier/index.html.twig', [
            "panier" => $_SESSION['panier']
        ]);
    }

    /**
     * @Route("/viderPanier/", name="viderPanier")
     */
    public function viderPanier(): Response
    {
        $_SESSION['panier'] = [];
        return $this->render('panier/index.html.twig', [
            "panier" => $_SESSION['panier']
        ]);
    }

    /**
     * @Route("/validerPanier/", name="validerPanier")
     */
    public function validerPanier(): Response
    {
        $_SESSION['panier'] = [];
        return $this->redirectToRoute('article');
    }
}
