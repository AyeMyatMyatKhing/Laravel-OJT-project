<?php

namespace App\Contract\Dao\User;

interface UserDaoInterface
{
    //get user list
    public function getUserList();
    //create new user
    public function storeCollectData($data);
    //delete user
    public function deleteUser($id);
    //search user
    public function search($name,$email,$start_date,$end_date);
    //find user for update
    public function findUserById($id);
    //update user
    public function updateUser($data , $id);
    //user profile
    public function userProfile($id);
}