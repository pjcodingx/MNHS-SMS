<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FacultyController extends Controller
{
    //
    public function dashboard(){
        return view('faculty.dashboard');
    }
}
