<?php

namespace AppBundle\Controller;

//use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
//use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use FOS\RestBundle\Controller\Annotations as Rest;
//use Symfony\Component\HttpFoundation\Response;
//use FOS\UserBundle\Model\User;
//use FOS\UserBundle\Model\UserManagerInterface;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\View\View;
use AppBundle\Entity\User as Users;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use AppBundle\Listener\SuccessMsgListener;
use AppBundle\BlogEvents;


class UserController extends FOSRestController
{    
        //http://blog/web/api/register?username=Ella&email=elina@gmail.com&password=1234567890&enabled=1&roles=USER
    public function registerAction(Request $request){
 
        $userManager = $this->container->get('fos_user.user_manager');
        $dispatcher = $this->container->get('event_dispatcher');

        $data = $request->query->all();
 
        if(empty($request->query->get('username')) || 
           empty($request->query->get('email')) || 
           empty($request->query->get('enabled')) || 
           empty($request->query->get('password')) || 
           empty($request->query->get('roles'))) {
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
        //можно передать вторым параметром экземпляр класса events (тут не создан класс), для того чтоб передать в функцию, которая будет выполняться(лиссенер)
        $dispatcher->dispatch(BlogEvents::REGISTRATION_SUCCESS);
        $userManager->updateUser($user);


        $view = $this->view('Krasavchik', 200);
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
