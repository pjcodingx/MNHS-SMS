@extends('layouts.admin')

@section('content')
<div class="dashboard-content">

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2 style="color: #1f2937;">Section Subjects</h2>
        <a href="{{ route('admin.section_subjects.create') }}"
           style="background: linear-gradient(45deg, #3b82f6, #1d4ed8);
                  color: white; padding: 10px 20px; border-radius: 10px;
                  text-decoration: none; font-weight: 500; transition: all 0.3s ease;">
            <i class="fas fa-plus"></i> Add Assignment
        </a>
    </div>

    @if(session('success'))
        <div style="padding: 12px; background:#d1fae5; border:1px solid #10b981; color:#065f46; border-radius:10px; margin-bottom:20px;">
            {{ session('success') }}
        </div>
    @endif

    <form method="GET" style="margin-bottom: 20px; display: flex; align-items: center; gap: 15px;">
        <label for="section_id" style="font-weight: 600;">Filter by Section:</label>
        <select name="section_id" id="section_id" style="padding: 8px; border-radius: 8px; border: 1px solid #d1d5db;">
            <option value="">All Sections</option>
            @foreach($sections as $section)
                <option value="{{ $section->id }}" {{ request('section_id') == $section->id ? 'selected' : '' }}>
                    {{ $section->name }} ({{ $section->gradeLevel->name ?? 'No Grade Assigned' }})
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
                    <th style="padding: 12px; border-bottom: 1px solid #e5e7eb;">Section</th>
                    <th style="padding: 12px; border-bottom: 1px solid #e5e7eb;">Subject</th>
                    <th style="padding: 12px; border-bottom: 1px solid #e5e7eb;">Adviser</th>
                    <th style="padding: 12px; border-bottom: 1px solid #e5e7eb;">Schedule</th>
                    <th style="padding: 12px; border-bottom: 1px solid #e5e7eb;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($assignments as $a)
                <tr>
                    <td style="padding: 12px; border-bottom: 1px solid #e5e7eb;">{{ $a->id }}</td>
                    <td style="padding: 12px; border-bottom: 1px solid #e5e7eb;">{{ $a->section->name }}</td>
                    <td style="padding: 12px; border-bottom: 1px solid #e5e7eb;">{{ $a->subject->name }}</td>
                    <td style="padding: 12px; border-bottom: 1px solid #e5e7eb;">{{ $a->adviser->name }}</td>
                    <td style="padding: 12px; border-bottom: 1px solid #e5e7eb;">
                        @php $days = $a->schedule->days; @endphp
                        {{ count($days) > 1 ? $days[0].'-'.end($days) : $days[0] }}
                        {{ $a->schedule->time_start }}–{{ $a->schedule->time_end }}
                    </td>
                    <td style="padding: 12px; border-bottom: 1px solid #e5e7eb;">
                        <a href="{{ route('admin.section_subjects.edit', $a->id) }}"
                           style="color: #3b82f6; margin-right: 10px;">Edit</a>

                    </td>
                </tr>
                @endforeach

                @if($assignments->isEmpty())
                <tr>
                    <td colspan="6" style="padding: 12px; text-align: center; color: #6b7280;">No assignments found.</td>
                </tr>
                @endif
            </tbody>
        </table>

        {{-- Pagination --}}
        @if ($assignments->hasPages())
            <div style="display:flex; justify-content:center; margin-top: 20px; gap:5px; flex-wrap:wrap;">
                @if ($assignments->onFirstPage())
                    <span style="padding:8px 12px; border-radius:8px; background:#e5e7eb; color:#6b7280;">&laquo;</span>
                @else
                    <a href="{{ $assignments->previousPageUrl() }}"
                    style="padding:8px 12px; border-radius:8px; background:linear-gradient(45deg, #3b82f6, #1d4ed8);
                            color:white; text-decoration:none;">&laquo;</a>
                @endif

                @foreach ($assignments->getUrlRange(1, $assignments->lastPage()) as $page => $url)
                    @if ($page == $assignments->currentPage())
                        <span style="padding:8px 12px; border-radius:8px; background:#1d4ed8; color:white;">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" style="padding:8px 12px; border-radius:8px; background:#f3f4f6; color:#1f2937; text-decoration:none;">{{ $page }}</a>
                    @endif
                @endforeach

                @if ($assignments->hasMorePages())
                    <a href="{{ $assignments->nextPageUrl() }}"
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
