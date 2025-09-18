<?php

namespace App\Http\Controllers\admin;

use App\Models\Subject;
use App\Models\GradeLevel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    public function index(Request $request){
        $admin = Auth::guard('admin')->user();
        $query = Subject::with('gradeLevel')->orderBy('id');


    if ($request->filled('grade_level_id')) {
        $query->where('grade_level_id', $request->grade_level_id);
    }


    $subjects = $query->paginate(10);
    $gradeLevels = GradeLevel::all();

    return view('admin.subjects.index', compact('subjects', 'admin', 'gradeLevels'));
    }

    public function create()
    {
         $admin = Auth::guard('admin')->user();

         $gradeLevels = GradeLevel::all();
        return view('admin.subjects.create',compact('admin', 'gradeLevels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:subjects,name',
            'grade_level_id' => 'required|exists:grade_levels,id',
        ]);


    Subject::create($request->only('name', 'grade_level_id'));

        return redirect()->route('admin.subjects.index')
                         ->with('success', 'Subject added successfully.');
    }

    public function edit(Subject $subject)
    {
         $admin = Auth::guard('admin')->user();
        $gradeLevels = GradeLevel::all();
        return view('admin.subjects.edit', compact('subject', 'gradeLevels', 'admin'));
    }

    public function update(Request $request, Subject $subject)
    {
         $request->validate([
        'name' => 'required|string|max:255',
        'grade_level_id' => 'required|exists:grade_levels,id',
    ]);

    $subject->update($request->only('name', 'grade_level_id'));

    return redirect()->route('admin.subjects.index')->with('success', 'Subject updated successfully!');
    }



}
