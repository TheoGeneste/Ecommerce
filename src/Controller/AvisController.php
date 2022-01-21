<?php

namespace App\Controller;

use App\Entity\Avis;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AvisController extends AbstractController
{
    /**
     * @Route("/avis", name="avis")
     */
    public function index(): Response
    {
        $avis = $this->getDoctrine()
                        ->getRepository(Avis::class)
                        ->findAll();
        return $this->render('avis/index.html.twig', [
            'avis' => $avis,
        ]);
    }
}
