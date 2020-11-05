<?php

namespace App\Mailer;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class Mailer extends AbstractController
{
    public function send($name, \Swift_Mailer $mailer)
    {
        $message = (new \Swift_Message('Hello Email Test'))
            ->setFrom('2c7c0e5d9318@pepisandbox.com')
            ->setTo('2c7c0e5d9318@bk.ru')
            ->setBody(
                $this->renderView(
                    'emails/registration.html.twig',
                    ['name' => $name]
                ),
                'text/html'
            )
        ;
        $mailer->send($message);
    }

}