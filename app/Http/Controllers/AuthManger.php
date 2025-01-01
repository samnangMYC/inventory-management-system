<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
class AuthManger extends Controller
{
    public function home() {
        return view('home'); 
    }
    public function login()
    { 
        if (Auth::check()){
            return redirect()->route('dashboard');
        }
        return view('auth/login');
    }
    public function register()
    {
        return view('auth/register');
    }
    function loginPost(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
    
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            return redirect()->intended(route('dashboard'));
        }
    
        return redirect(route('login'))->withErrors(['error' => 'Invalid login credentials']);
    }
    function registerPost(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = $request->password; // Assign the hashed password to the correct key
        $user = User::create($data);
        // Hash::make($request->password)
    
        if(!$user){
            return redirect(route('register'))->with("error","Failed to create account");
        }
        return redirect(route('login'))->with("success","Account created successfully. Please log in");
    }
    
    function logout() {
        Session::flush();
        Auth::logout();
        return redirect(route('login'));
    }
    function dashboard(){
        return view('dashboard');
    }
}
