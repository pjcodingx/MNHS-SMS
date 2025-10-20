<?php

namespace App\Http\Controllers\registrar;

use App\Models\Section;
use App\Models\Student;
use App\Models\Subject;
use App\Models\GradeLevel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RegistrarSubjectController extends Controller
{
       public function index(Request $request)
    {
        $registrar = Auth::guard('registrar')->user();

        $query = Subject::with('gradeLevel')->orderBy('name');

        // Filter by grade level
        if ($request->filled('grade_level_id')) {
            $query->where('grade_level_id', $request->grade_level_id);
        }

        // Search by subject name
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $subjects = $query->paginate(15)->withQueryString();
        $gradeLevels = GradeLevel::all();

        return view('registrar.subjects.index', compact('subjects', 'gradeLevels', 'registrar'));
    }

    // Show students enrolled in a specific subject
    public function show(Subject $subject, Request $request)
    {
        $registrar = Auth::guard('registrar')->user();

        // Get all sections that offer this subject
        $sectionIds = \App\Models\SectionSubject::where('subject_id', $subject->id)
            ->pluck('section_id');

        // Query students in those sections
        $studentsQuery = Student::with(['section.gradeLevel'])
            ->whereIn('section_id', $sectionIds);

        // Filter by section if provided
        if ($request->filled('section_id')) {
            $studentsQuery->where('section_id', $request->section_id);
        }

        // Search students
        if ($request->filled('search')) {
            $search = $request->search;
            $studentsQuery->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%$search%")
                  ->orWhere('last_name', 'like', "%$search%")
                  ->orWhere('lrn', 'like', "%$search%");
            });
        }

        $students = $studentsQuery->orderBy('last_name')->paginate(15)->withQueryString();

        // Get sections for filter dropdown
        $sections = Section::with('gradeLevel')
            ->whereIn('id', $sectionIds)
            ->get();

        return view('registrar.subjects.show', compact('subject', 'students', 'sections', 'registrar'));
    }
}
