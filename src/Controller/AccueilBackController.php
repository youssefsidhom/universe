<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilBackController extends AbstractController
{
    /**
     * @Route("/back", name="accueil_back")
     */
    public function index(): Response
    {
        return $this->render('accueil_back/index.html.twig', [
            'controller_name' => 'AccueilBackController',
        ]);
    }
}
