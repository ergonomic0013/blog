<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;
use AppBundle\Entity\User as Users;
use FOS\UserBundle\Model\User;
use FOS\UserBundle\Model\UserManagerInterface;
use FOS\UserBundle\FOSUserEvents;


class UserController extends FOSRestController{
    
        //http://blog/web/api/register?username=Ella&email=elina@gmail.com&password=1234567890
    public function registerAction(Request $request){

        $userManager = $this->container->get('fos_user.user_manager');
        $dispatcher = $this->container->get('event_dispatcher');

        $data = $request->query->all();
        //print_r($data['roles']);
        //die();
        
        if(empty($request->query->get('username') || $request->query->get('email') || $request->query->get('enabled') || 
                 $request->query->get('password') || $request->query->get('roles'))) {
            return new View('The request is not complete', Response::HTTP_NOT_FOUND);
        }

        $user = $userManager->createUser();
        $user->setUsername($data['username']);
        $user->setEmail($data['email']);
        $user->setEnabled($data['enabled']);
        $user->setPlainPassword($data['password']);
        $user->setRoles(array($data['roles']));

        if(empty($user)){
            return new View('User was not registered', Response::HTTP_NOT_FOUND);
        }

        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_SUCCESS);
        $userManager->updateUser($user);


        $view = $this->view($user, 200);
        return $this->handleView($view);

         // echo 'This is UserController, registerAction';
         //return $this->render('AppBundle:User:register.html.twig', array(
            
         //));
    }

    public function profileAction($id){
        $users = $this->getDoctrine()->getRepository(Users::class)->find($id);
        
        if ($users == null) {
            return new View('There are no users exist', Response::HTTP_NOT_FOUND);
        }

        $view = $this->view($users, 200);
        return $this->handleView($view);

        // return $this->render('AppBundle:User:profile.html.twig', array(
        //     // ...
        // ));
    }

    public function editAction(){



        return $this->render('AppBundle:User:edit.html.twig', array(
            // ...
        ));
    }

    public function deleteAction(){


        return $this->render('AppBundle:User:delete.html.twig', array(
            // ...
        ));
    }

}
