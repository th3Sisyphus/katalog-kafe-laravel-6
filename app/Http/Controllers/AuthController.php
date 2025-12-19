<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request){
        if (!Auth::attempt(['email'=>$request->email, 'password' => $request->password])) {
            return redirect('/')->with('error', 'Login Failed!! Wrong email or password');
        } else{
            return redirect('/home')->with('success', 'Login Successful',['key' => 'home']);
        }  
    }
    public function logout(){
        Auth::logout();
        return redirect('/');
    }

    public function saveNewPass(Request $request){
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();

       if (!Hash::check($request->current_password, $user->password)) {
            return redirect('/changepassword')->with('error', 'Current password is incorrect.');
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect('/home')->with('success', 'Password changed successfully.',['key' => 'home']);
    }
    
}
