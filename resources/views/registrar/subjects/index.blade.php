@extends('layouts.registrar')
@section('content')
<div class="dashboard-content">
    <div style="background:white; border-radius:15px; box-shadow:0 5px 20px rgba(0,0,0,0.1); padding:30px;">

        <!-- Header Section -->
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:30px; padding-bottom:20px; border-bottom:2px solid #e5e7eb;">
            <div>
                <h2 style="color:#1f2937; font-size:24px; font-weight:600; margin-bottom:5px;">
                    <i class="fas fa-book" style="color:#3b82f6; margin-right:10px;"></i>
                    Subjects List
                </h2>
                <p style="color:#6b7280; font-size:14px;">View all subjects and their enrolled students</p>
            </div>
        </div>

        <!-- Filters Section -->
        <form method="GET" action="{{ route('registrar.subjects.index') }}" style="background:#f9fafb; padding:20px; border-radius:12px; margin-bottom:25px;">
            <div style="display:grid; grid-template-columns:1fr 1fr auto; gap:15px; align-items:end;">

                <!-- Grade Level Filter -->
                <div>
                    <label style="display:block; color:#374151; font-weight:600; margin-bottom:8px; font-size:14px;">
                        <i class="fas fa-layer-group" style="margin-right:5px;"></i>
                        Grade Level
                    </label>
                    <select name="grade_level_id"
                        style="width:100%; padding:10px 14px; border:2px solid #e5e7eb; border-radius:8px; font-size:14px; background:white; cursor:pointer; outline:none;"
                        onchange="this.form.submit()">
                        <option value="">All Grade Levels</option>
                        @foreach($gradeLevels as $level)
                            <option value="{{ $level->id }}" {{ request('grade_level_id') == $level->id ? 'selected' : '' }}>
                                {{ $level->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Search Box -->
                <div>
                    <label style="display:block; color:#374151; font-weight:600; margin-bottom:8px; font-size:14px;">
                        <i class="fas fa-search" style="margin-right:5px;"></i>
                        Search Subject
                    </label>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Search subject name..."
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
                    @if(request()->hasAny(['grade_level_id', 'search']))
                        <a href="{{ route('registrar.subjects.index') }}"
                            style="padding:10px 20px; background:#6b7280; color:white; border:none; border-radius:8px; font-weight:600; text-decoration:none; display:flex; align-items:center; transition:all 0.3s;"
                            onmouseover="this.style.background='#4b5563'"
                            onmouseout="this.style.background='#6b7280'">
                            <i class="fas fa-times"></i> Clear
                        </a>
                    @endif
                </div>
            </div>
        </form>

        <!-- Subjects Grid -->
        @if($subjects->count() > 0)
            <div style="display:grid; grid-template-columns:repeat(auto-fill, minmax(300px, 1fr)); gap:20px; margin-bottom:30px;">
                @foreach($subjects as $subject)
                    <a href="{{ route('registrar.subjects.show', $subject->id) }}"
                        style="text-decoration:none; display:block; background:white; border:2px solid #e5e7eb; border-radius:12px; padding:20px; transition:all 0.3s; position:relative; overflow:hidden;"
                        onmouseover="this.style.borderColor='#3b82f6'; this.style.transform='translateY(-4px)'; this.style.boxShadow='0 10px 25px rgba(59,130,246,0.15)'"
                        onmouseout="this.style.borderColor='#e5e7eb'; this.style.transform='translateY(0)'; this.style.boxShadow='none'">

                        <!-- Accent Bar -->
                        <div style="position:absolute; top:0; left:0; right:0; height:4px; background:linear-gradient(90deg, #3b82f6, #1d4ed8);"></div>

                        <!-- Subject Icon -->
                        <div style="width:50px; height:50px; background:linear-gradient(135deg, #3b82f6, #1d4ed8); border-radius:12px; display:flex; align-items:center; justify-content:center; margin-bottom:15px;">
                            <i class="fas fa-book-open" style="color:white; font-size:24px;"></i>
                        </div>

                        <!-- Subject Name -->
                        <h3 style="color:#1f2937; font-size:18px; font-weight:700; margin-bottom:10px; line-height:1.3;">
                            {{ $subject->name }}
                        </h3>

                        <!-- Grade Level Badge -->
                        <div style="display:inline-block; background:#dbeafe; color:#1e40af; padding:5px 12px; border-radius:20px; font-size:12px; font-weight:600; margin-bottom:15px;">
                            <i class="fas fa-layer-group" style="margin-right:5px;"></i>
                            {{ $subject->gradeLevel->name ?? 'N/A' }}
                        </div>

                        <!-- Student Count -->
                        @php
                            $studentCount = \App\Models\Student::whereIn('section_id',
                                \App\Models\SectionSubject::where('subject_id', $subject->id)->pluck('section_id')
                            )->count();
                        @endphp
                        <div style="display:flex; align-items:center; justify-content:space-between; padding-top:15px; border-top:1px solid #e5e7eb;">
                            <span style="color:#6b7280; font-size:14px;">
                                <i class="fas fa-users" style="color:#3b82f6; margin-right:5px;"></i>
                                {{ $studentCount }} {{ Str::plural('Student', $studentCount) }}
                            </span>
                            <span style="color:#3b82f6; font-size:14px; font-weight:600;">
                                View Details <i class="fas fa-arrow-right" style="margin-left:5px;"></i>
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>

            <!-- Pagination -->
            <div style="margin-top:30px; display:flex; justify-content:center; align-items:center; gap:5px;">
                @if ($subjects->onFirstPage() == false)
                    <a href="{{ $subjects->previousPageUrl() }}"
                    style="padding:10px 16px; border-radius:8px; border:2px solid #3b82f6; background:white; color:#3b82f6; text-decoration:none; font-weight:600; transition:all 0.3s;"
                    onmouseover="this.style.background='#3b82f6'; this.style.color='white'"
                    onmouseout="this.style.background='white'; this.style.color='#3b82f6'">
                        &laquo; Prev
                    </a>
                @endif

                @foreach ($subjects->getUrlRange(1, $subjects->lastPage()) as $page => $url)
                    <a href="{{ $url }}"
                    style="padding:10px 16px; border-radius:8px; border:2px solid #3b82f6;
                            {{ $subjects->currentPage() == $page ? 'background:#3b82f6; color:white;' : 'background:white; color:#3b82f6;' }}
                            text-decoration:none; font-weight:600; transition:all 0.3s;"
                    @if($subjects->currentPage() != $page)
                        onmouseover="this.style.background='#eff6ff'"
                        onmouseout="this.style.background='white'"
                    @endif>
                        {{ $page }}
                    </a>
                @endforeach

                @if ($subjects->hasMorePages())
                    <a href="{{ $subjects->nextPageUrl() }}"
                    style="padding:10px 16px; border-radius:8px; border:2px solid #3b82f6; background:white; color:#3b82f6; text-decoration:none; font-weight:600; transition:all 0.3s;"
                    onmouseover="this.style.background='#3b82f6'; this.style.color='white'"
                    onmouseout="this.style.background='white'; this.style.color='#3b82f6'">
                        Next &raquo;
                    </a>
                @endif
            </div>
        @else
            <div style="text-align:center; padding:60px 20px; background:#f9fafb; border-radius:12px;">
                <i class="fas fa-book" style="font-size:64px; color:#d1d5db; margin-bottom:20px;"></i>
                <h3 style="color:#6b7280; font-size:18px; margin-bottom:10px;">No Subjects Found</h3>
                <p style="color:#9ca3af; font-size:14px;">Try adjusting your filters or search criteria.</p>
            </div>
        @endif

    </div>
</div>
@endsection
