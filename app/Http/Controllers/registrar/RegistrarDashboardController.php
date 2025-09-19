<?php

namespace App\Http\Controllers\registrar;

use App\Models\Adviser;
use App\Models\Section;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RegistrarDashboardController extends Controller
{
    public function dashboard(){
        $registrar = Auth::guard('registrar')->user();

        $students = Student::count();
        $sections = Section::count();
        $advisers = Adviser::count();

        return view('registrar.dashboard', compact('registrar', 'students', 'sections', 'advisers'));
    }
}
