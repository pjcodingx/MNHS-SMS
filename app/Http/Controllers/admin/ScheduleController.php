<?php

namespace App\Http\Controllers\admin;

use App\Models\Section;
use App\Models\Subject;
use App\Models\Schedule;
use App\Models\GradeLevel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    public function index()
    {
        $admin = Auth::guard('admin')->user();
        $schedules = Schedule::with('gradeLevel','subject')->paginate(10);
        return view('admin.schedules.index', compact('schedules', 'admin'));
    }

    public function create()
    {
         $admin = Auth::guard('admin')->user();
        $grades = GradeLevel::all();
        $subjects = Subject::all();
         $advisers = \App\Models\Adviser::orderBy('name')->get();
        $sections = Section::with('gradeLevel')->get();
         $schedules = Schedule::all();
        return view('admin.schedules.create', compact('grades','subjects', 'admin','sections', 'advisers', 'schedules'));
    }

    public function store(Request $request)
    {
        $request->validate([
             'section_id' => 'required|exists:sections,id',
            'grade_level_id' => 'required|exists:grade_levels,id',
            'subject_id' => 'nullable|exists:subjects,id',
            'days' => 'required|array|min:1',
            'time_start' => 'required',
            'time_end' => 'required|after:time_start',
        ]);

        Schedule::create([
             'section_id' => $request->section_id,
            'grade_level_id' => $request->grade_level_id,
            'subject_id' => $request->subject_id,
            'days' => $request->days,
            'time_start' => $request->time_start,
            'time_end' => $request->time_end,
        ]);

        return redirect()->route('admin.schedules.index')->with('success', 'Schedule created successfully.');
    }

    public function edit(Schedule $schedule)
    {
        $grades = GradeLevel::all();
        $subjects = Subject::all();
        return view('admin.schedules.edit', compact('schedule','grades','subjects'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        $request->validate([
            'grade_level_id' => 'required|exists:grade_levels,id',
            'subject_id' => 'nullable|exists:subjects,id',
            'days' => 'required|array|min:1',
            'time_start' => 'required',
            'time_end' => 'required|after:time_start',
        ]);

        $schedule->update([
            'grade_level_id' => $request->grade_level_id,
            'subject_id' => $request->subject_id,
            'days' => $request->days,
            'time_start' => $request->time_start,
            'time_end' => $request->time_end,
        ]);

        return redirect()->route('admin.schedules.index')->with('success', 'Schedule updated successfully.');
    }

}
