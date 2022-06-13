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

    /**
     * store new user
     */
    public function storeCollectData($data)
    {
        $this->userDao->storeCollectData($data);
    }

    public function deleteUser($id)
    {
        $this->userDao->deleteUser($id);
    }

    /**
     * search user
     * @param $name,$email,$start_date,$end_date
     * @return user $user
     */
    public function search($name,$email,$start_date,$end_date)
    {
        return $this->userDao->search($name,$email,$start_date,$end_date);
    }

    /**
     * get user for update
     * @param $id
     * @return $users
     */
    public function findUserById($id)
    {
        return $this->userDao->findUserById($id);
    }

    /**
     * update user
     * @param $data,$id
     */
    public function updateUser($data ,$id)
    {
        $this->userDao->updateUser($data, $id);
    }

    /**
     * user profile
     * @param $id
     */
    public function userProfile($id)
    {
        return $this->userDao->userProfile($id);
    }
}