<?php
namespace AppBundle\Service;

use AppBundle\Entity\Message;
use AppBundle\Domain\MessageObject;
use AppBundle\Entity\User;

interface IMessageService
{
    /**
     * @return Message
     * @param integer $messageId
     */
    public function findById($messageId);
    
    /**
     * @return Message
     * @param integer $messageId
     * @param integer $userId
     */
    public function findReceivedById($messageId, $userId);
    
    /**
     * @return Message
     * @param integer $messageId
     * @param integer $userId
     */
    public function findSentById($messageId, $userId);
    
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
     * @param integer $messageId
     * @param integer $recipientId
     */
    public function deleteFromInbox($messageId, $recipientId);
    
    /**
     * Sets keep to false on message
     * @param integer $messageId
     * @param integer $userId
     */
    public function deleteFromSent($messageId, $userId);
    
    
    /**
     * @param integer $messageId
     * @param integer $recipientId
     */
    public function markAsRead($messageId, $recipientId);
    
    /**
     * 
     * @param IUserService $userService
     * @param MessageObject $messageDTO
     * @param User $sender
     */
    public function sendMessage($userService, $messageDTO, $sender);
}

