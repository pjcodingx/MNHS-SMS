<?php

namespace App\Http\Controllers\admin;

use App\Models\Section;
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
                'name' => 'required',
                'grade_level_id' => 'required|exists:grade_levels,id',
            ], [
                'name.required' => 'Subject name is required.',
                'grade_level_id.required' => 'Please select a grade level.',
            ]);
        $exists = Subject::where('name', $request->name)
                        ->where('grade_level_id', $request->grade_level_id)
                        ->exists();

        if ($exists) {
            return back()->withErrors(['name' => 'This subject already exists in the selected grade level.'])
                        ->withInput();
        }



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

    public function show(Subject $subject, Request $request)
{
    $admin = Auth::guard('admin')->user();

    // Filters
    $gradeLevelId = $request->input('grade_level_id');
    $sectionId = $request->input('section_id');

    // Get all grade levels and sections for filters
    $gradeLevels = GradeLevel::all();
    $sections = Section::when($gradeLevelId, function($query) use ($gradeLevelId) {
        $query->where('grade_level_id', $gradeLevelId);
    })->get();

    // Base query for students enrolled in this subject
    $studentsQuery = $subject->students()->with('section.gradeLevel');

    // Apply filters if provided
    if ($gradeLevelId) {
        $studentsQuery->whereHas('section', function($q) use ($gradeLevelId) {
            $q->where('grade_level_id', $gradeLevelId);
        });
    }

    if ($sectionId) {
        $studentsQuery->where('section_id', $sectionId);
    }

    $students = $studentsQuery->paginate(10);

    return view('admin.subjects.show', compact('admin', 'subject', 'students', 'gradeLevels', 'sections'));
}

}
