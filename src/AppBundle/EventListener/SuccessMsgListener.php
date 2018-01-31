<?php

namespace AppBundle\EventListener;

use FOS\UserBundle\FOSUserEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;



class SuccessMsgListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return array(
            FOSUserEvents::REGISTRATION_SUCCESS => 'onRegistrationSuccess',
        );
    }

    public function onRegistrationSuccess()
    {
        /** @var $user \FOS\UserBundle\Model\UserInterface */


        //возможно тут генерировать токен для юзера и передать сюда ивент предварительно создав экземпляр ивента в контроллере


        $user = $event->getForm()->getData();

        $user->setEnabled(false);
        if (null === $user->getConfirmationToken()) {
            $user->setConfirmationToken($this->tokenGenerator->generateToken());
        }

        $event->setResponse(new RedirectResponse($url));
    }
}    






}