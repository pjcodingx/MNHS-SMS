<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //
    public function dashboard(){

        $admin = Auth::guard('admin')->user();
        return view('admin.dashboard', compact('admin'));
    }



}
