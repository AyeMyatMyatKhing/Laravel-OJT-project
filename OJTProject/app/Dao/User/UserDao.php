<?php

namespace App\Dao\User;
use App\Models\User;
use App\Contract\Dao\User\UserDaoInterface;

class UserDao implements UserDaoInterface
{
    /**
     * get user list
     */
    public function getUserList()
    {
        $users = User::with('createdUser')->latest()->simplePaginate(10);
        return $users;
    }
}