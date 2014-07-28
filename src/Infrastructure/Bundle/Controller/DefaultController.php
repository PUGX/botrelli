<?php

namespace PUGX\Bot\Infrastructure\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PageController extends Controller
{
    public function getAction($name)
    {
        return $this->render('PUGXBotInfrastructureBundle:Default:index.html.twig', array('name' => $name));
    }
}
