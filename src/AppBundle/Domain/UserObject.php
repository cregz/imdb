<?php
namespace AppBundle\Domain;

class UserObject
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
    private $usernickname;
    
    /**
     * 
     * @var string
     */
    private $clearpassword;
    
    /**
     * 
     * @var string
     */
    private $email;
    
    
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
    public function getUsernickname()
    {
        return $this->usernickname;
    }

    /**
     * @return string
     */
    public function getClearpassword()
    {
        return $this->clearpassword;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param string $usernickname
     */
    public function setUsernickname($usernickname)
    {
        $this->usernickname = $usernickname;
    }

    /**
     * @param string $clearpassword
     */
    public function setClearpassword($clearpassword)
    {
        $this->clearpassword = $clearpassword;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    
    
}

