<?php

namespace App\Http\Controllers\registrar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RegistrarDashboardController extends Controller
{
    public function dashboard(){
        $registrar = Auth::guard('registrar')->user();

        return view('registrar.dashboard', compact('registrar'));
    }
}
