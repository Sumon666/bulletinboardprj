<?php

namespace App\Dao\User;

use App\User;
use Auth;
use Config;
use Log;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Contracts\Dao\User\UserDaoInterface;

class UserDao implements UserDaoInterface
{
    /**
     * Add new user
     * @param $data
     * @return
     */
    public function addUser($data)
    {
        $user = new User();
        $user->name = $data->name;
        $user->email = $data->email;
        $user->password = bcrypt($data->password);
        if ($data->type=="Admin") {
            $user->type = 0;
        }
        else {
            $user->type = 1;
        }
        $user->phone = $data->phone;
        $user->dob = $data->dob;
        $user->address = $data->address;
        $user->profile = $data->profile;
        $user->create_user_id = auth()->user()->id;
        $user->updated_user_id = auth()->user()->id;
        $user->created_at = new DateTime('now');
        $user->updated_at = new DateTime('now');
        $user->save();
    }

    /**
     * Get User List
     * @param
     * @return $ulist
     */
    public function getUserList()
    {
        return $ulist = User::whereNull('deleted_at')->paginate(Config::get('constants.pagination.userpaginate'));
    }

    /**
     * Get search user
     * @param $data
     * @return
     */
    public function searchUser(array $data)
    {
        $name = $data[0];
        $email = $data[1];
        $sdate = $data[2];
        $edate = $data[3];

        $ulist = User::whereNull('deleted_at')
            ->where('name', 'LIKE', '%' . $name . '%')
            ->where('email', 'LIKE', '%' . $email . '%')
            ->where('created_at', 'LIKE', '%' . $sdate . '%')
            ->where('created_at', 'LIKE', '%' . $edate . '%')
            ->paginate(Config::get('constants.pagination.userpaginate'));

        return $ulist;
    }

    /**
     * Delete User
     * @param $id
     * @return
     */
    public function delete($id)
    {
        $result = User::find($id);
        $result->deleted_user_id = auth()->user()->id;
        $result->deleted_at = new DateTime('now');
        $result->save();
    }

    /**
     * Get User detail
     * @param $name
     * @return $dlist
     */
    public function getUserDetail($name)
    {
        return $dlist = User::where('name', $name)->get();
    }

    /**
     * Update user
     * @param $rows
     * @return
     */
    public function updateuser($rows)
    {
        $id = $rows->id;
        $editrows = User::find($id);
        $editrows->name = $rows->name;
        $editrows->email = $rows->email;
        if ($rows->type=="Admin") {
            $editrows->type = 0;
        }
        else {
            $editrows->type = 1;
        }
        $editrows->phone = $rows->phone;
        $editrows->dob = $rows->dob;
        $editrows->address = $rows->address;
        $editrows->profile = $rows->profile;
        $editrows->updated_user_id = auth()->user()->id;
        $editrows->updated_at = new DateTime('now');
        $editrows->save();
    }
}
