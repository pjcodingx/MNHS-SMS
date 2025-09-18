@extends('layouts.admin')

@section('content')
<div class="dashboard-content">

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2 style="color: #1f2937;">Advisers</h2>
        <a href="{{ route('admin.advisers.create') }}"
           style="background: linear-gradient(45deg, #3b82f6, #1d4ed8);
                  color: white; padding: 10px 20px; border-radius: 10px;
                  text-decoration: none; font-weight: 500; transition: all 0.3s ease;">
            <i class="fas fa-plus"></i> Add Adviser
        </a>
    </div>



    <div style="background: white; padding: 20px; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.1);">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #f3f4f6; text-align: left;">
                    <th style="padding: 12px; border-bottom: 1px solid #e5e7eb;">ID</th>
                    <th style="padding: 12px; border-bottom: 1px solid #e5e7eb;">Adviser Name</th>

                    <th style="padding: 12px; border-bottom: 1px solid #e5e7eb;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($advisers as $adviser)
                <tr>
                    <td style="padding: 12px; border-bottom: 1px solid #e5e7eb;">{{ $adviser->id }}</td>
                    <td style="padding: 12px; border-bottom: 1px solid #e5e7eb;">{{ $adviser->name }}</td>

                    <td style="padding: 12px; border-bottom: 1px solid #e5e7eb;">
                        <a href="{{ route('admin.advisers.edit', $adviser->id) }}"
                           style="color: #3b82f6; margin-right: 10px;">Edit</a>
                    </td>
                </tr>
                @endforeach

                @if($advisers->isEmpty())
                <tr>
                    <td colspan="4" style="padding: 12px; text-align: center; color: #6b7280;">No advisers found.</td>
                </tr>
                @endif
            </tbody>
        </table>

        {{-- Pagination --}}
        @if ($advisers->hasPages())
            <div style="display:flex; justify-content:center; margin-top: 20px; gap:5px; flex-wrap:wrap;">

                {{-- Prev --}}
                @if ($advisers->onFirstPage())
                    <span style="padding:8px 12px; border-radius:8px; background:#e5e7eb; color:#6b7280;">&laquo;</span>
                @else
                    <a href="{{ $advisers->previousPageUrl() }}"
                       style="padding:8px 12px; border-radius:8px; background:linear-gradient(45deg, #3b82f6, #1d4ed8);
                              color:white; text-decoration:none;">&laquo;</a>
                @endif

                {{-- Pages --}}
                @foreach ($advisers->getUrlRange(1, $advisers->lastPage()) as $page => $url)
                    @if ($page == $advisers->currentPage())
                        <span style="padding:8px 12px; border-radius:8px; background:#1d4ed8; color:white;">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}"
                           style="padding:8px 12px; border-radius:8px; background:#f3f4f6; color:#1f2937; text-decoration:none;">{{ $page }}</a>
                    @endif
                @endforeach

                {{-- Next --}}
                @if ($advisers->hasMorePages())
                    <a href="{{ $advisers->nextPageUrl() }}"
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
