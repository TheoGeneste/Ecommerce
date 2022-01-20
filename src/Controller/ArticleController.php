<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use App\Entity\Categorie;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article", name="article")
     */
    public function index(): Response
    {
        $articles = $this->getDoctrine()
                        ->getRepository(Article::class)
                        ->findAll();
        $categories = $this->getDoctrine()
                            ->getRepository(Categorie::class)
                            ->findAll();
        return $this->render('article/index.html.twig', [
            'articles' => $articles,
            'categories' => $categories
        ]);
    }

     /**
     * @Route("/article/{id}", name="article/{id}")
     */
    public function article($id): Response
    {
        $article = $this->getDoctrine()
                        ->getRepository(Article::class)
                        ->find($id);
        // $categorie = $this->getDoctrine()
        //                     ->getRepository(Categorie::class)
        //                     ->findAll();
        return $this->render('article/article.html.twig', [
            'article' => $article
        ]);
    }
}
