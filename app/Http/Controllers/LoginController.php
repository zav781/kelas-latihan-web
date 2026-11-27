<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('admin.home');
        }

        return view('login');
    }

    public function actionLogin(Request $request)
    {
        $credentials = [
            'email'    => $request->input('email'),
            'password' => $request->input('password'),
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            /** @var User $user */
            $user = Auth::user();
            $user->tokens()->where('name', 'web_admin_token')->delete();
            $token = $user->createToken('web_admin_token')->plainTextToken;
            session(['api_token' => $token]);

            return redirect()->intended(route('admin.home'));
        }

        Session::flash('error', 'Invalid Email or Password');

        return redirect('/login');
    }

    public function logout(Request $request)
    {
        if (Auth::check()) {
            Auth::user()->tokens()->where('name', 'web_admin_token')->delete();
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}