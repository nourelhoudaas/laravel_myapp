<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function ListeDepart()
    {
        return view('Department.list_depart');
    }

    //la page dashboard_depart.blade.php
    public function dashboard_depart()
    {
        return view('department.dashboard_depart');
    }
}
