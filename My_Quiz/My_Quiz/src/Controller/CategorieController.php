<?php

namespace App\Controller;

use App\Entity\Reponse;
use App\Entity\Question;
use App\Form\QuizFormType;
use App\Repository\ReponseRepository;
use App\Repository\CategoryRepository;
use App\Repository\CategorieRepository;
use App\Repository\QuestionRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategorieController extends AbstractController
{
    #[Route('/categorie/{id}', name: 'app_categorie')]
    public function index(int $id, QuestionRepository $questionRepository,
     ReponseRepository $reponseRepository, CategoryRepository $categorie, CategorieRepository $categories ): Response
    {

        // dump($reponseRepository->query->get('id'));
        // $reponses = $reponseRepository->findBy(['question' => $reponseRepository->get('id')]);
        $reponses = $reponseRepository->findBy(['question' => $questionRepository->findBy(['categorie' => $id])]);
        // dump($categorie);
        return $this->render('categorie/index.html.twig', [
            'categorie' =>  $categories ->findAll($id),
            'categories' => $categorie->find($id),
            'id' => $id,
            'question' => $questionRepository->findBy(['categorie' => $id]),
            'reponce' => $reponses,
            // dd($categories)
        ]);
    }

    #[Route('/quiz', name: 'app_quiz')]
    public function edit(Reponse $reponse, Request $request): Response
    
    {
        $form = $this->createForm(QuizFormType::class, $reponse);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            dd($form);
        }

        return $this->render('quiz/index.html.twig');
    }
}

