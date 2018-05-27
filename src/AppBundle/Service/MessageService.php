<?php
namespace AppBundle\Service;

use AppBundle\Entity\Message;
use AppBundle\Entity\Recipient;

class MessageService extends CrudService implements IMessageService
{
    public function __construct($em, $form, $request)
    {
        parent::__construct($em, $form, $request);
    }
    
    /**
     * {@inheritDoc}
     * @see \AppBundle\Service\CrudService::getRepo()
     */
    public function getRepo()
    {
        return $this->em->getRepository(Message::class);
    }

    /**
     * {@inheritDoc}
     * @see \AppBundle\Service\IMessageService::findById()
     */
    public function findById($messageId)
    {
        return $this->getRepo()->findOneBy(['id'=>$messageId]);
        
    }

    public function getAllIncomingForUser($userId)
    {
        $query = $this->em->createQuery("SELECT m FROM AppBundle\Entity\Message m JOIN m.message_recipients r
                                   WHERE r.recipient_user_id = $userId AND r.recipient_keep = true
                                   ORDER BY m.createdOn DESC");
        return $query->getResult();
    }

    /**
     * {@inheritDoc}
     * @see \AppBundle\Service\IMessageService::sendMessage()
     */
    public function sendMessage($userService, $messageDTO, $sender)
    {
        $message = new Message();
        $message->setMessageSenderKeep(TRUE);
        $message->setMessageSubject($messageDTO->getSubject());
        $message->setMessageContent($messageDTO->getText());
        
        $message->setMessageUserFrom($sender);
        
        if($messageDTO->getOriginal_message_id()){
            $origMessage = $this->findById($messageDTO->getOriginal_message_id());
            $message->setMessageReplyTo($origMessage);
        }
        
        $this->saveMessage($message);
        
        $recipients = [];
        $recipientStr = explode(";", $messageDTO->getRecipients());
        foreach($recipientStr as $oneRecipient) {
            $r = $userService->getUserByNickname($oneRecipient);
            if($r){
                $recipient = new Recipient();
                $recipient->setRecipientKeep(TRUE);
                $recipient->setRecipientRead(false);
                $recipient->setRecipientUserId($r);
                $recipient->setRecipientMessageId($message);
                $this->em->persist($recipient);
                $this->em->flush();
            }
        }
        return $message->getId();   
    }

    public function findBySubject($userId, $subject)
    {}

    public function deleteFromInbox($messageId, $recipientId)
    {
        $query = $this->em->createQuery("SELECT r FROM AppBundle\Entity\Recipient r
                                   WHERE r.recipient_user_id = $recipientId AND r.recipient_message_id = $messageId");
        $recipients = $query->getResult();
        foreach ($recipients as $recipient){
            $recipient->setRecipientKeep(FALSE);
            $this->em->persist($recipient);
            $this->em->flush();
        }
        
        return count($recipients);
    }

    public function deleteMessage($messageId)
    {
        $message = $this->findById($messageId);
        $this->em->remove($message);
        $this->em->flush();
    }

    public function deleteFromSent($messageId, $userId)
    {
        $query = $this->em->createQuery("SELECT m FROM AppBundle\Entity\Message m
                                   WHERE m.id = $messageId AND m.message_user_from = $userId");
        $messages = $query->getResult();
        foreach ($messages as $message){
            $message->setMessageSenderKeep(FALSE);
            $this->em->persist($message);
            $this->em->flush();
        }
        
        return count($messages);
    }

    /**
     * {@inheritDoc}
     * @see \AppBundle\Service\IMessageService::findReceivedById()
     */
    public function findReceivedById($messageId, $userId)
    {
        $query = $this->em->createQuery("SELECT m FROM AppBundle\Entity\Message m JOIN m.message_recipients r
                                   WHERE r.recipient_user_id = $userId AND r.recipient_message_id = $messageId");
        $msg = $query->getResult();
        if(count($msg)){
            return $msg[0];
        } else{
            return null;
        }
        
    }

    /**
     * {@inheritDoc}
     * @see \AppBundle\Service\IMessageService::findSentById()
     */
    public function findSentById($messageId, $userId)
    {
        return $this->getRepo()->findOneBy(['id'=>$messageId, 'message_user_from'=>$userId]);
        
    }

    public function getAllOutGoingForUser($userId)
    {
        $query = $this->em->createQuery("SELECT m FROM AppBundle\Entity\Message m
                                   WHERE m.message_user_from = $userId AND m.message_sender_keep = true");
        return $query->getResult();
    }

    public function saveMessage($oneMessage)
    {
        $this->em->persist($oneMessage);
        $this->em->flush();
        return $oneMessage->getId();
    }

    public function markAsRead($messageId, $recipientId)
    {
        $query = $this->em->createQuery("SELECT r FROM AppBundle\Entity\Recipient r
                                   WHERE r.recipient_user_id = $recipientId AND r.recipient_message_id = $messageId");
        $recipients = $query->getResult();
        foreach ($recipients as $recipient){
            $recipient->setRecipientRead(TRUE);
            $this->em->persist($recipient);
            $this->em->flush();
        }
        
        return count($recipients);
    }
}

