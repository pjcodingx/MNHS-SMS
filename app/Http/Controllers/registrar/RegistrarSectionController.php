<?php

namespace App\Http\Controllers\registrar;

use App\Models\Strand;
use App\Models\Section;
use App\Models\Student;
use App\Models\GradeLevel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RegistrarSectionController extends Controller
{
      public function index(Request $request)
    {
        $registrar = Auth::guard('registrar')->user();

        $grades = GradeLevel::orderBy('id')->get();
        $query = Section::with(['gradeLevel', 'strand']);

        // Filter by grade level
        if ($request->filled('grade_level_id')) {
            $query->where('grade_level_id', $request->grade_level_id);
        }

        // Filter by strand (for SHS)
        if ($request->filled('strand_id')) {
            $query->where('strand_id', $request->strand_id);
        }

        // Search by section name
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $query->orderBy('grade_level_id')->orderBy('name');

        $sections = $query->paginate(15)->withQueryString();
        $strands = Strand::all();

        return view('registrar.sections.index', compact('sections', 'grades', 'strands', 'registrar'));
    }

    // Show section details with students and subjects
    public function show(Section $section, Request $request)
    {
        $registrar = Auth::guard('registrar')->user();

        // Load section with relationships
        $section->load(['gradeLevel', 'strand', 'sectionSubjects.subject', 'sectionSubjects.adviser', 'sectionSubjects.schedule']);

        // Get students in this section
        $studentsQuery = Student::with('section')
            ->where('section_id', $section->id);

        // Search students
        if ($request->filled('search')) {
            $search = $request->search;
            $studentsQuery->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%$search%")
                  ->orWhere('last_name', 'like', "%$search%")
                  ->orWhere('lrn', 'like', "%$search%");
            });
        }

        // Filter by sex
        if ($request->filled('sex')) {
            $studentsQuery->where('sex', $request->sex);
        }

        $students = $studentsQuery->orderBy('last_name')->paginate(15)->withQueryString();

        // Get subjects assigned to this section
        $subjects = $section->sectionSubjects;

        return view('registrar.sections.show', compact('section', 'students', 'subjects', 'registrar'));
    }
}
