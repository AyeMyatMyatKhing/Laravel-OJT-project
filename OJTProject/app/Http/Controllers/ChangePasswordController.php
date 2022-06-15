<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Auth;

class ChangePasswordController extends Controller
{
    /**
     * change password form
     */
    public function changePasswordForm()
    {
        return view('auth.passwords.change-password');
    }

    /**
     * change password
     */
    public function changePassword(Request $request)
    {
        //if current pwd is not same
        if(!(Hash::check($request-> oldPassword, Auth::user()->password)))
        {
            return redirect('/changepassword')->with('error', 'Your current password does not matches with the password.');
        }
        //if current pwd and new pwd is same
        if(strcmp($request->oldpassword , $request->get('new-password')) == 0)
        {
            return redirect('/changepassword')->with('error' , 'New password cannot be same with old password.');
        }

        $request->validate([
            'oldPassword' => 'required',
            'new-password' => 'required||min:8|regex:/^(?:(?=.*\d)(?=.*[A-Z]).*)$/',
            'confirm-new-password' => 'required|same:new-password',
        ]);

        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();

        return redirect('/users')->with('successAlert' , 'Password changed successfully.');
    }
}
