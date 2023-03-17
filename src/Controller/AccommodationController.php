<?php

namespace App\Controller;

use App\Entity\Accommodation;
use App\Repository\AccommodationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccommodationController extends AbstractController
{
    #[Route('/accommodations', name: 'app_accommodations')]
    public function list(AccommodationRepository $accommodationRepository): Response
    {
        return $this->render('accommodation/list.html.twig', [
           'accommodations' => $accommodationRepository->findAll(),
        ]);
    }

    #[Route('/accommodations/{id<\d+>}', name: 'app_accommodation')]
    //public function show(string $id, AccommodationRepository $accommodationRepository)
    public function show(Accommodation $accommodation)
    {
        return $this->render('accommodation/show.html.twig', [
            //'accommodation' => $accommodationRepository->find($id),
            'accommodation' => $accommodation,
         ]);
    }
}
