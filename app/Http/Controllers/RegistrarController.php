<?php

namespace App\Http\Controllers;

use App\Models\Registrar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegistrarController extends Controller
{
    //
    public function dashboard(){
        return view('registrar.dashboard');
    }

    public function create(){
        $admin = Auth::guard('admin')->user();

        return view('admin.registrars.create', compact('admin'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:registrars',
            'password' => 'required|min:6|max:30|confirmed',
            'type' => 'required|in:JHS,SHS'
        ]);

        Registrar::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => $request->type

        ]);

        return redirect()->route('admin.dashboard') ->with('success', 'Registrar account created successfully.');
    }
}
