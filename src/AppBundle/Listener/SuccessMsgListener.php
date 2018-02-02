<?php

namespace AppBundle\Listener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use AppBundle\BlogEvents;





class SuccessMsgListener implements EventSubscriberInterface
{
	public function __construct(){
        //тут инжектить зависимости, если они есть

	}

    public static function getSubscribedEvents()
    {
        return array(
            BlogEvents::REGISTRATION_SUCCESS => 'onRegistrationSuccess',
        );
    }

    public function onRegistrationSuccess()
    {
        echo 'User registration was successfull';


        //возможно тут генерировать токен для юзера и передать сюда ивент предварительно создав экземпляр ивента в контроллере
        //токен генерируется для подтверждения по эмаил.. скорее всего он тут не надо. просто вывести сообщение и все

        //токен для логина сделать отдельно
        //die('listener was run');

        // $user = $event->getForm()->getData();

        // $user->setEnabled(false);
        // if (null === $user->getConfirmationToken()) {
        //     $user->setConfirmationToken($this->tokenGenerator->generateToken());
        // }

        // $event->setResponse(new RedirectResponse($url));
    }
}    





