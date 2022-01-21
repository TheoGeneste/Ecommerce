<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Form\CategorieFormType;
use App\Form\CategoriesType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategorieController extends AbstractController
{
    /**
     * @Route("/categories", name="categories")
     */
    public function index(): Response
    {
        $categories = $this->getDoctrine()
                        ->getRepository(Categorie::class)
                        ->findAll();
        return $this->render('categorie/index.html.twig', [
            'categories' => $categories,
        ]);
    }

     /**
     * @Route("/addCategories", name="addCategories")
     */
    public function addCategorie(): Response
    {
        return $this->render('categorie/addCategorie.html.twig', [
        ]);
    }

    /**
     * @Route("/ajoutCategorie", name="ajoutCategorie")
     */
    public function ajoutCategorie(Request $request): Response
    {
        $categori = new Categorie();
        $form = $this->createForm(CategoriesType::class, $categori);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $categori = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($categori);
            $em->flush();

            return $this->redirectToRoute('categories');
        }

        return $this->renderForm('categorie/addCategorie.html.twig',
            ['form' => $form]);
    }
}
