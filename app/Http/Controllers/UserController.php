<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

 
class UserController extends Controller
{
    function loginform()
    {
        return view('login');
    }
    function registrasiform()
    {
        return view('registrasi');
    }

public function login(Request $request) {
        $request->validate([
                    'email' => 'required',
                    'password' => 'required',
                ], [
                    'email.required' => 'Email wajib diisi',
                    'password.required' => 'Password wajib diisi',
                ]);

        $credentials = [
                    'email' => $request->email,
                    'password' => $request->password,
                ];

        if (Auth::attempt($credentials)) { 
        return redirect('home');
        } else {
            return redirect()->back()->withErrors('Email/Username atau Password salah');
        }
}

    function registrasi(request $request)
    {
    $request->validate( [
        'username' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6'
    ]);

    $data = [
        'username'=> $request->username,
        'email'=> $request->email,
        'password'=> Hash::make($request->password)
    ];

    User::create($data);
    return redirect('login');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */

    /**
     * Store a newly created resource in storage.
     */


    /**
     * Display the specified resource.
     */
     function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
     function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        $user=Auth::user();
        auth()->logout();
        $user->delete();
        return redirect('/');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}

