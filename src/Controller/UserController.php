<?php

namespace App\Controller;

use App\Entity\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/user/{id}", name="user/{id}")
     */
    public function index($id): Response
    {
        $user = $this->getDoctrine()
                        ->getRepository(Security::class)
                        ->find($id);

        return $this->render('user/index.html.twig', [
            'user' => $user,
        ]);
    }
}
