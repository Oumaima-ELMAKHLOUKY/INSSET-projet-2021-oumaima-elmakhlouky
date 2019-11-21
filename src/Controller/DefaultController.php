<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends AbstractController
{
    public function index()
    {
        if ($this->container->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_ANONYMOUSLY')) {
            return new RedirectResponse($this->container->get('router')->generate('fos_user_profile_show'));
        }
        else{
            return new RedirectResponse($this->container->get('router')->generate('fos_user_security_login'));
        }
    }
}