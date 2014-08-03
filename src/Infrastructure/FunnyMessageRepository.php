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
        $messages[] = new Message("No thanks needed, dude!");
        $messages[] = new Message("They call me PSR-Nazi.");
        $messages[] = new Message("My goal is to provide a better future.");
        $messages[] = new Message("Woow, coding standard are important.");
        $messages[] = new Message("Rumor has it that there is something called PSR ...");
        $messages[] = new Message("> Details make perfection, and perfection is not a detail \ncit. Leonardo Da Vinci");
        $messages[] = new Message("> With great power there must also come great responsibility.\ncit. Amazing Fantasy");
        $messages[] = new Message("> Invention, my dear friends, is 93% perspiration, 6% electricity, 4% evaporation, and 2% butterscotch ripple.\ncit. Willy Wonka");
        $messages[] = new Message("> I know kung fu.\ncit. Neo, The Matrix");
        $messages[] = new Message("> Wait a minute, Doc. Ah… Are you telling me you built a time machine… out of a DeLorean?\ncit. Marty McFly");
        $messages[] = new Message("> Train yourself to let go of everything you fear to lose.\ncit. Yoda");
        $messages[] = new Message("> Always pass on what you have learned.\ncit. Yoda");
        $messages[] = new Message("> [Luke:] I can’t believe it. [Yoda:] That is why you fail.\ncit. Yoda");
        $messages[] = new Message("> PATIENCE YOU MUST HAVE my young padawan.\ncit. Yoda");
        $messages[] = new Message("> Feel the force.\ncit. Yoda");
        $messages[] = new Message("> I’m Luke Skywalker, I’m here to rescue you.\ncit.");
        $messages[] = new Message("> Oh my goodness! Shut me down. Machines building machines. How perverse.\ncit. C-3PO");
        $messages[] = new Message("> I'm programmed for etiquette, not destruction!\ncit. C3-PO");
        $messages[] = new Message("> Oh no. What have I done?\ncit. C3-PO");
        $messages[] = new Message("> Uuuuuuuur Ahhhhrrrrrrrrr Uhrrrrr Ahhhhrrrrrrrr Aaaargh.\ncit. Chewbacca");
        $messages[] = new Message("> I'm not bad. I'm just drawn that way \ncit. Jessica Rabbit");

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
