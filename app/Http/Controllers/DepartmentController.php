<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function ListeDepart()
    {
        return view('Department.list_depart');
    }
}
