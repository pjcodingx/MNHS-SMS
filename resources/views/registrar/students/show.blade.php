@extends('layouts.registrar')

@section('content')
<div class="dashboard-content">
    <h2>Student Enrollment Details</h2>


    <div style="background:white; padding:20px; border-radius:8px; box-shadow:0 2px 10px rgba(0,0,0,0.1); margin-bottom:20px;">
        <h3 style="margin-top:0; border-bottom:1px solid #ddd; padding-bottom:10px;">Student Information</h3>

        <table style="width:100%; border-collapse:collapse;">
            <tr>
                <td style="padding:8px; border:1px solid #ddd; background:#f8f9fa; font-weight:bold; width:15%;">LRN:</td>
                <td style="padding:8px; border:1px solid #ddd;">{{ $student->lrn }}</td>
                <td style="padding:8px; border:1px solid #ddd; background:#f8f9fa; font-weight:bold; width:15%;">Gender:</td>
                <td style="padding:8px; border:1px solid #ddd;">{{ $student->sex }}</td>
            </tr>
            <tr>
                <td style="padding:8px; border:1px solid #ddd; background:#f8f9fa; font-weight:bold;">Name:</td>
                <td style="padding:8px; border:1px solid #ddd;">{{ $student->last_name }}, {{ $student->first_name }} {{ $student->middle_initial }}</td>
                <td style="padding:8px; border:1px solid #ddd; background:#f8f9fa; font-weight:bold;">Section:</td>
                <td style="padding:8px; border:1px solid #ddd;">{{ $student->section->gradeLevel->name ?? '' }} - {{ $student->section->name ?? '' }}</td>
            </tr>
        </table>
    </div>


    <div style="background:white; padding:20px; border-radius:8px; box-shadow:0 2px 10px rgba(0,0,0,0.1);">
        <h3 style="margin-top:0; border-bottom:1px solid #ddd; padding-bottom:10px;">Class Schedule</h3>

        @if($student->section && $student->section->sectionSubjects)
            <table style="width:100%; border-collapse:collapse; border:1px solid #333;">
                <thead>
                    <tr>
                        <th style="background:#333; color:white; padding:10px; text-align:left; border:1px solid #333;">Subject</th>
                        <th style="background:#333; color:white; padding:10px; text-align:left; border:1px solid #333;">Adviser</th>
                        <th style="background:#333; color:white; padding:10px; text-align:left; border:1px solid #333;">Days</th>
                        <th style="background:#333; color:white; padding:10px; text-align:left; border:1px solid #333;">Time</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($student->section->sectionSubjects as $ss)
                        <tr>
                            <td style="padding:10px; border:1px solid #ddd; font-weight:bold;">{{ optional($ss->subject)->name ?? 'No Subject' }}</td>

                            <td style="padding:10px; border:1px solid #ddd;">{{ optional($ss->adviser)->name ?? 'No Adviser' }}</td>

                            <td style="padding:10px; border:1px solid #ddd;">{{ optional($ss->schedule)->days ? implode(', ', $ss->schedule->days) : 'N/A' }}</td>

                            <td style="padding:10px; border:1px solid #ddd; text-align:center; font-weight:bold;">{{ optional($ss->schedule)->time_start ?? 'N/A' }} - {{ optional($ss->schedule)->time_end ?? 'N/A' }}</td>

                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" style="background:#f8f9fa; padding:10px; text-align:center; border:1px solid #333; font-weight:bold;">
                            Total Subjects: {{ count($student->section->sectionSubjects) }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        @else
            <div style="text-align:center; padding:30px; color:#666; border:1px solid #ddd; background:#f9f9f9;">
                No subjects assigned to this student.
            </div>
        @endif
    </div>


</div>
@endsection
