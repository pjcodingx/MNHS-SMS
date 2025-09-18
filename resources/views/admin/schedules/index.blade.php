@extends('layouts.admin')

@section('content')
<div class="dashboard-content">

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2 style="color: #1f2937;">Schedules</h2>
        <a href="{{ route('admin.schedules.create') }}"
           style="background: linear-gradient(45deg, #3b82f6, #1d4ed8);
                  color: white; padding: 10px 20px; border-radius: 10px; text-decoration: none;
                  font-weight: 500; transition: all 0.3s ease;">
            <i class="fas fa-plus"></i> Add Schedule
        </a>
    </div>

    @if(session('success'))
        <div style="padding: 12px; background:#d1fae5; border:1px solid #10b981; color:#065f46; border-radius:10px; margin-bottom:20px;">
            {{ session('success') }}
        </div>
    @endif

    <div style="background: white; padding: 20px; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.1);">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #f3f4f6; text-align: left;">
                    <th style="padding: 12px; border-bottom: 1px solid #e5e7eb;">#</th>
                    <th style="padding: 12px; border-bottom: 1px solid #e5e7eb;">Grade Level</th>
                    <th style="padding: 12px; border-bottom: 1px solid #e5e7eb;">Subject</th>
                    <th style="padding: 12px; border-bottom: 1px solid #e5e7eb;">Days</th>
                    <th style="padding: 12px; border-bottom: 1px solid #e5e7eb;">Time</th>
                    <th style="padding: 12px; border-bottom: 1px solid #e5e7eb;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($schedules as $schedule)
                    <tr>
                        <td style="padding: 12px; border-bottom: 1px solid #e5e7eb;">{{ $schedule->id }}</td>
                        <td style="padding: 12px; border-bottom: 1px solid #e5e7eb;">
                            {{ $schedule->gradeLevel->name ?? 'N/A' }}
                        </td>
                        <td style="padding: 12px; border-bottom: 1px solid #e5e7eb;">
                            {{ $schedule->subject->name ?? 'All Subjects' }}
                        </td>
                        @php
                            $days = $schedule->days ?? [];
                        @endphp

                        <td style="padding: 12px; border-bottom: 1px solid #e5e7eb;">
                            {{ count($days) > 1 ? $days[0] . '-' . $days[count($days) - 1] : $days[0] ?? 'N/A' }}
                        </td>

                        <td style="padding: 12px; border-bottom: 1px solid #e5e7eb;">
                            {{ $schedule->time_start }} – {{ $schedule->time_end }}
                        </td>
                        <td style="padding: 12px; border-bottom: 1px solid #e5e7eb;">
                            <a href="{{ route('admin.schedules.edit', $schedule->id) }}"
                               style="color: #3b82f6; margin-right: 10px;">Edit</a>



                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="padding: 12px; text-align: center; color: #6b7280;">No schedules found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        @if ($schedules->hasPages())
            <div style="display:flex; justify-content:center; margin-top: 20px; gap:5px; flex-wrap:wrap;">
                @if ($schedules->onFirstPage())
                    <span style="padding:8px 12px; border-radius:8px; background:#e5e7eb; color:#6b7280;">&laquo;</span>
                @else
                    <a href="{{ $schedules->previousPageUrl() }}"
                       style="padding:8px 12px; border-radius:8px; background:linear-gradient(45deg, #3b82f6, #1d4ed8);
                              color:white; text-decoration:none;">&laquo;</a>
                @endif

                @foreach ($schedules->getUrlRange(1, $schedules->lastPage()) as $page => $url)
                    @if ($page == $schedules->currentPage())
                        <span style="padding:8px 12px; border-radius:8px; background:#1d4ed8; color:white;">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" style="padding:8px 12px; border-radius:8px; background:#f3f4f6; color:#1f2937; text-decoration:none;">{{ $page }}</a>
                    @endif
                @endforeach

                @if ($schedules->hasMorePages())
                    <a href="{{ $schedules->nextPageUrl() }}"
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
