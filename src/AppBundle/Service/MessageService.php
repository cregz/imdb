<?php
namespace AppBundle\Service;

use AppBundle\Entity\Message;

class MessageService extends CrudService implements IMessageService
{
    /**
     * {@inheritDoc}
     * @see \AppBundle\Service\CrudService::getRepo()
     */
    public function getRepo()
    {
        // TODO Auto-generated method stub
        
    }

    public function getAllIncomingForUser($userId)
    {}

    public function findBySubject($userId, $subject)
    {}

    public function deleteFromInbox($recipientId)
    {}

    public function deleteMessage($messageId)
    {}

    public function deleteFromSent($messageId)
    {}

    public function getAllOutGoingForUser($userId)
    {}

    public function saveMessage($oneMessage)
    {}

    public function markAsRead($recipientId)
    {}
}

