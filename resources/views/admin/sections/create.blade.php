@extends('layouts.admin')

@section('content')
<div class="dashboard-content">

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2 style="color: #1f2937;">Add New Section</h2>
        <a href="{{ route('admin.sections.index') }}"
           style="background: linear-gradient(45deg, #3b82f6, #1d4ed8);
                  color: white; padding: 10px 20px; border-radius: 10px;
                  text-decoration: none; font-weight: 500; transition: all 0.3s ease;">
            <i class="fas fa-arrow-left"></i> Back to Sections
        </a>
    </div>


    <div style="background: white; padding: 25px; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); max-width: 600px;">
        <form action="{{ route('admin.sections.store') }}" method="POST">
            @csrf

            <div style="margin-bottom: 15px;">
                <label for="name" style="display:block; font-weight: 600; color: #1f2937; margin-bottom: 5px;">Section Name</label>
                <input type="text" name="name" id="name"
                       value="{{ old('name') }}"
                       required
                       style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px;">
                @error('name')
                    <div style="color: #ef4444; margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom: 15px;">
                <label for="grade_level_id" style="display:block; font-weight: 600; color: #1f2937; margin-bottom: 5px;">Grade Level</label>
                <select name="grade_level_id" id="grade_level_id" required
                        style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px;">
                    <option value="">Select Grade Level</option>
                    @foreach($grades as $grade)
                        <option value="{{ $grade->id }}" {{ old('grade_level_id') == $grade->id ? 'selected' : '' }}>
                            {{ $grade->name }} ({{ $grade->type }})
                        </option>
                    @endforeach
                </select>
                @error('grade_level_id')
                    <div style="color: #ef4444; margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>

           <div id="strand-wrapper" style="margin-bottom: 15px; display:none;">
                <label for="strand_id" style="display:block; font-weight: 600; color: #1f2937; margin-bottom: 5px;">
                    Strand (for Grade 11 & 12 only)
                </label>
                <select name="strand_id" id="strand_id"
                        style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px;">
                    <option value="">-- Select Strand --</option>
                    @foreach($strands as $strand)
                        <option value="{{ $strand->id }}" {{ old('strand_id') == $strand->id ? 'selected' : '' }}>
                            {{ $strand->code }} - {{ $strand->name }}
                        </option>
                    @endforeach
                </select>
                @error('strand_id')
                    <div style="color: #ef4444; margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit"
                    style="background: linear-gradient(45deg, #3b82f6, #1d4ed8);
                           color: white; padding: 12px 20px; border-radius: 10px;
                           font-weight: 500; border: none; cursor: pointer; transition: all 0.3s ease;">
                <i class="fas fa-plus-circle"></i> Create Section
            </button>
        </form>
    </div>
</div>



<script>
document.addEventListener("DOMContentLoaded", function () {
    const gradeSelect = document.getElementById("grade_level_id");
    const strandWrapper = document.getElementById("strand-wrapper");

    function toggleStrand() {
        const selected = gradeSelect.options[gradeSelect.selectedIndex].text;
        if (selected.includes("11") || selected.includes("12")) {
            strandWrapper.style.display = "block";
        } else {
            strandWrapper.style.display = "none";
            document.getElementById("strand_id").value = "";
        }
    }

    gradeSelect.addEventListener("change", toggleStrand);
    toggleStrand();
});
</script>

@endsection
