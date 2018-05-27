<?php
namespace AppBundle\Service;

use AppBundle\Entity\User;
use AppBundle\Domain\UserObject;

interface IUserService
{
    /**
     * @return User[]
     */
    public function getAllUsers();
    
    /**
     * @return User
     * @param integer $userId
     */
    public function getUserById($userId);
    
    /**
     * @return User
     * @param string $useremail
     */
    public function getUserByEmail($useremail);
    
    /**
     * @return User
     * @param string $usernickname
     */
    public function getUserByNickname($usernickname);
    
    /**
     * 
     * @param User $oneUser
     */
    public function saveUser($oneUser);
    
    /**
     * @param integer $userId
     */
    public function deleteUser($userId);
    
    /**
     * @param integer $userId
     */
    public function banUser($userId);
    
    /**
     * @return User
     * @param UserObject $user
     */
    public function convertUser($user);
}

