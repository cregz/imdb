<?php
namespace AppBundle\Converter;

use AppBundle\Domain\UserDTO;
use AppBundle\Entity\User;

class UserConverter
{

    /**
     * @return UserDTO
     * @param User $user
     */
    public function convertToDTO($user)
    {
        $userDTO = new UserDTO();
        $userDTO->setId($user->getId());
        $userDTO->setCreatedOn($user->getCreatedOn());
        $userDTO->setUpdatedAt($user->getUpdatedAt());
        $userDTO->setBanned($user->getUserBanned());
        $userDTO->setEmail($user->getUserEmail());
        $userDTO->setNickname($user->getUserNickname());
        
        return $userDTO;
    }
    
    /**
     * @return User
     * @param UserDTO $userDTO
     */
    public function convertToEntity($userDTO)
    {
        
    }
}

