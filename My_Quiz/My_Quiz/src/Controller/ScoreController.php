<?php

namespace App\Controller;

use App\Entity\Reponse;
use App\Repository\ReponseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ScoreController extends AbstractController
{
    #[Route('/score', name: 'app_score')]
    public function index(ReponseRepository $reponse, ): Response
    {   
        // dd($_POST);

        $count = 0;

        foreach($reponse->findBy(['id'=>$_POST]) as $value){
            if($value->getReponseExpected() === 1){
                $count ++;
            }
        }

        return $this->render('score/index.html.twig', [
            'reponses' => $reponse->findAll(),
            'count' => $count,
        ]);
    }
}
