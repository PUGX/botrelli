<?php

namespace PUGX\Bot\Infrastructure\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('PUGXBotInfrastructureBundle:Default:index.html.twig', array('name' => $name));
    }
}
