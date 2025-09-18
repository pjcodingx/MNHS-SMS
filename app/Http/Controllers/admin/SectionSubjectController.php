<?php

namespace App\Http\Controllers\Admin;

use App\Models\Adviser;
use App\Models\Section;
use App\Models\Subject;
use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Models\SectionSubject;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SectionSubjectController extends Controller
{
    public function index(Request $request){
        $admin = Auth::guard('admin')->user();

        $sections = Section::all();

    $query = SectionSubject::with(['section', 'subject', 'adviser', 'schedule']);


        if($request->filled('section_id')){
            $query->where('section_id', $request->section_id);
        }

    $assignments = $query->paginate(10);

    return view('admin.section_subjects.index', compact('assignments', 'sections','admin'));

    }

     public function create()
    {
         $admin = Auth::guard('admin')->user();
        $sections = Section::all();
         $subjects = Subject::all();
        $advisers = Adviser::all();
        $schedules = Schedule::all();

        return view('admin.section_subjects.create', compact('sections','subjects','advisers','schedules', 'admin'));
    }

     public function store(Request $request)
    {
        $request->validate([
            'section_id' => 'required|exists:sections,id',
            'subject_id' => 'required|exists:subjects,id',
            'adviser_id' => 'required|exists:advisers,id',
            'schedule_id' => 'required|exists:schedules,id',
        ]);

        SectionSubject::create($request->all());

        return redirect()->route('admin.section_subjects.index')->with('success', 'Assignment created successfully.');
    }

     public function edit(SectionSubject $sectionSubject)
    {
        $sections = Section::all();
        $subjects = Subject::all();
        $advisers = Adviser::all();
        $schedules = Schedule::all();

        return view('admin.section_subjects.edit', compact('sectionSubject','sections','subjects','advisers','schedules'));
    }

       public function update(Request $request, SectionSubject $sectionSubject)
    {
        $request->validate([
            'section_id' => 'required|exists:sections,id',
            'subject_id' => 'required|exists:subjects,id',
            'adviser_id' => 'required|exists:advisers,id',
            'schedule_id' => 'required|exists:schedules,id',
        ]);

        $sectionSubject->update($request->all());

        return redirect()->route('admin.section_subjects.index')->with('success', 'Assignment updated successfully.');
    }



}
