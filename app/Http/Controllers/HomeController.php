<?php

namespace App\Http\Controllers;

use Auth;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * SystemName : Bulletin Board System
 * ModuleName : User.
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Check validate data and change password.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function checkPassword(Request $request)
    {
        if (isset($request->current) || isset($request->new) || isset($request->confirm)) {
            if (!(Hash::check($request->get('current'), Auth::user()->password))) {
                // The passwords matches
                return redirect()->back()->with(['error' => trans('messages.e_0003')]);
            }

            if (strcmp($request->get('current'), $request->get('new')) == 0) {
                //old password and new password are same
                return redirect()->back()->with(['error' => trans('messages.e_0004')]);
            }

            if (strcmp($request->get('new'), $request->get('confirm')) != 0) {
                //Confirm password and new password are not same
                return redirect()->back()->with(['error' => trans('messages.e_0005')]);
            }
        } else {
            $validator = Validator::make($request->all(), [
                'current' => 'required',
                'new' => 'required|min:8|regex:/^(?=S*[A-Z])(?=S*[0-9])/',
                'confirm' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect('/changepassword')
                    ->withErrors($validator)
                    ->withInput();
            }
        }
        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new'));
        $user->save();

        return redirect('postlist')->with(['success' => trans('messages.m_0002')]);
    }

    /**
     * Clear the form data.
     *
     * @return \Illuminate\Http\Response
     */
    public function clearPassword(Request $request)
    {
        //clear password
        $request->current = '';
        $request->new = '';
        $request->confirm = '';

        return redirect('/changepassword');
    }
}
