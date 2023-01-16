<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(){
        return view('menu.login');
    }

    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if(auth()->user()->role == 'dosen'){

                return redirect()->intended('dosen/dashboard');
            }
            elseif(auth()->user()->role == 'tu'){
                return redirect()->intended('tu/dashboard');
            }
            elseif(auth()->user()->role == 'mahasiswa'){
                return redirect()->intended('mahasiswa/dashboard');
            }
            elseif(auth()->user()->role == 'kepala'){
                return redirect()->intended('kepala/dashboard');
            }
            else{
                return redirect()->intended('root/dashboard');
            }

        }

        return back()->withErrors('Login gagal!');
    }

    public function logout(Request $request){
        
        Auth::logout();

        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
    }
}
