<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'name' => 'required|max:255',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6|max:255|confirmed',
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);
            session()->flash('success', "Registered successfully.");
            Auth::login($user);
            return redirect()->home();
        } else {
            return view('user.create');
        }

    }

    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                session()->flash('success', "Logged in successfully.");
                if (Auth::user()->is_admin) {
                    return redirect()->route('admin.admin.home');
                }
                return redirect()->home();
            }
            return redirect()->route('login')->with('error', 'Invalid login or password.');
        }

        return view('user.login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }


}
