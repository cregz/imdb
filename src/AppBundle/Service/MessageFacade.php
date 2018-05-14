<?php
namespace AppBundle\Service;

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
    {}
}

