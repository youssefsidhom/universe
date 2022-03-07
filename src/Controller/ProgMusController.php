<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProgMusController extends AbstractController
{
    /**
     * @Route("/progMus", name="prog_mus")
     */
    public function index(): Response
    {
        return $this->render('prog_mus/index.html.twig', [
            'controller_name' => 'ProgMusController',
        ]);
    }
}
