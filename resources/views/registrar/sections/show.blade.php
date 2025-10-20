@extends('layouts.registrar')
@section('content')
<div class="dashboard-content">
    <div style="background:white; border-radius:15px; box-shadow:0 5px 20px rgba(0,0,0,0.1); padding:30px;">

        <!-- Back Button & Header -->
        <div style="margin-bottom:30px;">
            <a href="{{ route('registrar.sections.index') }}"
                style="display:inline-flex; align-items:center; color:#3b82f6; text-decoration:none; font-weight:600; margin-bottom:20px; transition:all 0.3s;"
                onmouseover="this.style.color='#2563eb'; this.style.transform='translateX(-5px)'"
                onmouseout="this.style.color='#3b82f6'; this.style.transform='translateX(0)'">
                <i class="fas fa-arrow-left" style="margin-right:8px;"></i>
                Back to Sections
            </a>

            <div style="display:flex; justify-content:space-between; align-items:start; padding-bottom:20px; border-bottom:2px solid #e5e7eb;">
                <div>
                    <h2 style="color:#1f2937; font-size:28px; font-weight:700; margin-bottom:10px;">
                        <i class="fas fa-door-open" style="color:#3b82f6; margin-right:10px;"></i>
                        Section {{ $section->name }}
                    </h2>
                    <div style="display:flex; gap:15px; align-items:center; flex-wrap:wrap;">
                        <span style="display:inline-flex; align-items:center; background:#dbeafe; color:#1e40af; padding:6px 14px; border-radius:20px; font-size:13px; font-weight:600;">
                            <i class="fas fa-layer-group" style="margin-right:6px;"></i>
                            {{ $section->gradeLevel->name ?? 'N/A' }}
                        </span>
                        @if($section->strand)
                            <span style="display:inline-flex; align-items:center; background:#fef3c7; color:#92400e; padding:6px 14px; border-radius:20px; font-size:13px; font-weight:600;">
                                <i class="fas fa-stream" style="margin-right:6px;"></i>
                                {{ $section->strand->name }}
                            </span>
                        @endif
                        <span style="color:#6b7280; font-size:14px;">
                            <i class="fas fa-users" style="color:#3b82f6; margin-right:5px;"></i>
                            <strong>{{ $students->total() }}</strong> Total {{ Str::plural('Student', $students->total()) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Subjects Section -->
        @if($subjects->count() > 0)
            <div style="background:#f0f9ff; border:2px solid #bfdbfe; border-radius:12px; padding:20px; margin-bottom:30px;">
                <h3 style="color:#1e40af; font-size:18px; font-weight:600; margin-bottom:15px;">
                    <i class="fas fa-book" style="margin-right:8px;"></i>
                    Subjects Assigned to this Section
                </h3>
                <div style="display:grid; grid-template-columns:repeat(auto-fill, minmax(250px, 1fr)); gap:15px;">
                    @foreach($subjects as $sectionSubject)
                        <div style="background:white; border:1px solid #bfdbfe; border-radius:10px; padding:15px;">
                            <div style="display:flex; align-items:start; justify-content:space-between; margin-bottom:10px;">
                                <div style="flex:1;">
                                    <h4 style="color:#1f2937; font-weight:600; font-size:15px; margin-bottom:5px;">
                                        {{ $sectionSubject->subject->name ?? 'N/A' }}
                                    </h4>
                                    @if($sectionSubject->adviser)
                                        <p style="color:#6b7280; font-size:13px; margin-bottom:3px;">
                                            <i class="fas fa-chalkboard-teacher" style="color:#3b82f6; margin-right:5px;"></i>
                                            {{ $sectionSubject->adviser->name ?? 'N/A' }}
                                        </p>
                                    @endif
                                    @if($sectionSubject->schedule && ($sectionSubject->schedule->day || $sectionSubject->schedule->time))
                                        <p style="color:#6b7280; font-size:12px;">
                                            <i class="fas fa-clock" style="color:#3b82f6; margin-right:5px;"></i>
                                            {{ trim(($sectionSubject->schedule->day ?? '') . ' ' . ($sectionSubject->schedule->time ?? '')) }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Students Section Header -->
        <h3 style="color:#1f2937; font-size:20px; font-weight:600; margin-bottom:20px;">
            <i class="fas fa-users" style="color:#3b82f6; margin-right:8px;"></i>
            Students in this Section
        </h3>

        <!-- Filters Section -->
        <form method="GET" action="{{ route('registrar.sections.show', $section->id) }}" style="background:#f9fafb; padding:20px; border-radius:12px; margin-bottom:25px;">
            <div style="display:grid; grid-template-columns:1fr 1fr auto; gap:15px; align-items:end;">

                <!-- Sex Filter -->
                <div>
                    <label style="display:block; color:#374151; font-weight:600; margin-bottom:8px; font-size:14px;">
                        <i class="fas fa-venus-mars" style="margin-right:5px;"></i>
                        Filter by Sex
                    </label>
                    <select name="sex"
                        style="width:100%; padding:10px 14px; border:2px solid #e5e7eb; border-radius:8px; font-size:14px; background:white; cursor:pointer; outline:none;"
                        onchange="this.form.submit()">
                        <option value="">All</option>
                        <option value="Male" {{ request('sex') == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ request('sex') == 'Female' ? 'selected' : '' }}>Female</option>
                    </select>
                </div>

                <!-- Search Box -->
                <div>
                    <label style="display:block; color:#374151; font-weight:600; margin-bottom:8px; font-size:14px;">
                        <i class="fas fa-search" style="margin-right:5px;"></i>
                        Search Student
                    </label>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Search by name or LRN..."
                        style="width:100%; padding:10px 14px; border:2px solid #e5e7eb; border-radius:8px; font-size:14px; outline:none;">
                </div>

                <!-- Buttons -->
                <div style="display:flex; gap:10px;">
                    <button type="submit"
                        style="padding:10px 20px; background:#3b82f6; color:white; border:none; border-radius:8px; font-weight:600; cursor:pointer; transition:all 0.3s;"
                        onmouseover="this.style.background='#2563eb'"
                        onmouseout="this.style.background='#3b82f6'">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                    @if(request()->hasAny(['sex', 'search']))
                        <a href="{{ route('registrar.sections.show', $section->id) }}"
                            style="padding:10px 20px; background:#6b7280; color:white; border:none; border-radius:8px; font-weight:600; text-decoration:none; display:flex; align-items:center; transition:all 0.3s;"
                            onmouseover="this.style.background='#4b5563'"
                            onmouseout="this.style.background='#6b7280'">
                            <i class="fas fa-times"></i> Clear
                        </a>
                    @endif
                </div>
            </div>
        </form>

        <!-- Students Table -->
        @if($students->count() > 0)
            <div style="overflow-x:auto; border-radius:12px; border:1px solid #e5e7eb;">
                <table style="width:100%; border-collapse:collapse;">
                    <thead>
                        <tr style="background:linear-gradient(135deg, #3b82f6, #1d4ed8);">
                            <th style="padding:16px 20px; text-align:left; color:white; font-weight:600; font-size:14px; text-transform:uppercase; letter-spacing:0.5px;">
                                LRN
                            </th>
                            <th style="padding:16px 20px; text-align:left; color:white; font-weight:600; font-size:14px; text-transform:uppercase; letter-spacing:0.5px;">
                                Student Name
                            </th>
                            <th style="padding:16px 20px; text-align:left; color:white; font-weight:600; font-size:14px; text-transform:uppercase; letter-spacing:0.5px;">
                                Sex
                            </th>
                            <th style="padding:16px 20px; text-align:center; color:white; font-weight:600; font-size:14px; text-transform:uppercase; letter-spacing:0.5px;">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $student)
                            <tr style="border-bottom:1px solid #e5e7eb; transition:all 0.2s;"
                                onmouseover="this.style.background='#f9fafb'"
                                onmouseout="this.style.background='white'">
                                <td style="padding:16px 20px; color:#6b7280; font-size:14px;">
                                    {{ $student->lrn }}
                                </td>
                                <td style="padding:16px 20px;">
                                    <div style="display:flex; align-items:center; gap:12px;">
                                        <div style="width:40px; height:40px; background:linear-gradient(135deg, #3b82f6, #1d4ed8); border-radius:50%; display:flex; align-items:center; justify-content:center; color:white; font-weight:600; font-size:14px;">
                                            {{ substr($student->first_name, 0, 1) }}{{ substr($student->last_name, 0, 1) }}
                                        </div>
                                        <div>
                                            <div style="color:#1f2937; font-weight:600; font-size:15px;">
                                                {{ $student->last_name }}, {{ $student->first_name }} {{ $student->middle_initial }}.
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td style="padding:16px 20px; color:#6b7280; font-size:14px;">
                                    <span style="display:inline-flex; align-items:center; padding:4px 10px; border-radius:12px; font-size:12px; font-weight:600;
                                        {{ $student->sex == 'Male' ? 'background:#dbeafe; color:#1e40af;' : 'background:#fce7f3; color:#9f1239;' }}">
                                        <i class="fas fa-{{ $student->sex == 'Male' ? 'mars' : 'venus' }}" style="margin-right:4px;"></i>
                                        {{ $student->sex }}
                                    </span>
                                </td>
                                <td style="padding:16px 20px; text-align:center;">
                                    <a href="{{ route('registrar.students.show', $student->id) }}"
                                        style="display:inline-flex; align-items:center; padding:8px 16px; background:#3b82f6; color:white; text-decoration:none; border-radius:8px; font-size:13px; font-weight:600; transition:all 0.3s;"
                                        onmouseover="this.style.background='#2563eb'; this.style.transform='translateY(-2px)'"
                                        onmouseout="this.style.background='#3b82f6'; this.style.transform='translateY(0)'">
                                        <i class="fas fa-eye" style="margin-right:6px;"></i>
                                        View
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div style="margin-top:25px;">
                <div style="color:#6b7280; font-size:14px; margin-bottom:15px; text-align:center;">
                    Showing {{ $students->firstItem() }} to {{ $students->lastItem() }} of {{ $students->total() }} students
                </div>
                <div style="display:flex; justify-content:center; align-items:center; gap:5px;">
                    @if ($students->onFirstPage() == false)
                        <a href="{{ $students->previousPageUrl() }}"
                        style="padding:10px 16px; border-radius:8px; border:2px solid #3b82f6; background:white; color:#3b82f6; text-decoration:none; font-weight:600; transition:all 0.3s;"
                        onmouseover="this.style.background='#3b82f6'; this.style.color='white'"
                        onmouseout="this.style.background='white'; this.style.color='#3b82f6'">
                            &laquo; Prev
                        </a>
                    @endif

                    @foreach ($students->getUrlRange(1, $students->lastPage()) as $page => $url)
                        <a href="{{ $url }}"
                        style="padding:10px 16px; border-radius:8px; border:2px solid #3b82f6;
                                {{ $students->currentPage() == $page ? 'background:#3b82f6; color:white;' : 'background:white; color:#3b82f6;' }}
                                text-decoration:none; font-weight:600; transition:all 0.3s;"
                        @if($students->currentPage() != $page)
                            onmouseover="this.style.background='#eff6ff'"
                            onmouseout="this.style.background='white'"
                        @endif>
                            {{ $page }}
                        </a>
                    @endforeach

                    @if ($students->hasMorePages())
                        <a href="{{ $students->nextPageUrl() }}"
                        style="padding:10px 16px; border-radius:8px; border:2px solid #3b82f6; background:white; color:#3b82f6; text-decoration:none; font-weight:600; transition:all 0.3s;"
                        onmouseover="this.style.background='#3b82f6'; this.style.color='white'"
                        onmouseout="this.style.background='white'; this.style.color='#3b82f6'">
                            Next &raquo;
                        </a>
                    @endif
                </div>
            </div>
        @else
            <div style="text-align:center; padding:60px 20px; background:#f9fafb; border-radius:12px;">
                <i class="fas fa-users-slash" style="font-size:64px; color:#d1d5db; margin-bottom:20px;"></i>
                <h3 style="color:#6b7280; font-size:18px; margin-bottom:10px;">No Students Found</h3>
                <p style="color:#9ca3af; font-size:14px;">
                    @if(request()->hasAny(['sex', 'search']))
                        No students match your search criteria. Try adjusting your filters.
                    @else
                        No students are currently enrolled in this section.
                    @endif
                </p>
            </div>
        @endif

    </div>
</div>
@endsection
