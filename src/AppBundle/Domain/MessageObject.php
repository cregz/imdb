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
    
}

