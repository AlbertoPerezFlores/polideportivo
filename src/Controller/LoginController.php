<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;

class LoginController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
     public function login(Request $request, AuthenticationUtils $authenticationUtils)
     {
          if ($this->getUser()) {
              return $this->redirectToRoute('app_home');
          }
 
         // get the login error if there is one
         $error = $authenticationUtils->getLastAuthenticationError();
         // last username entered by the user
         $lastUsername = $authenticationUtils->getLastUsername();
 
         return $this->render('login/index.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
     }
 
     /**
      * @Route("/logout", name="app_logout")
      */
     public function logout(): Response
     {
      return $this->render('login/index.html.twig');
         
        //  throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
     }
}
