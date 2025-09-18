@extends('layouts.registrar')

@section('content')
<div class="dashboard-content">


    <div style="margin-bottom: 20px; display:flex; justify-content: space-between; align-items:center;">
        <h2 style="color:#1f2937;">Enroll Student</h2>
    </div>


    @if($errors->any())
        <div style="padding:12px; background:#fee2e2; border:1px solid #f87171; color:#b91c1c; border-radius:10px; margin-bottom:20px;">
            <ul style="margin:0; padding-left:20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div style="background:white; padding:20px; border-radius:15px; box-shadow:0 5px 20px rgba(0,0,0,0.1); max-width:900px;">
        <form action="{{ route('registrar.enrollment.store') }}" method="POST">
            @csrf


            <h3 style="margin-bottom:15px; font-weight:600; color:#111827;">Student Info</h3>
            <div style="display:flex; gap:15px; flex-wrap:wrap; margin-bottom:15px;">

                <input type="text" name="lrn" placeholder="LRN" value="{{ old('lrn') }}" style="flex:1; padding:8px; border-radius:8px; border:1px solid #3b82f6;">

                <input type="text" name="first_name" placeholder="First Name" value="{{ old('first_name') }}" style="flex:1; padding:8px; border-radius:8px; border:1px solid #3b82f6;">

                <input type="text" name="middle_initial" placeholder="Middle Initial" value="{{ old('middle_initial') }}" style="flex:1; padding:8px; border-radius:8px; border:1px solid #3b82f6;">

                <input type="text" name="last_name" placeholder="Last Name" value="{{ old('last_name') }}" style="flex:1; padding:8px; border-radius:8px; border:1px solid #3b82f6;">

                <select name="sex" style="flex:1; padding:8px; border-radius:8px; border:1px solid #3b82f6;">
                    <option value="">Select Sex</option>
                    <option value="Male" {{ old('sex')=='Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ old('sex')=='Female' ? 'selected' : '' }}>Female</option>
                </select>
            </div>


            <h3 style="margin-bottom:15px; font-weight:600; color:#111827;">Grade & Section</h3>
            <div style="display:flex; gap:15px; flex-wrap:wrap; margin-bottom:15px;">
                <select name="section_id" id="section_id" style="flex:1; padding:8px; border-radius:8px; border:1px solid #3b82f6;">
                    <option value="">Select Section</option>
                    @foreach($sections as $section)
                        <option value="{{ $section->id }}" data-grade="{{ $section->grade_level_id }}">
                            {{ $section->gradeLevel->name ?? 'No Grade' }} - {{ $section->name }}
                        </option>
                    @endforeach
                </select>
            </div>


            <h3 style="margin-bottom:15px; font-weight:600; color:#111827;">Subjects & Schedule</h3>
            <div id="subjects-container" style="margin-bottom:20px;">

            </div>

            <button type="submit" style="background: linear-gradient(45deg, #3b82f6, #1d4ed8); color:white; padding:10px 20px; border-radius:10px; border:none; cursor:pointer; font-weight:500;">
                Enroll Student
            </button>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const sectionSelect = document.getElementById('section_id');
    const subjectsContainer = document.getElementById('subjects-container');


   @php
$sectionsSubjects = [];
foreach($sections as $s) {
    $arr = [];

    foreach ($s->sectionSubjects ?? [] as $ss) {
        $arr[] = [
            'subject' => optional($ss->subject)->name ?? 'No Subject',
            'adviser' => optional($ss->adviser)->name ?? 'No Adviser',
            'days' => optional($ss->schedule)->days ?? [],
            'time_start' => optional($ss->schedule)->time_start ?? 'N/A',
            'time_end' => optional($ss->schedule)->time_end ?? 'N/A',
        ];
    }
    $sectionsSubjects[$s->id] = $arr;
}
@endphp


    const sectionsSubjects = @json($sectionsSubjects);

    sectionSelect.addEventListener('change', function() {
        const sectionId = this.value;
        subjectsContainer.innerHTML = '';

        if(sectionId && sectionsSubjects[sectionId]) {
            sectionsSubjects[sectionId].forEach(ss => {
                const div = document.createElement('div');
                div.style.padding = '10px';
                div.style.border = '1px solid #d1d5db';
                div.style.borderRadius = '8px';
                div.style.marginBottom = '8px';
                div.innerHTML = `<strong>${ss.subject}</strong> | Adviser: ${ss.adviser} | Days: ${ss.days.join(', ')} | ${ss.time_start} - ${ss.time_end}`;
                subjectsContainer.appendChild(div);
            });
        }
    });
});
</script>
@endsection
