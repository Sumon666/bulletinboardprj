<?php

namespace App\Contracts\Dao\User;

use Illuminate\Http\Request;

interface UserDaoInterface
{
    //for new user
    public function addUser($data);
    //for show userlist
    public function getUserList();
    //for show userlist with search data
    public function searchUser(array $data);
    //for userDetail
    public function getUserDetail($name);
    //for user delete
    public function delete($id);
    //for user update
    public function updateuser($rows);
}
