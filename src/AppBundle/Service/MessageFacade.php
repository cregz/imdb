<?php
namespace AppBundle\Service;

use AppBundle\Entity\Message;
use AppBundle\Domain\MessageObject;

class MessageFacade implements IMessageFacade
{
    /**
     * 
     * @var IUserService
     */
    private $userService;
    
    /**
     * 
     * @var IMessageService
     */
    private $messageService;
    
    public function __construct(IUserService $userService, IMessageService $messageService)
    {
        $this->userService = $userService;
        $this->messageService=$messageService;
    }

    public function sendMessage($messageDTO)
    {
        $message = new Message();
        $message->setMessageSenderKeep(TRUE);
        $message->setMessageSubject($messageDTO->getSubject());
        $message->setMessageContent($messageDTO->getText());
        
        $sender = $this->userService->getUserById($messageDTO->getSender_id());
        $message->setMessageUserFrom($sender);
        
        $recipients = [];
        $recipientNames = explode(";",$messageDTO->getRecipients());
        foreach($recipientNames as $oneRecipient){
            $r = $this->userService->getUserByNickname($oneRecipient);
        }
    }
}

