<?php

namespace App\Controller;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



 
class ProfilController extends AbstractController{

    function profil(): Response
    {
        
        $user = new User;
        // return $this->redirectToRoute('profil');
        return $this->render('profil.html.twig', [
            'user' => $user
        ]);

        // return $this->render('profil.html.twig');
        
    }
     

}
