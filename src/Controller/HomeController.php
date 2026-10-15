<?php

namespace App\Controller;

use App\Entity\Evenement;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(EntityManagerInterface $entityManagerInterface, Request $request): Response
    {
        $evenements = $entityManagerInterface->getRepository(Evenement::class)->findAll();

        return $this->render('home/index.html.twig', [
            'evenements' => $evenements,
        ]);
    }
}
