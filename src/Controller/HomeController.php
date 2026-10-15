<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Repository\EvenementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(EvenementRepository $evenementRepository, Request $request): Response
    {
        $categorie = $request->query->getString('categorie');

        return $this->render('home/index.html.twig', [
            'evenements' => $evenementRepository->findForHome($categorie),
            'categorie' => $categorie,
        ]);
    }
}
