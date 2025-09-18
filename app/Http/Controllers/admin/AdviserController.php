<?php

namespace App\Http\Controllers\admin;

use App\Models\Adviser;
use App\Models\GradeLevel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdviserController extends Controller
{
     public function index(Request $request)
    {
        $admin = Auth::guard('admin')->user();

    $advisers = Adviser::orderBy('id')->paginate(10);

    return view('admin.advisers.index', compact('advisers', 'admin'));
    }


    public function create()
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.advisers.create', compact('admin'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        Adviser::create($request->only('name'));

        return redirect()->route('admin.advisers.index')
                         ->with('success', 'Adviser added successfully!');
    }

    public function edit(Adviser $adviser)
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.advisers.edit', compact('adviser', 'admin'));
    }

    public function update(Request $request, Adviser $adviser)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $adviser->update($request->only('name'));

        return redirect()->route('admin.advisers.index')
                         ->with('success', 'Adviser updated successfully!');
    }


}
