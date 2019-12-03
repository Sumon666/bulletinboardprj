<?php

namespace App\Http\Controllers;

use App\Contracts\Services\User\UserServiceInterface;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Validator;

/**
 * SystemName : Bulletin Board System
 * ModuleName : User.
 */
class UserController extends Controller
{
    private $userService;

    /**
     * Create a new controller instance.
     *
     * @param UserServiceInterface $userService
     */
    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Clear the form data.
     *
     * @return \Illuminate\Http\Response
     */
    public function clearUserData(Request $request)
    {
        //clear user data
        $request->name = '';
        $request->email = '';
        $request->password = '';
        $request->confirm = '';
        $request->type = '';
        $request->phone = '';
        $request->address = '';
        $request->date = '';
        $request->image = '';

        return view('user.usercreate');
    }

    /**
     * Check validate usercreate data and pass data to confirm form.
     *
     * @param \App\User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function showUserData(Request $request)
    {
        if (empty($request->name) || empty($request->email) || empty($request->password) || empty($request->confirm)) {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required|string|min:8|regex:/^(?=S*[A-Z])(?=S*[0-9])/',
                'confirm' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect('usercreate')
                    ->withErrors($validator)
                    ->withInput();
            }
        } else {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = $request->password;
            $user->confirm = $request->confirm;
            $user->type = $request->type;
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->dob = $request->date;

            if (User::where('name', $request->name)->orwhere('email', $request->email)->exists()) {
                return redirect()->back()->with(['userError' => trans('messages.e_0007')])->withInput();
            }
            if (strcmp($request->get('password'), $request->get('confirm')) != 0) {
                //Confirm password and new password are not same
                return redirect()->back()->with(['userError' => trans('messages.e_0008')]);
            }

            if ($request->hasfile('image')) {
                $file = $request->file('image');
                $filename = $file->getClientOriginalName();
                $user->profile = $filename;
                request()->image->move(public_path('images'), $filename);
            }

            Session::put('Create', $user);
            $data = Session::get('Create');

            if (Session::has('Create')) {
                Session::put('New', $user);
                $data = Session::get('New');
            }

            return view('user.userconfirm')->with('udata', $data);
        }
    }

    /**
     * Show confirmation data on usercreate form when clicked cancel.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancelUserData(Request $request)
    {
        //cancelconfirmdata
        if (Session::has('Create')) {
            $data = Session::get('Create');
        } else {
            $data = Session::get('New');
        }

        return view('user.usercreate')->with('data', $data);
    }

    /**
     * Store new user data in db.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Session::has('Create')) {
            $data = Session::get('Create');
            $this->userService->addUser($data);
            Session::forget('Create');
        } elseif (Session::has('New')) {
            $data = Session::get('New');
            $this->userService->addUser($data);
            Session::forget('New');
        }

        return redirect('/userlist');
    }

    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUserList()
    {
        $name = Input::get('name');
        $email = Input::get('email');
        $sdate = Input::get('sdate');
        $edate = Input::get('edate');
        $data = array($name, $email, $sdate, $edate);

        if ($data[0] != null || $data[1] != null || $data[2] != null || $data[3] != null) {
            $ulist = $this->userService->searchUser($data);

            return view('user.userlist', ['data' => $ulist]);
        } elseif ($data[0] == null || $data[1] == null || $data[2] == null || $data[3] == null) {
            $ulist = $this->userService->getUserList();

            return view('user.userlist', ['data' => $ulist]);
        } else {
            return view('user.userlist')->with(['listInfo' => trans('messages.m_0001')])->withInput();
        }
    }

    /**
     * Remove user data.
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $this->userService->delete($id);

        return redirect('/userlist');
    }

    /**
     * Get user detail.
     *
     * @param $name
     *
     * @return \Illuminate\Http\Response
     */
    public function getUserDetail($name)
    {
        $dlist = $this->userService->getUserDetail($name);

        return view('user.userDetail', ['dlist' => $dlist]);
    }
}
