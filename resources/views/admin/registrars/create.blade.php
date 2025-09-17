@extends('layouts.admin')


@section('title', 'Registrars')



@section('content')
<style>
    .form-card {
        background: #fff;
        border-radius: 12px;
        padding: 25px;
        max-width: 600px;
        margin: 0 auto;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    .form-card h2 {
        font-size: 1.4rem;
        margin-bottom: 20px;
        font-weight: bold;
        color: #2c3e50;
        text-align: center;
    }
    .form-group {
        margin-bottom: 15px;
    }
    .form-group label {
        display: block;
        font-weight: 600;
        margin-bottom: 6px;
        color: #34495e;
    }
    .form-group input,
    .form-group select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 14px;
        transition: 0.2s ease-in-out;
    }
    .form-group input:focus,
    .form-group select:focus {
        border-color: #27ae60;
        outline: none;
        box-shadow: 0 0 5px rgba(39,174,96,0.3);
    }
    .btn-submit {
        background: #27ae60;
        color: #fff;
        border: none;
        padding: 10px 18px;
        font-size: 14px;
        border-radius: 8px;
        cursor: pointer;
        transition: 0.2s;
    }
    .btn-submit:hover {
        background: #219150;
    }

    .alert-error {
        background-color: #fee2e2;
        color: #991b1b;
        padding: 10px;
        border-radius: 6px;
        margin-top: 10px;
        font-size: 14px;
    }
</style>

<div class="form-card">
    <h2>Create Registrar Account</h2>

    @if($errors->any())
        <div class="alert-error">
            <ul style="margin: 5px 0; padding-left: 20px;">
                @foreach($errors->all() as $error)
                    <ul>{{ $error }}</ul>
                @endforeach
            </ul>
        </div>
    @endif



    <form action="{{ route('admin.registrars.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Registrar Name</label>
            <input type="text" name="name" id="name" placeholder="Enter name" required>
        </div>

        <div class="form-group">
            <label for="email">Registrar Email</label>
            <input type="email" name="email" id="email" placeholder="Enter email" required>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Enter password" required>
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Re-enter password" required>
        </div>

        <div class="form-group">
            <label for="type">Type of Registrar</label>
            <select name="type" id="type" required>
                <option value="">-- Select Type --</option>
                <option value="JHS">Junior High School</option>
                <option value="SHS">Senior High School</option>
            </select>
        </div>

        <button type="submit" class="btn-submit">Create Account</button>
    </form>
</div>

@endsection
