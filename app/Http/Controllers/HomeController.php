<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
        public function index()
    {
        return view('home');
    }
        public function menu()
    {
        return view('menu');
    }
        public function dashboard()
    {
        return view('dashboard');
    }
        public function cart()
    {
        return view('cart');
    }

        public function lokasi()
    {
        $user = Auth::user();
        return view('lokasi', compact('user'));
    }


}
