<?php

namespace App\Controller;

use App\Repository\ProvinceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api')]
class ApiController extends AbstractController
{
    #[Route('/', name: 'app_api', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }

    #[Route('/provinces', name: 'app_api', methods: ['GET'])]
    public function show(ProvinceRepository $provinceRepository): JsonResponse
    {
        return $this->json($provinceRepository->findAll());
    }
}
