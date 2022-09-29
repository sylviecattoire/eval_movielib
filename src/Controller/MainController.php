<?php

namespace App\Controller;

use App\Repository\MovieRepository;
use App\Repository\PersonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('', name: 'main_')]
class MainController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(MovieRepository $movieRepository, PersonRepository $personRepository): Response
    {
        $movies = $movieRepository->findAll();
        $persons = $personRepository->findAll();

        return $this->render('main/index.html.twig', [
            'movies' => $movies,
            'persons' => $persons
        ]);
    }
}
