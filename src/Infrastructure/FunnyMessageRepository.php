<?php

namespace PUGX\Bot\Infrastructure;

use PUGX\Bot\Message\Message;
use \PUGX\Bot\Message\MessageRepositoryInterface;

class FunnyMessageRepository implements MessageRepositoryInterface
{
    private $messages = array();

    public function __construct()
    {
        $messages[] = new Message("D'oh!");
        $messages[] = new Message("This is nearly perfect, now!");
        $messages[] = new Message("Spring cleaning...");
        $messages[] = new Message("> Details make perfection, and perfection is not a detail \n cit. Leonardo Da Vinci");
        $messages[] = new Message("No thanks needed, dude!");
        $messages[] = new Message("They call me PSR-Nazi.");
        $messages[] = new Message("My goal is to provide a better future.");
        $messages[] = new Message("Woow, coding standard are important.");
        $messages[] = new Message("> With great power there must also come great responsibility.\n cit. Amazing Fantasy");
        $messages[] = new Message("> Invention, my dear friends, is 93% perspiration, 6% electricity, 4% evaporation, and 2% butterscotch ripple.\n cit. Willy Wonka");
        $messages[] = new Message("> I know kung fu.\n cit. Neo, The Matrix");
        $messages[] = new Message("> Wait a minute, Doc. Ah… Are you telling me you built a time machine… out of a DeLorean?\n cit. Marty McFly");
        $messages[] = new Message("> Train yourself to let go of everything you fear to lose.\n cit. Yoda");
        $messages[] = new Message("> Always pass on what you have learned.\n cit. Yoda");
        $messages[] = new Message("> [Luke:] I can’t believe it. [Yoda:] That is why you fail.\n cit. Yoda");
        $messages[] = new Message("> PATIENCE YOU MUST HAVE my young padawan.\n cit. Yoda");
        $messages[] = new Message("> Feel the force.\n cit. Yoda");
        $messages[] = new Message("Rumor has it that there is something called PSR ...");

        $this->messages = $messages;
    }

    /**
     * @return Message
     *
     * @throws \Exception
     */
    public function fetch()
    {
       $i = rand(0, sizeof($this->messages)-1);
       return $this->messages[$i];
    }

}