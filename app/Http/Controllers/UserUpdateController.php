<?php

namespace App\Http\Controllers;

use App\User;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Contracts\Services\User\UserServiceInterface;

/**
 * SystemName : Bulletin Board System
 * ModuleName : User.
 */
class UserUpdateController extends Controller
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
     * Show list specified data on user update form.
     *
     * @param \App\Posts $pdata
     *
     * @return \Illuminate\Http\Response
     */
    public function showUpdateUser($id)
    {
        $user = User::find($id);
        Session::put('Clear', $user);

        return view('user.userupdate', ['user' => $user]);
    }

    /**
     * Check validate data on user update form.
     *
     * @param \App\User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function showUpdateConfirm(Request $request)
    {
        if (empty($request->name) || empty($request->email) || empty($request->phone)) {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email',
                'phone' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect('/userupdate')
                    ->withErrors($validator)
                    ->withInput();
            }
        } else {
            $user = new User();
            $user->id = $request->userId;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->type = $request->type;
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->dob = $request->date;

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

            return view('user.userupdateconfirm')->with('udata', $data);
        }
    }

    /**
     * Update created user data in db.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function updateUserData(Request $request)
    {
        if (Session::has('Create')) {
            $rows = Session::get('Create');
            $this->userService->updateuser($rows);
            Session::forget('Create');
        } elseif (Session::has('New')) {
            $rows = Session::get('New');
            $this->userService->updateuser($rows);
            Session::forget('New');
        }

        return redirect('/userlist');
    }

    /**
     * Show confirmation data on usercreate form when clicked cancel.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancelUpdateData(Request $request)
    {
        //cancelupdatedata
        if (Session::has('Create')) {
            $data = Session::get('Create');
        } else {
            $data = Session::get('New');
        }

        return view('user.userupdate', ['user' => $data]);
    }

    /**
     * Clear the form data.
     *
     * @return \Illuminate\Http\Response
     */
    public function clearUpdateData(Request $request)
    {
        //clear user update data
        $cedit = Session::get('Clear');
        $cedit->profile = '';
        $cedit->name = '';
        $cedit->email = '';
        $cedit->phone = '';
        $cedit->dob = '';
        $cedit->address = '';
        Session::forget('Clear');

        return view('user.userupdate', ['user' => $cedit]);
    }
}
