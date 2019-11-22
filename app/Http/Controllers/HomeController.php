<?php

namespace App\Http\Controllers;

use Log;
use Auth;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware(['auth', 'verified']);
        $this->middleware('auth');
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
     * Check validate data and change password
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function checkpassword(Request $request)
    {
        if (isset($request->current) && isset($request->new)) {
            if (!(Hash::check($request->get('current'), Auth::user()->password))) {
                // The passwords matches
                return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
            }

            if(strcmp($request->get('current'), $request->get('new')) == 0){
                //old password and new password are same
                return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
            }

            if (strcmp($request->get('new'), $request->get('confirm')) != 0){
                //Confirm password and new password are not same
                return redirect()->back()->with("error","New Password and Confirm password must be same.");
            }

        }
        else {
            $validator = Validator::make($request->all(), [
                'current' => 'required',
                'new' => 'required|min:8|regex:/^(?=S*[A-Z])(?=S*[0-9])/',
                'confirm' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect('changePassword')
                    ->withErrors($validator)
                    ->withInput();
            }
        }
        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new'));
        $user->save();

        return redirect('postlist')->with("success","Password changed successfully !");
    }

    /**
     * Clear the form data.
     *
     * @return \Illuminate\Http\Response
     */
    public function clearpassword(Request $request)
    {
        //clear password
        $request->current = '';
        $request->new = '';
        $request->confirm = '';
        return redirect('/changePassword');
    }

}
