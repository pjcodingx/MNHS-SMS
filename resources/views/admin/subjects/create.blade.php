@extends('layouts.admin')

@section('content')
<div class="dashboard-content">

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2 style="color: #1f2937;">Add Subject</h2>
        <a href="{{ route('admin.subjects.index') }}"
           style="background: #e5e7eb; color: #374151; padding: 8px 15px;
                  border-radius: 8px; text-decoration: none; font-weight: 500;">
            ← Back
        </a>
    </div>

    <div style="background: white; padding: 20px; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); max-width: 500px;">
        <form action="{{ route('admin.subjects.store') }}" method="POST" style="display: flex; flex-direction: column; gap: 15px;">
            @csrf

            {{-- Subject Name --}}
            <div>
                <label for="name" style="font-weight: 600; display:block; margin-bottom: 5px;">Subject Name</label>
                <input type="text" name="name" id="name"
                       value="{{ old('name') }}"
                       style="width: 100%; padding: 10px; border: 1px solid #d1d5db;
                              border-radius: 8px; outline: none;"
                       required>
                @error('name')
                    <small style="color: #dc2626;">{{ $message }}</small>
                @enderror
            </div>

            <div>
                <label for="grade_level_id" style="font-weight: 600; display:block; margin-bottom: 5px;">
                    Grade Level
                </label>
                <select name="grade_level_id" id="grade_level_id"
                        style="width: 100%; padding: 10px; border: 1px solid #d1d5db;
                            border-radius: 8px; outline: none; background: white;
                            appearance: none; /* removes default arrow */
                            background-image: url('data:image/svg+xml;utf8,<svg fill="none" stroke="gray" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path></svg>');
                            background-repeat: no-repeat;
                            background-position: right 12px center;
                            background-size: 16px 16px;">
                    <option value="">-- Select Grade Level --</option>
                    @foreach($gradeLevels as $grade)
                        <option value="{{ $grade->id }}"
                            {{ old('grade_level_id', $subject->grade_level_id ?? '') == $grade->id ? 'selected' : '' }}>
                            {{ $grade->name }}
                        </option>
                    @endforeach
                </select>
                @error('grade_level_id')
                    <small style="color: #dc2626;">{{ $message }}</small>
                @enderror
            </div>



            {{-- Buttons --}}
            <div style="display: flex; gap: 10px; margin-top: 10px;">
                <button type="submit"
                        style="background: linear-gradient(45deg, #10b981, #059669);
                               color: white; padding: 10px 20px; border: none;
                               border-radius: 8px; cursor: pointer; font-weight: 500;">
                    Save
                </button>
                <a href="{{ route('admin.subjects.index') }}"
                   style="background: #e5e7eb; color: #374151; padding: 10px 20px;
                          border-radius: 8px; text-decoration: none; font-weight: 500;">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
