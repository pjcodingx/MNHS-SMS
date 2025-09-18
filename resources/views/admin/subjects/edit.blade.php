@extends('layouts.admin')

@section('content')
<div class="page-container">
    <div class="page-header">
        <h1>Edit Subject</h1>
    </div>

    <div class="card">
        <form action="{{ route('admin.subjects.update', $subject->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Subject Name -->
            <div class="form-group">
                <label for="name">Subject Name</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    class="form-control"
                    value="{{ old('name', $subject->name) }}"
                    required
                >
                @error('name')
                    <small class="error">{{ $message }}</small>
                @enderror
            </div>

            <!-- Grade Level Dropdown -->
            <div class="form-group">
                <label for="grade_level_id">Grade Level</label>
                <select
                    name="grade_level_id"
                    id="grade_level_id"
                    class="form-control"
                    required
                >
                    <option value="">-- Select Grade Level --</option>
                    @foreach($gradeLevels as $grade)
                        <option
                            value="{{ $grade->id }}"
                            {{ $subject->grade_level_id == $grade->id ? 'selected' : '' }}
                        >
                            {{ $grade->name }}
                        </option>
                    @endforeach
                </select>
                @error('grade_level_id')
                    <small class="error">{{ $message }}</small>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="form-actions">
                <button type="submit" class="btn btn-success">Update</button>
                <a href="{{ route('admin.subjects.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

<style>
.page-container {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
}
.page-header h1 {
    font-size: 22px;
    margin-bottom: 15px;
}
.card {
    background: #fff;
    border: 1px solid #ddd;
    padding: 20px;
    border-radius: 6px;
}
.form-group {
    margin-bottom: 15px;
}
.form-group label {
    font-weight: 600;
    margin-bottom: 6px;
    display: block;
}
.form-control {
    width: 100%;
    padding: 8px 10px;
    border: 1px solid #bbb;
    border-radius: 4px;
    font-size: 14px;
}
.error {
    color: red;
    font-size: 13px;
}
.form-actions {
    margin-top: 20px;
    display: flex;
    gap: 10px;
}
.btn {
    padding: 8px 14px;
    border-radius: 4px;
    font-size: 14px;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
}
.btn-success {
    background: #198754;
    color: #fff;
    border: none;
}
.btn-success:hover {
    background: #157347;
}
.btn-secondary {
    background: #6c757d;
    color: #fff;
    border: none;
}
.btn-secondary:hover {
    background: #5c636a;
}
</style>
@endsection
