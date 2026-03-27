<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function registerPost(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6'

        ]);
    
    $user = User::create([
        'name'=>$request->name,
        'email'=>$request->email,
        'password'=>Hash::make($request->password)

    ]);

    Auth::login($user);
        return redirect('/')->with('success' , 'เข้าสู่ระบบสำเร็จ');
    }
    public function loginPost(Request $request)
    {
        $credentials = $request->only('email','passwrod');

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect('/')->with('success', 'เข้าสู่ระบบสำเร็จ');
        }
        return back()->with('error', 'อีเมลหรือรหัสผ่านไม่ถูกต้อง');
    } 
    public function logoutPost(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
