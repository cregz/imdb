<?php
namespace AppBundle\Domain;

class MessageObject
{
    /**
     * 
     * @var integer
     */
    private $id;
    
    /**
     * 
     * @var string
     */
    private $subject;
    
    /**
     * 
     * @var integer
     */
    private $sender_id;
    
    /**
     * 
     * @var string
     */
    private $sender_name;
    
    /**
     * 
     * @var string
     */
    private $recipients;
    
    /**
     * 
     * @var boolean
     */
    private $read;
    
    /**
     * 
     * @var string
     */
    private $text;
    
    
    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @return number
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @return number
     */
    public function getSender_id()
    {
        return $this->sender_id;
    }

    /**
     * @return string
     */
    public function getSender_name()
    {
        return $this->sender_name;
    }

    /**
     * @return string
     */
    public function getRecipients()
    {
        return $this->recipients;
    }

    /**
     * @return boolean
     */
    public function isRead()
    {
        return $this->read;
    }

    /**
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param string $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * @param number $sender_id
     */
    public function setSender_id($sender_id)
    {
        $this->sender_id = $sender_id;
    }

    /**
     * @param string $sender_name
     */
    public function setSender_name($sender_name)
    {
        $this->sender_name = $sender_name;
    }

    /**
     * @param string $recipients
     */
    public function setRecipients($recipients)
    {
        $this->recipients = $recipients;
    }

    /**
     * @param boolean $read
     */
    public function setRead($read)
    {
        $this->read = $read;
    }
    
}

