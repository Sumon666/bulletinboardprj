<?php

namespace App\Contracts\Services\User;

interface UserServiceInterface
{
    //for new user
    public function addUser($data);

    //for show userlist
    public function getUserList();

    //for show userlist with search data
    public function searchUser($data);

    //for userDetail
    public function getUserDetail($name);

    //for user delete
    public function delete($id);

    //for user update
    public function updateuser($rows);
}
