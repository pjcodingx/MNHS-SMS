@extends('layouts.admin')

@section('content')
<div class="dashboard-content">

    <div style="margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center;">
        <h2 style="color: #1f2937;">Add Schedule</h2>
        <a href="{{ route('admin.schedules.index') }}"
           style="background: linear-gradient(45deg, #3b82f6, #1d4ed8);
                  color: white; padding: 10px 20px; border-radius: 10px; text-decoration: none;
                  font-weight: 500; transition: all 0.3s ease;">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>

    @if ($errors->any())
        <div style="padding: 12px; background:#fee2e2; border:1px solid #f87171; color:#b91c1c; border-radius:10px; margin-bottom:20px;">
            <ul style="margin:0; padding-left:20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div style="background: white; padding: 20px; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); max-width: 700px;">
        <form action="{{ route('admin.schedules.store') }}" method="POST">
            @csrf

            {{-- Grade Level + Section --}}
            <div style="margin-bottom: 15px;">
                <label for="section_id" style="display:block; font-weight:600; margin-bottom:5px;">Grade Level + Section</label>
                <select name="section_id" id="section_id" style="width:100%; padding:8px; border-radius:8px; border:1px solid #3b82f6;">
                    <option value="">Select Grade Level + Section</option>
                    @foreach($sections as $section)
                        <option value="{{ $section->id }}" data-grade="{{ $section->grade_level_id }}">
                            {{ $section->gradeLevel->name ?? 'No Grade Assigned' }} - {{ $section->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Hidden Grade Level ID --}}
            <input type="hidden" name="grade_level_id" id="grade_level_id" value="">

            {{-- Subject --}}
            <div style="margin-bottom: 15px;">
                <label for="subject_id" style="display:block; font-weight:600; margin-bottom:5px;">Subject (Only for selected Grade Level)</label>
                <select name="subject_id" id="subject_id" style="width:100%; padding:8px; border-radius:8px; border:1px solid #3b82f6;">
                    <option value="">Select Subject</option>
                    @foreach($subjects as $subject)
                        <option value="{{ $subject->id }}" data-grade="{{ $subject->grade_level_id }}">
                            {{ $subject->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Days --}}
            <div style="margin-bottom: 15px;">
                <label style="display:block; font-weight:600; margin-bottom:5px;">Days</label>
                <div style="display:flex; gap:10px; flex-wrap:wrap;">
                    @php $daysOfWeek = ['Mon','Tue','Wed','Thu','Fri','Sat']; @endphp
                    @foreach($daysOfWeek as $day)
                        <label style="display:flex; align-items:center; gap:5px;">
                            <input type="checkbox" name="days[]" value="{{ $day }}" {{ is_array(old('days')) && in_array($day, old('days')) ? 'checked' : '' }}>
                            {{ $day }}
                        </label>
                    @endforeach
                </div>
            </div>

            {{-- Time Start --}}
            <div style="margin-bottom: 15px;">
                <label for="time_start" style="display:block; font-weight:600; margin-bottom:5px;">Start Time</label>
                <input type="time" name="time_start" id="time_start" value="{{ old('time_start') }}" style="width:100%; padding:8px; border-radius:8px; border:1px solid #3b82f6;">
            </div>

            {{-- Time End --}}
            <div style="margin-bottom: 15px;">
                <label for="time_end" style="display:block; font-weight:600; margin-bottom:5px;">End Time</label>
                <input type="time" name="time_end" id="time_end" value="{{ old('time_end') }}" style="width:100%; padding:8px; border-radius:8px; border:1px solid #3b82f6;">
            </div>

            <button type="submit"
                    style="background: linear-gradient(45deg, #3b82f6, #1d4ed8); color:white; padding:10px 20px; border-radius:10px; border:none; cursor:pointer; font-weight:500;">
                Add Schedule
            </button>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const sectionSelect = document.getElementById('section_id');
    const subjectSelect = document.getElementById('subject_id');
    const gradeInput = document.getElementById('grade_level_id');
    const allSubjects = Array.from(subjectSelect.options);

    sectionSelect.addEventListener('change', function() {
        const selectedGrade = this.selectedOptions[0]?.dataset.grade;

        // Update hidden grade_level_id
        gradeInput.value = selectedGrade || '';

        // Filter subjects
        subjectSelect.innerHTML = '<option value="">Select Subject</option>';
        allSubjects.forEach(option => {
            if(option.value === "" || option.dataset.grade === selectedGrade) {
                subjectSelect.appendChild(option);
            }
        });
    });
});
</script>
@endsection
