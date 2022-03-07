<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AbonnController extends AbstractController
{
    /**
     * @Route("/abonn", name="abonn")
     */
    public function index(): Response
    {
        return $this->render('abonn/index.html.twig', [
            'controller_name' => 'AbonnController',
        ]);
    }
}
