<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


class UserController extends AbstractController
{
    // page profile
    #[Route('/profile', name: 'app_profile')]
    public function profile(): Response
    {
        return $this->render('user/profile.html.twig', [
            'user' => $this->getUser(),
        ]);
    }

    // page edit profile
    #[Route('/profile/edit', name: 'app_profile_edit')]
    public function editProfile(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPrenom($form->get('prenom')->getData());
            $user->setNom($form->get('nom')->getData());
            $user->setEmail($form->get('email')->getData());

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_profile');
        }

        return $this->render('user/edit_profile.html.twig', [
            'userForm' => $form->createView(),
        ]);
    }


}