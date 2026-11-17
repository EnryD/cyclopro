<?php

namespace App\Controller;

use App\Entity\Reparation;
use App\Form\ReparationType;
use App\Repository\ReparationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN')]
final class ReparationController extends AbstractController
{
    #[Route('/ajout-reparation', name: 'app_ajout_reparation')]
    public function ajoutReparation(Request $request, EntityManagerInterface $em): Response
    {
        $reparation = new Reparation();
        $form = $this->createForm(ReparationType::class, $reparation);
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $em->persist($reparation);
                $em->flush();
                $this->addFlash('notice', 'Demande enregistrée');
                return $this->redirectToRoute('app_liste_reparations');
            }
        }
        return $this->render('reparation/ajout_reparation.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/liste-reparations', name: 'app_liste_reparations')]
    public function listeReparations(ReparationRepository $reparationRepository): Response
    {
        return $this->render('reparation/liste_reparations.html.twig', [
            'reparations' => $reparationRepository->findAll(),
        ]);
    }
}
