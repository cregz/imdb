<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\MappedSuperclass 
 *  @ORM\HasLifecycleCallbacks()
 **/
abstract class BaseEntity
{
    /**
     * @ORM\Column(type="integer", options={"comment":"ID"} )
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="datetime", length=100, nullable=false, options={"comment":"Creation date"} )
     */
    protected $createdOn;
    
    /**
     * @ORM\Column(type="datetime", length=100, nullable=true, options={"comment":"Update date"} )
     */
    protected $updatedAt;
    
    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updateTimestamp()
    {
        if ($this->createdOn == null)
        {
            $this->createdOn = new \DateTime();
        }
    }
    
    /**
     * 
     * @return \DateTime
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
    }
    
    /**
     * 
     * @param \DateTime $createdOn
     */
    public function setCreatedOn($createdOn)
    {
        $this->createdOn=$createdOn;
    }
    
    /**
     * 
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
