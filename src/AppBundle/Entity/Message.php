<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="messages")
 *
 */
class Message extends BaseEntity
{
    /**
     * @ORM\ManyToOne(targetEntity="User")
     */
    private $message_user_from;
    
    
    /**
     * @ORM\OneToMany(targetEntity="Recipient", mappedBy="recipient_message_id")
     */
    private $message_recipients;
    
    
    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    private $message_subject;
    
    /**
     * @ORM\Column(type="text")
     */
    private $message_content;
    
    /**
     * @ORM\OneToOne(targetEntity="Message")
     */
    private $message_reply_to;
    
    /**
     * @ORM\Column(type="boolean")
     */
    private $message_sender_keep;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->message_recipients = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set messageSubject
     *
     * @param string $messageSubject
     *
     * @return Message
     */
    public function setMessageSubject($messageSubject)
    {
        $this->message_subject = $messageSubject;

        return $this;
    }

    /**
     * Get messageSubject
     *
     * @return string
     */
    public function getMessageSubject()
    {
        return $this->message_subject;
    }

    /**
     * Set messageContent
     *
     * @param string $messageContent
     *
     * @return Message
     */
    public function setMessageContent($messageContent)
    {
        $this->message_content = $messageContent;

        return $this;
    }

    /**
     * Get messageContent
     *
     * @return string
     */
    public function getMessageContent()
    {
        return $this->message_content;
    }

    /**
     * Set messageSenderKeep
     *
     * @param boolean $messageSenderKeep
     *
     * @return Message
     */
    public function setMessageSenderKeep($messageSenderKeep)
    {
        $this->message_sender_keep = $messageSenderKeep;

        return $this;
    }

    /**
     * Get messageSenderKeep
     *
     * @return boolean
     */
    public function getMessageSenderKeep()
    {
        return $this->message_sender_keep;
    }

    /**
     * Set messageUserFrom
     *
     * @param \AppBundle\Entity\User $messageUserFrom
     *
     * @return Message
     */
    public function setMessageUserFrom(\AppBundle\Entity\User $messageUserFrom = null)
    {
        $this->message_user_from = $messageUserFrom;

        return $this;
    }

    /**
     * Get messageUserFrom
     *
     * @return \AppBundle\Entity\User
     */
    public function getMessageUserFrom()
    {
        return $this->message_user_from;
    }

    /**
     * Add messageRecipient
     *
     * @param \AppBundle\Entity\Recipient $messageRecipient
     *
     * @return Message
     */
    public function addMessageRecipient(\AppBundle\Entity\Recipient $messageRecipient)
    {
        $this->message_recipients[] = $messageRecipient;

        return $this;
    }

    /**
     * Remove messageRecipient
     *
     * @param \AppBundle\Entity\Recipient $messageRecipient
     */
    public function removeMessageRecipient(\AppBundle\Entity\Recipient $messageRecipient)
    {
        $this->message_recipients->removeElement($messageRecipient);
    }

    /**
     * Get messageRecipients
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMessageRecipients()
    {
        return $this->message_recipients;
    }

    /**
     * Set messageReplyTo
     *
     * @param \AppBundle\Entity\Message $messageReplyTo
     *
     * @return Message
     */
    public function setMessageReplyTo(\AppBundle\Entity\Message $messageReplyTo = null)
    {
        $this->message_reply_to = $messageReplyTo;

        return $this;
    }

    /**
     * Get messageReplyTo
     *
     * @return \AppBundle\Entity\Message
     */
    public function getMessageReplyTo()
    {
        return $this->message_reply_to;
    }
}
