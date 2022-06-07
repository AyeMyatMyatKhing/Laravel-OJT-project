<?php

namespace App\Service\User;

use App\Contract\Service\User\UserServiceInterface;
use App\Dao\User\UserDao;

class UserService implements UserServiceInterface
{
    private $userDao;

    public function __construct(UserDao $user_dao)
    {
        $this->userDao = $user_dao;
    }

    /**
     * get user list
     */
    public function getUserList()
    {
        return $this->userDao->getUserList();
    }
}