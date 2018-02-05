<?php

namespace AppBundle\Controller;

//use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User as Users;	
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;

class LoginController extends FOSRestController
{
	use \AppBundle\Helper\ControllerHelper;

    public function loginAction(Request $request)
    {
    	$userName = $request->getUser();
    	$userPassword = $request->getPassword();

    	$user = $this->getDoctrine()->getRepository(Users::class)->findOneBy(['username' => $userName]);
    	if(!$user){
    		throw $this->createNotFoundException();
    	}

    	$isValid = $this->('sucurity.password_encoder')->isPasswordValid($user, $password);
    	$if(!$isValid){
    		throw new BadCredentialsException();
    	}

    	$token = $this->getToken($user);
    	$response


    }

    public function getToken()
    {


    }

    public function getTokenExpiryDateTime()
    {


    }
}
