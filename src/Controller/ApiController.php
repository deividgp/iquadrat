<?php

namespace App\Controller;

use App\Entity\Message;
use App\Repository\MessageRepository;
use App\Repository\ProvinceRepository;
use App\Repository\TownRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

#[Route('/api')]
class ApiController extends AbstractController
{
    #[Route('/provinces', name: 'provinces_index', methods: ['GET'])]
    public function index(ProvinceRepository $provinceRepository): JsonResponse
    {
        $provinces = $provinceRepository->findAll();
 
        return $this->json($provinces);
    }

    #[Route('/provinces/{id}/towns', name: 'provinces_towns', methods: ['GET'])]
    public function provincesTowns(TownRepository $townRepository, int $id): JsonResponse
    {
        $towns = $townRepository->findByProvinceId($id);
 
        return $this->json($towns);
    }

    #[Route('/message', name: 'message_create', methods: ['PUT'])]
    public function createMessage(EntityManagerInterface $entityManager, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $message = new Message();
        $message->setMessage($data["message"]);

        $entityManager->persist($message);
        $entityManager->flush();

        return $this->json(["message" => $data["message"]]);
    }
}
