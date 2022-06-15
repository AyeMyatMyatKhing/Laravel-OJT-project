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
     * @param $data
     */
    public function storeCollectData($data)
    {
        if (!isset($data['created_user_id'])) 
        {
            $data['created_user_id'] = auth()->user()->id;
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
     * @param $id
     */
    public function deleteUser($id)
    {
        $data = User::find($id);
        $data['deleted_user_id'] = auth()->user()->id;
        $data->save();
        $data->delete();
    }

    /**
     * search user with name,email,start_date,end_date
     * @param $name,$email,$start_date,$end_date
     * @return $users
     */
    public function search($name,$email,$start_date,$end_date)
    {
        if($name == null && $email == null && $start_date == null && $end_date == null)
        {
            return $this->getUserList();
        }
        else
        {
            if(isset($name) && !empty($name))
            {
                $users = User::where('name' , 'like' , '%'.$name.'%')->simplePaginate(10)->withQueryString();
            }
            elseif(isset($email) && !empty($email))
            {
                $users = User::where('email' , 'like' ,'%'.$email.'%')->simplePaginate(10)->withQueryString();
            }
            elseif($start_date && $end_date)
            {
                $users = User::whereDate('created_at' , '>=' , $start_date)
                               ->whereDate('created_at','<=',$end_date)->simplePaginate(10)->withQueryString();
            }
            return $users;
        }
    }

    /**
     * get user for edit
     * @param $id
     * @return $users
     */
    public function findUserById($id)
    {
        return $users = User::find($id);
    }

    /**
     * update user
     * @param $id,$data
     */
    public function updateUser($data, $id)
    {
        if(!isset($data['updated_user_id']))
        {
            $data['updated_user_id'] = auth()->user()->id;
        }
        User::find($id)->update($data);
    }

    /**
     * user profile
     * @param $id
     */
    public function userProfile($id)
    {
        $user = User::find($id);
        return $user;
    }

}