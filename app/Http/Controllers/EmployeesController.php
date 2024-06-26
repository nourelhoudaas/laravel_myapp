<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    public function ListeEmply()
    {
        return view('employees.liste');
    }

    public function AddEmply()
    {
        return view('employees.add');
    }
}
