@extends('layouts.registrar')

@section('content')
<div class="dashboard-content">

    <div style="margin-bottom:20px; display:flex; justify-content:space-between; align-items:center;">
        <h2 style="color:#1f2937;">Enrolled Students</h2>
    </div>


   <form method="GET" style="margin-bottom:20px; display:flex; gap:10px; flex-wrap:wrap; align-items:center;">

    <select name="section_id" style="padding:8px; border-radius:8px; border:1px solid #3b82f6;">
        <option value="">All Sections</option>
        @foreach($sections as $section)
            <option value="{{ $section->id }}" {{ request('section_id')==$section->id ? 'selected' : '' }}>
                {{ $section->gradeLevel->name ?? 'No Grade' }} - {{ $section->name }}
            </option>
        @endforeach
    </select>


    <select name="sex" style="padding:8px; border-radius:8px; border:1px solid #3b82f6;">
        <option value="">All Sex</option>
        <option value="Male" {{ request('sex')=='Male' ? 'selected' : '' }}>Male</option>
        <option value="Female" {{ request('sex')=='Female' ? 'selected' : '' }}>Female</option>
    </select>


    <input type="text" name="search" placeholder="Search Name..."
           value="{{ request('search') }}"
           style="padding:8px; border-radius:8px; border:1px solid #3b82f6; flex:1; min-width:150px;">

    <button type="submit" style="padding:8px 12px; border-radius:8px; background:#3b82f6; color:white;">
        Filter
    </button>
</form>



    <table style="width:100%; border-collapse:collapse;">
        <thead>
            <tr style="background:#f3f4f6; text-align:left;">
                <th style="padding:10px; border-bottom:1px solid #ddd;">LRN</th>
                <th style="padding:10px; border-bottom:1px solid #ddd;">Name</th>
                <th style="padding:10px; border-bottom:1px solid #ddd;">Section</th>
                <th style="padding:10px; border-bottom:1px solid #ddd;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
            <tr>
                <td style="padding:10px; border-bottom:1px solid #ddd;">{{ $student->lrn }}</td>
                <td style="padding:10px; border-bottom:1px solid #ddd;">
                    {{ $student->last_name }}, {{ $student->first_name }} {{ $student->middle_initial }}
                </td>
                <td style="padding:10px; border-bottom:1px solid #ddd;">
                    {{ $student->section->gradeLevel->name ?? '' }} - {{ $student->section->name ?? '' }}
                </td>
                <td style="padding:10px; border-bottom:1px solid #ddd; display:flex; gap:10px;">
                    <a href="{{ route('registrar.students.show', $student) }}"
                    style="color:#3b82f6; font-weight:500;">View</a>

                    <a href="{{ route('registrar.students.edit', $student) }}"
                    style="color:#10b981; font-weight:500;">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top:15px; display:flex; justify-content:center; align-items:center; gap:5px;">
        @if ($students->onFirstPage() == false)
            <a href="{{ $students->previousPageUrl() }}"
            style="padding:6px 10px; border-radius:6px; border:1px solid #3b82f6; background:white; color:#3b82f6; text-decoration:none;">
                &laquo; Prev
            </a>
        @endif

        @foreach ($students->getUrlRange(1, $students->lastPage()) as $page => $url)
            <a href="{{ $url }}"
            style="padding:6px 10px; border-radius:6px; border:1px solid #3b82f6;
                    {{ $students->currentPage() == $page ? 'background:#3b82f6; color:white;' : 'background:white; color:#3b82f6;' }}
                    text-decoration:none;">
                {{ $page }}
            </a>
        @endforeach

        @if ($students->hasMorePages())
            <a href="{{ $students->nextPageUrl() }}"
            style="padding:6px 10px; border-radius:6px; border:1px solid #3b82f6; background:white; color:#3b82f6; text-decoration:none;">
                Next &raquo;
            </a>
        @endif
    </div>

</div>
@endsection
