<?php
namespace AppBundle\Service;

use AppBundle\Entity\User;
use AppBundle\Domain\UserObject;

class UserService extends CrudService implements IUserService
{
    
    public function __construct($em, $form, $request)
    {
        parent::__construct($em, $form, $request);
    }

    public function getUserByEmail($useremail)
    {
        return $this->getRepo()->findOneBy(['user_email'=>$useremail]);
    }

    public function getAllUsers()
    {
        return $this->getRepo()->findAll();
    }

    public function getUserById($userId)
    {
        return $this->getRepo()->findOneBy(['id'=>$userId]);
    }
    
    public function getUserByNickname($usernickname)
    {
        return $this->getRepo()->findOneBy(['user_nickname'=>$usernickname]);
    }

    public function banUser($userId)
    {
        $user = $this->getUserById($userId);
        $user->setBanned(true);
        $this->saveUser($user);
    }

    public function deleteUser($userId)
    {}

    /**
     * @inheritdoc
     */
    public function convertUser($user)
    {
        $userEntity = new User();
        $userEntity->setUserEmail($user->getEmail());
        $userEntity->setUserNickname($user->getUsernickname());
        $userEntity->setUserBanned(false);
        $userEntity->setUserGroup("USER");
        
        return $userEntity;
        
    }

    public function saveUser($oneUser)
    {
        $this->em->persist($oneUser);
        $this->em->flush();
    }

    public function getRepo()
    {
        return $this->em->getRepository(User::class);
    }
}

