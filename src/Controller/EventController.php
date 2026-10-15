<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Form\EvenementType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class EventController extends AbstractController
{
    #[Route('/evenement/ajouter', name: 'app_event_new')]
    public function new(EntityManagerInterface $entityManagerInterface, Request $request): Response
    {
        $evenement = new Evenement();

        $form = $this->createForm(EvenementType::class, $evenement);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $evenement->setStatut(0);
            $entityManagerInterface->persist($evenement);
            $entityManagerInterface->flush();

            return $this->redirectToRoute('app_event_show', ['id' => $evenement->getId()]);
        }

        return $this->render('event/new.html.twig', [
            'eventForm' => $form,
        ]);
    }

    #[Route('/evenement/{id}', name: 'app_event_show', requirements: ['id' => '\d+'])]
    public function show(int $id, EntityManagerInterface $entityManagerInterface, Request $request): Response
    {
        $evenement = $entityManagerInterface->getRepository(Evenement::class)->find(['id' => $id ]);

        return $this->render('event/show.html.twig', [
            'evenement' => $evenement,
        ]);
    }
}
