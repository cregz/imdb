<?php
namespace AppBundle\Domain;

class UserDTO
{
    /**
     * 
     * @var integer
     */
    private $id;
    
    /**
     * 
     * @var \DateTime
     */
    private $createdOn;
    
    /**
     *
     * @var \DateTime
     */
    private $updatedAt;
    
    /**
     * 
     * @var string
     */
    private $email;
    
    /**
     * 
     * @var string
     */
    private $nickname;
    
    /**
     * @var boolean
     */
    private $banned;

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return sring
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * @return boolean
     */
    public function getBanned()
    {
        return $this->banned;
    }

    /**
     * @param integer $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param \DateTime $createdOn
     */
    public function setCreatedOn($createdOn)
    {
        $this->createdOn = $createdOn;
    }

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @param string $nickname
     */
    public function setNickname($nickname)
    {
        $this->nickname = $nickname;
    }

    /**
     * @param boolean $banned
     */
    public function setBanned($banned)
    {
        $this->banned = $banned;
    }

    public function __construct()
    {}
}

