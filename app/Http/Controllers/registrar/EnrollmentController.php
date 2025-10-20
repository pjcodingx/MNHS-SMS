<?php

namespace App\Http\Controllers\Registrar;

use App\Models\Section;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller
{
    public function index(Request $request){
        $registrar = Auth::guard('registrar')->user();
        $sections = Section::with('gradeLevel')->get();

        $query = Student::with(['section.gradeLevel', 'section.schedules.subject']);


        if ($request->filled('section_id')) {
            $query->where('section_id', $request->section_id);
        }


        if ($request->filled('sex')) {
            $query->where('sex', $request->sex);
        }


        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search){
                $q->where('first_name', 'like', "%$search%")
                ->orWhere('last_name', 'like', "%$search%")
                ->orWhere('middle_initial', 'like', "%$search%");
            });
        }

        $students = $query->paginate(15)->withQueryString(); // keeps filters on pagination

        return view('registrar.students.index', compact('students', 'sections', 'registrar'));
    }


    public function show(Student $student)
    {
        $registrar = Auth::guard('registrar')->user();
        $student->load(['section.gradeLevel', 'section.schedules.subject']);

        return view('registrar.students.show', compact('student', 'registrar'));
    }


    public function create(){
        $registrar = Auth::guard('registrar')->user();
        $sections = Section::with(['gradeLevel', 'schedules.subject'])->get();

            return view('registrar.enrollment.create', compact('sections', 'registrar'));

    }

    public function store(Request $request){
         $request->validate([
            'lrn' => 'required|string|unique:students,lrn',
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'middle_initial' => 'nullable|string|max:1',
            'sex' => 'required|in:Male,Female',
            'section_id' => 'required|exists:sections,id',
        ]);

        Student::create([
            'lrn' => $request->lrn,
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'middle_initial' => $request->middle_initial,
            'sex' => $request->sex,
            'section_id' => $request->section_id,

        ]);

        return redirect()->route('registrar.enrollment.index')
                         ->with('success', 'Student enrolled successfully.');
    }


    public function edit($id)
        {
            $registrar = Auth::guard('registrar')->user();
            $student = Student::with('section.gradeLevel')->findOrFail($id);
            $sections = Section::with('gradeLevel')->get();

            return view('registrar.students.edit', compact('student', 'sections', 'registrar'));
        }

        public function update(Request $request, $id)
        {
            $student = Student::findOrFail($id);

            $request->validate([
                'first_name' => 'required|string|max:255',
                'middle_initial' => 'nullable|string|max:10',
                'last_name' => 'required|string|max:255',
                'sex' => 'required|in:Male,Female',
                'section_id' => 'required|exists:sections,id',
            ]);

            $student->update($request->only(['first_name', 'middle_initial', 'last_name', 'sex', 'section_id']));

            return redirect()->route('registrar.students.index')->with('success', 'Student updated successfully.');
        }


}
