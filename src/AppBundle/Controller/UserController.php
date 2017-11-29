<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;
use AppBundle\Entity\User;

class UserController extends FOSRestController
{
    public function registerAction()
    {
        echo 'This is UserController, registerAction';
        return $this->render('AppBundle:User:register.html.twig', array(
            
        ));
    }

    public function profileAction()
    {
        return $this->render('AppBundle:User:profile.html.twig', array(
            // ...
        ));
    }

    public function editAction()
    {
        return $this->render('AppBundle:User:edit.html.twig', array(
            // ...
        ));
    }

    public function deleteAction()
    {
        return $this->render('AppBundle:User:delete.html.twig', array(
            // ...
        ));
    }

}
