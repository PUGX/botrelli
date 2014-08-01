<?php

namespace PUGX\Bot\UI\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function homePageAction()
    {
        $prList = $this->container->get('botrelli.pull_request.usecase.get_latest_pull_requests');

        $botrelliPRs = $this->container->get('botrelli.pull_request.usecase.get_total_prs');

        $borreliPRs = $this->container->get('botrelli.pull_request.usecase.get_total_borreli_prs');


        $array = array(
            'PRs' => $prList->getLatestPullRequest(),
            'botrelliPRs' => $botrelliPRs->getTotalPR(),
            'borreliPRs' => $borreliPRs->getTotalPR()
        );

        return $this->render('PUGXBotUIBundle:Default:homePage.html.twig', $array);
    }


}
