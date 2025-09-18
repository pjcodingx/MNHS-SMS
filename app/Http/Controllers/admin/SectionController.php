<?php

namespace App\Http\Controllers\admin;

use App\Models\Strand;
use App\Models\Section;
use App\Models\GradeLevel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SectionController extends Controller
{

    public function index(Request $request)
    {
        $admin = Auth::guard('admin')->user();



        $grades = GradeLevel::orderBy('id')->get();
        $query = Section::with(['gradeLevel', 'strand']);


        if($request->filled('grade_level_id')){
            $query->where('grade_level_id', $request->grade_level_id);
        }

        $query->orderBy('grade_level_id')->orderBy('name');

        $sections = $query->paginate(10)->withQueryString();


        return view('admin.sections.index', compact('sections', 'admin', 'grades'));
    }


    public function create()
    {
          $admin = Auth::guard('admin')->user();

        $grades = GradeLevel::all();
         $strands = Strand::all();
        return view('admin.sections.create', compact('grades','admin', 'strands'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'grade_level_id' => 'required|exists:grade_levels,id',
            'strand_id' => 'nullable|exists:strands,id',
        ]);

        $grade = GradeLevel::find($request->grade_level_id);
        if (in_array($grade->name, ['11', '12']) && !$request->strand_id) {
        return back()->withErrors(['strand_id' => 'Strand is required for Grade 11 and 12'])
                     ->withInput();
        }

        Section::create($request->only(['name', 'grade_level_id', 'strand_id']));


        return redirect()->route('admin.sections.index')->with('success', 'Section created successfully.');
    }

    //!FOR EDIT IMPLEMENT LATER
    public function edit(){
          $admin = Auth::guard('admin')->user();



        $sections = Section::with('gradeLevel')->get();
        return view('admin.sections.edit', compact('sections', 'admin'));
    }
}
