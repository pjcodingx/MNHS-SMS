@extends('layouts.admin')

@section('content')
<div class="page-container">

    <div class="page-header">
        <h1 style="color:#1f2937;">Edit Adviser</h1>
        <a href="{{ route('admin.advisers.index') }}"
           style="background: #e5e7eb; color: #374151; padding: 8px 15px;
                  border-radius: 8px; text-decoration: none; font-weight: 500;">
            ← Back
        </a>
    </div>

    <div style="background: white; padding: 20px; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); max-width: 500px;">
        <form action="{{ route('admin.advisers.update', $adviser->id) }}" method="POST" style="display: flex; flex-direction: column; gap: 15px;">
            @csrf
            @method('PUT')

            {{-- Adviser Name --}}
            <div>
                <label for="name" style="font-weight: 600; display:block; margin-bottom: 5px;">Adviser Name</label>
                <input type="text" name="name" id="name"
                       value="{{ old('name', $adviser->name) }}"
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
                    Update
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
