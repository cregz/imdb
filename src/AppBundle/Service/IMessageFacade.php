<?php
namespace AppBundle\Service;

interface IMessageFacade
{
    public function sendMessage($messageDTO);
}

