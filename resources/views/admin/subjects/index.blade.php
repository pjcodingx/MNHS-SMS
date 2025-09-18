@extends('layouts.admin')

@section('content')
<div class="dashboard-content">

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2 style="color: #1f2937;">Subjects</h2>
        <a href="{{ route('admin.subjects.create') }}"
           style="background: linear-gradient(45deg, #3b82f6, #1d4ed8);
                  color: white; padding: 10px 20px; border-radius: 10px;
                  text-decoration: none; font-weight: 500; transition: all 0.3s ease;">
            <i class="fas fa-plus"></i> Add Subject
        </a>
    </div>

    @if(session('success'))
        <div style="padding: 12px; background:#d1fae5; border:1px solid #10b981; color:#065f46; border-radius:10px; margin-bottom:20px;">
            {{ session('success') }}
        </div>
    @endif

     <form method="GET" style="margin-bottom: 20px; display: flex; align-items: center; gap: 15px;" >
        <label for="grade_level_id" style="font-weight: 600;">Filter by Grade:</label>
        <select name="grade_level_id" id="grade_level_id" style="padding: 8px; border-radius: 8px; border: 1px solid #d1d5db;">
            <option value="">All Grades</option>
            @foreach($gradeLevels as $grade)
                <option value="{{ $grade->id }}" {{ request('grade_level_id') == $grade->id ? 'selected' : '' }}>
                    {{ $grade->name }} ({{ $grade->type }})
                </option>
            @endforeach
        </select>
        <button type="submit"
                style="background: linear-gradient(45deg, #3b82f6, #1d4ed8); color: white; padding: 8px 15px; border-radius: 8px; border: none; cursor: pointer;">
            Filter
        </button>
    </form>

    <div style="background: white; padding: 20px; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.1);">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #f3f4f6; text-align: left;">
                    <th style="padding: 12px; border-bottom: 1px solid #e5e7eb;">#</th>
                    <th style="padding: 12px; border-bottom: 1px solid #e5e7eb;">Subject Name</th>
                    <th>Grade Level</th>
                    <th style="padding: 12px; border-bottom: 1px solid #e5e7eb;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($subjects as $subject)
                <tr>
                    <td style="padding: 12px; border-bottom: 1px solid #e5e7eb;">{{ $subject->id }}</td>
                    <td style="padding: 12px; border-bottom: 1px solid #e5e7eb;">{{ $subject->name }}</td>
                    <td>{{ $subject->gradeLevel->name }}</td>
                    <td style="padding: 12px; border-bottom: 1px solid #e5e7eb;">
                        <a href="{{ route('admin.subjects.edit', $subject->id) }}"
                           style="color: #3b82f6; margin-right: 10px;">Edit</a>
                    </td>
                </tr>
                @endforeach

                @if($subjects->isEmpty())
                <tr>
                    <td colspan="3" style="padding: 12px; text-align: center; color: #6b7280;">No subjects found.</td>
                </tr>
                @endif
            </tbody>
        </table>

        {{-- Pagination --}}
        @if ($subjects->hasPages())
            <div style="display:flex; justify-content:center; margin-top: 20px; gap:5px; flex-wrap:wrap;">
                @if ($subjects->onFirstPage())
                    <span style="padding:8px 12px; border-radius:8px; background:#e5e7eb; color:#6b7280;">&laquo;</span>
                @else
                    <a href="{{ $subjects->previousPageUrl() }}"
                    style="padding:8px 12px; border-radius:8px; background:linear-gradient(45deg, #3b82f6, #1d4ed8);
                            color:white; text-decoration:none;">&laquo;</a>
                @endif

                @foreach ($subjects->getUrlRange(1, $subjects->lastPage()) as $page => $url)
                    @if ($page == $subjects->currentPage())
                        <span style="padding:8px 12px; border-radius:8px; background:#1d4ed8; color:white;">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" style="padding:8px 12px; border-radius:8px; background:#f3f4f6; color:#1f2937; text-decoration:none;">{{ $page }}</a>
                    @endif
                @endforeach

                @if ($subjects->hasMorePages())
                    <a href="{{ $subjects->nextPageUrl() }}"
                    style="padding:8px 12px; border-radius:8px; background:linear-gradient(45deg, #3b82f6, #1d4ed8);
                            color:white; text-decoration:none;">&raquo;</a>
                @else
                    <span style="padding:8px 12px; border-radius:8px; background:#e5e7eb; color:#6b7280;">&raquo;</span>
                @endif
            </div>
        @endif
    </div>
</div>
@endsection
