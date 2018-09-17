<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UserAthentificationController extends AbstractController
{
    /**
     * @Route("/registration", name="registration")
     */
    public function registration(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder){
        $user = new User();

        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $hash = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);

            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('login');
        }

        return $this->render('user_authentification/registration.html.twig', [
            'formReg' => $form->createView()
        ]);
    }

    /**
     * @Route("/connexion", name="login")
     */
    public function login(){
        return $this->render('user_authentification/login.html.twig');
    }

    /**
     * @Route("/deconnexion", name="logout")
     */
    public function logout(){
        
    }
}
