<?php

namespace PUGX\Bot\UI\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('PUGXBotUIBundle:Default:index.html.twig', array('name' => $name));
    }
}
