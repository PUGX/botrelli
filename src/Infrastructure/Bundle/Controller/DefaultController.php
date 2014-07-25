<?php

namespace PUGX\Bot\Infrastructure\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('PUGXBotinfrastructureBundle:Default:index.html.twig', array('name' => $name));
    }
}
