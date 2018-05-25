<?php
namespace AppBundle\Service;

use AppBundle\Domain\MessageObject;

interface IMessageFacade
{
    /**
     * 
     * @param MessageObject $messageDTO
     */
    public function sendMessage($messageDTO);
}

