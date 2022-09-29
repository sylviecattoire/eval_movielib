<?php

namespace App\Controller;

use App\Entity\Person;
use App\Form\PersonType;
use App\Repository\MovieRepository;
use App\Repository\PersonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/movie', name: 'movie_')]
class MovieController extends AbstractController
{
    #[Route('/', name: 'list')]
    public function list(MovieRepository $movieRepository): Response
    {
        $movies = $movieRepository->findAll();

        return $this->render('movie/list.html.twig', [
            'movies' => $movies
        ]);
    }

    #[Route('/person', name: 'person')]
    public function formPerson(Request $request, PersonRepository $personRepository): Response
    {
        $person = new Person();
        $form = $this->createForm(PersonType::class, $person);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Sauvegarde des données dans la BDD
            $personRepository->save($person, true);
            // Redirection 
            return $this->redirectToRoute('main_index');
        }

        return $this->render('movie/form-person.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
