<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="recipients")
 */
class Recipient extends BaseEntity
{
    /**
     * @ORM\ManyToOne(targetEntity="Message")
     */
    private $recipient_message_id;
    
    /**
     * @ORM\ManyToOne(targetEntity="User")
     */
    private $recipient_user_id;
    
    /**
     * @ORM\Column(type="boolean")
     */
    private $recipient_keep;
    
    /**
     * @ORM\Column(type="boolean")
     */
    private $recipient_read;

    /**
     * Set recipientKeep
     *
     * @param boolean $recipientKeep
     *
     * @return Recipient
     */
    public function setRecipientKeep($recipientKeep)
    {
        $this->recipient_keep = $recipientKeep;

        return $this;
    }

    /**
     * Get recipientKeep
     *
     * @return boolean
     */
    public function getRecipientKeep()
    {
        return $this->recipient_keep;
    }

    /**
     * Set recipientRead
     *
     * @param boolean $recipientRead
     *
     * @return Recipient
     */
    public function setRecipientRead($recipientRead)
    {
        $this->recipient_read = $recipientRead;

        return $this;
    }

    /**
     * Get recipientRead
     *
     * @return boolean
     */
    public function getRecipientRead()
    {
        return $this->recipient_read;
    }

    /**
     * Set recipientMessageId
     *
     * @param \AppBundle\Entity\Message $recipientMessageId
     *
     * @return Recipient
     */
    public function setRecipientMessageId(\AppBundle\Entity\Message $recipientMessageId = null)
    {
        $this->recipient_message_id = $recipientMessageId;

        return $this;
    }

    /**
     * Get recipientMessageId
     *
     * @return \AppBundle\Entity\Message
     */
    public function getRecipientMessageId()
    {
        return $this->recipient_message_id;
    }

    /**
     * Set recipientUserId
     *
     * @param \AppBundle\Entity\User $recipientUserId
     *
     * @return Recipient
     */
    public function setRecipientUserId(\AppBundle\Entity\User $recipientUserId = null)
    {
        $this->recipient_user_id = $recipientUserId;

        return $this;
    }

    /**
     * Get recipientUserId
     *
     * @return \AppBundle\Entity\User
     */
    public function getRecipientUserId()
    {
        return $this->recipient_user_id;
    }
}
