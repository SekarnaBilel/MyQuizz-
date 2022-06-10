<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserController extends AbstractController
{


    public function __construct(EntityManagerInterface $manager)
    {
        $this->entityManager = $manager;
    }

    #[Route('edit/{id}', name: 'app_user')]
    public function edit(User $user, Request $request, EntityManagerInterface $manager): Response
    {

        if (!$this->getUser()) {
            return $this->redirectToRoute('main');
        }

        if ($this->getUser() !== $user) {
            return $this->redirectToRoute('main');
        }



        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            // dd($hasher->isPasswordValid($user, $form->getData()->getPassword()));

           
                // encode the plain password
                $user->setPassword(
                $userPasswordHasher->hashPassword(
                        $user,
                        $form->get('password')->getData()
                    )
                );

            $user = $form->getData();
            $user->setupdateAt(new \DateTimeImmutable());
            $manager->persist($user);
            $manager->flush();


            return $this->redirectToRoute('profil');
        }



        return $this->render('edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
