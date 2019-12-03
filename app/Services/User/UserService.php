<?php

namespace App\Services\User;

use App\Contracts\Dao\User\UserDaoInterface;
use App\Contracts\Services\User\UserServiceInterface;
use App\User;
use Illuminate\Http\Request;

class UserService implements UserServiceInterface
{
    private $userDao;

    /**
     * Constructor.
     *
     * @param UserDaoInterface $userDao
     */
    public function __construct(UserDaoInterface $userDao)
    {
        $this->userDao = $userDao;
    }

    /**
     * Get User List.
     *
     * @param Request $request
     *
     * @return $request
     */
    public function addUser($data)
    {
        return $this->userDao->addUser($data);
    }

    /**
     * Get User List.
     *
     * @param
     *
     * @return $ulist
     */
    public function getUserList()
    {
        return $this->userDao->getUserList();
    }

    /**
     * Get User List.
     *
     * @param $data
     *
     * @return $ulist
     */
    public function searchUser($data)
    {
        return $this->userDao->searchUser($data);
    }

    /**
     * Delete User.
     *
     * @param $id
     *
     * @return
     */
    public function delete($id)
    {
        return $this->userDao->delete($id);
    }

    /**
     * Get User detail.
     *
     * @param $name
     *
     * @return $dlist
     */
    public function getUserDetail($name)
    {
        return $this->userDao->getUserDetail($name);
    }

    /**
     * Update user data.
     *
     * @param Request $request
     *
     * @return $request
     */
    public function updateuser($rows)
    {
        return $this->userDao->updateuser($rows);
    }
}
