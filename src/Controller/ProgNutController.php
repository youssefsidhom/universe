<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProgNutController extends AbstractController
{
    /**
     * @Route("/progNutr", name="prog_nut")
     */
    public function index(): Response
    {
        return $this->render('prog_nut/index.html.twig', [
            'controller_name' => 'ProgNutController',
        ]);
    }
}
