<?php
namespace AppBundle\Service;

use AppBundle\Entity\Message;

interface IMessageService
{
    /**
     * @return Message[]
     * @param integer $userId
     */
    public function getAllIncomingForUser($userId);
    
    /**
     * @return Message[]
     * @param integer $userId
     */
    public function getAllOutGoingForUser($userId);
    
    /**
     * @return Message[]
     * @param integer $userId
     * @param string $subject
     */
    public function findBySubject($userId, $subject);
    
    
    /**
     * @param Message $oneMessage
     */
    public function saveMessage($oneMessage);
    
    /**
     * Deletes from db
     * @oaram integer $messageId
     */
    public function deleteMessage($messageId);
    
    /**
     * Sets keep to false on recipient
     * @param integer $recipientId
     */
    public function deleteFromInbox($recipientId);
    
    /**
     * Sets keep to false on message
     * @param integer $messageId
     */
    public function deleteFromSent($messageId);
    
    
    /**
     * 
     * @param unknown $recipientId
     */
    public function markAsRead($recipientId);
}

