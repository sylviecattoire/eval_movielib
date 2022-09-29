<?php

namespace App\Controller;

use App\Entity\Person;
use App\Form\PersonType;
use App\Repository\PersonRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/person', name: 'person_')]
class PersonController extends AbstractController
{
    #[Route('/add', name: 'add')]
    public function form(Request $request, PersonRepository $personRepository): Response
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

        return $this->render('person/form.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
