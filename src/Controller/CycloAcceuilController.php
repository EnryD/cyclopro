<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CycloAcceuilController extends AbstractController
{
    #[Route('/cyclo/acceuil', name: 'app_cyclo_acceuil')]
    public function index(): Response
    {
        return $this->render('cyclo_acceuil/index.html.twig', [
            'controller_name' => 'CycloAcceuilController',
        ]);
    }
}
