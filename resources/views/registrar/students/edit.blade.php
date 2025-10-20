@extends('layouts.registrar')
@section('content')
<div class="dashboard-content" style="max-width:650px; margin:40px auto; padding:0 20px;">
    <div style="background:white; border-radius:16px; box-shadow:0 4px 6px rgba(0,0,0,0.07), 0 1px 3px rgba(0,0,0,0.06); padding:40px;">
        <h2 style="color:#111827; margin:0 0 30px 0; font-size:28px; font-weight:700; letter-spacing:-0.5px;">Edit Student</h2>

        @if ($errors->any())
            <div style="background:#fef2f2; border-left:4px solid #ef4444; color:#991b1b; padding:16px 20px; border-radius:8px; margin-bottom:24px; box-shadow:0 1px 3px rgba(239,68,68,0.1);">
                <div style="font-weight:600; margin-bottom:8px; font-size:14px;">Please fix the following errors:</div>
                <ul style="margin:0; padding-left:20px; font-size:14px; line-height:1.6;">
                    @foreach ($errors->all() as $error)
                        <li style="margin:4px 0;">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('registrar.students.update', $student->id) }}" method="POST" style="display:flex; flex-direction:column; gap:20px;">
            @csrf
            @method('PUT')

            <div>
                <label style="display:block; color:#374151; font-weight:600; margin-bottom:8px; font-size:14px;">First Name</label>
                <input type="text" name="first_name" value="{{ old('first_name', $student->first_name) }}"
                    style="width:100%; padding:12px 16px; border:2px solid #e5e7eb; border-radius:10px; font-size:15px; transition:all 0.2s; box-sizing:border-box; outline:none;"
                    onfocus="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)';"
                    onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none';">
            </div>

            <div>
                <label style="display:block; color:#374151; font-weight:600; margin-bottom:8px; font-size:14px;">Middle Initial</label>
                <input type="text" name="middle_initial" value="{{ old('middle_initial', $student->middle_initial) }}"
                    style="width:100%; padding:12px 16px; border:2px solid #e5e7eb; border-radius:10px; font-size:15px; transition:all 0.2s; box-sizing:border-box; outline:none;"
                    onfocus="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)';"
                    onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none';">
            </div>

            <div>
                <label style="display:block; color:#374151; font-weight:600; margin-bottom:8px; font-size:14px;">Last Name</label>
                <input type="text" name="last_name" value="{{ old('last_name', $student->last_name) }}"
                    style="width:100%; padding:12px 16px; border:2px solid #e5e7eb; border-radius:10px; font-size:15px; transition:all 0.2s; box-sizing:border-box; outline:none;"
                    onfocus="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)';"
                    onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none';">
            </div>

            <div>
                <label style="display:block; color:#374151; font-weight:600; margin-bottom:8px; font-size:14px;">Sex</label>
                <select name="sex"
                    style="width:100%; padding:12px 16px; border:2px solid #e5e7eb; border-radius:10px; font-size:15px; transition:all 0.2s; box-sizing:border-box; outline:none; background:white; cursor:pointer;"
                    onfocus="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)';"
                    onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none';">
                    <option value="Male" {{ $student->sex == 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ $student->sex == 'Female' ? 'selected' : '' }}>Female</option>
                </select>
            </div>

            <div>
                <label style="display:block; color:#374151; font-weight:600; margin-bottom:8px; font-size:14px;">Section</label>
                <select name="section_id"
                    style="width:100%; padding:12px 16px; border:2px solid #e5e7eb; border-radius:10px; font-size:15px; transition:all 0.2s; box-sizing:border-box; outline:none; background:white; cursor:pointer;"
                    onfocus="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)';"
                    onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none';">
                    @foreach ($sections as $section)
                        <option value="{{ $section->id }}" {{ $student->section_id == $section->id ? 'selected' : '' }}>
                            {{ $section->gradeLevel->name ?? '' }} - {{ $section->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div style="display:flex; justify-content:flex-end; gap:12px; margin-top:12px; padding-top:20px; border-top:1px solid #e5e7eb;">
                <a href="{{ route('registrar.students.index') }}"
                   style="padding:12px 24px; border-radius:10px; border:2px solid #e5e7eb; background:white; color:#4b5563; text-decoration:none; font-weight:600; font-size:15px; transition:all 0.2s; display:inline-block;"
                   onmouseover="this.style.background='#f9fafb'; this.style.borderColor='#d1d5db';"
                   onmouseout="this.style.background='white'; this.style.borderColor='#e5e7eb';">
                    Cancel
                </a>
                <button type="submit"
                    style="padding:12px 28px; border-radius:10px; background:#3b82f6; color:white; border:none; font-weight:600; font-size:15px; cursor:pointer; transition:all 0.2s; box-shadow:0 2px 4px rgba(59,130,246,0.2);"
                    onmouseover="this.style.background='#2563eb'; this.style.boxShadow='0 4px 6px rgba(59,130,246,0.3)';"
                    onmouseout="this.style.background='#3b82f6'; this.style.boxShadow='0 2px 4px rgba(59,130,246,0.2)';">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
