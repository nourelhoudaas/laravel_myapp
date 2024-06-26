<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //la page home.blade.php
    public function home()
    {
        return view('home.home');
    }

    //la page about.blade.php
    public function about()
    {
        return view('home.about');
    }

    //la page dashboard.blade.php
    public function dashboard()
    {
        return view('home.dashboard');
    }

    

}

