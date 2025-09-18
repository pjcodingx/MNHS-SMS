@extends('layouts.admin')

@section('content')
<div class="page-container">

    <div class="page-header">
        <h1 style="color:#1f2937;">Add Adviser</h1>

    </div>

    <div style="background: white; padding: 20px; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); max-width: 500px;">
        <form action="{{ route('admin.advisers.store') }}" method="POST" style="display: flex; flex-direction: column; gap: 15px;">
            @csrf

            {{-- Adviser Name --}}
            <div>
                <label for="name" style="font-weight: 600; display:block; margin-bottom: 5px;">Adviser Name</label>
                <input type="text" name="name" id="name"
                       value="{{ old('name') }}"
                       style="width: 100%; padding: 10px; border: 1px solid #d1d5db;
                              border-radius: 8px; outline: none;" required>
                @error('name')
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
                <a href="{{ route('admin.advisers.index') }}"
                   style="background: #e5e7eb; color: #374151; padding: 10px 20px;
                          border-radius: 8px; text-decoration: none; font-weight: 500;">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
