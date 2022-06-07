<?php

namespace App\Dao\User;
use App\Models\User;
use App\Contract\Dao\User\UserDaoInterface;
use Illuminate\Support\Facades\Hash;

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

    /**
     * store user
     */
    public function storeCollectData($data)
    {
        if (!isset($data['created_user_id'])) 
        {
            //$data['created_user_id'] = auth()->user()->id;
            $data['created_user_id'] = 1;
            $data['password'] = Hash::make($data['password']);
            User::create($data);
            request()->session()->forget('user');
        } 
        else 
        {
            User::create($data);
        }
    }

    /**
     * delete user
     */
    public function deleteUser($id)
    {
        User::find($id)->delete();
    }
}