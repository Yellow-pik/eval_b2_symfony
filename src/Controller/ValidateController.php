<?php

namespace App\Controller;

use App\Entity\Evenement;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN')]
final class ValidateController extends AbstractController
{
    #[Route('/validate', name: 'app_validate')]
    public function index(EntityManagerInterface $entityManagerInterface): Response
    {
        $evenements = $entityManagerInterface->getRepository(Evenement::class)->findBy(['statut' => 0], ['date' => 'ASC']);
        return $this->render('validate/index.html.twig', [
            'evenements' => $evenements,
        ]);
    }

    #[Route('/validate/{id}', name: 'app_event_validate')]
    public function validateEvent(int $id, EntityManagerInterface $entityManagerInterface): Response
    {
        $evenement = $entityManagerInterface->getRepository(Evenement::class)->find($id);
        if (!$evenement) {
            throw $this->createNotFoundException('Événement non trouvé');
        }
        $evenement->setStatut(1);
        $entityManagerInterface->flush();

        return $this->redirectToRoute('app_validate');
    }

}
