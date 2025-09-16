<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manhilo National High School - Student Information System</title>
    <link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
    <link rel="icon" sizes="32x32"href="{{ asset('images/auth/manhilo.jpg') }}" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600&family=Roboto+Mono:wght@300;400&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="background-overlay"></div>

    <div class="container">
        <div class="login-card">

            <div class="left-section">
                <div class="logo-container">
                    <div class="school-logo">
                        <img src="{{ asset('images/auth/manhilo.jpg') }}" alt="Dominican School of Cebu circular logo with Dominican cross and text 'DOMINICAN SCHOOL CEBU BENEDICERE' around the border">
                    </div>
                    <h1 class="school-name">Manhilo National HighSchool</h1>
                    <p class="system-name">Student Information System</p>
                </div>
            </div>


            <div class="right-section">
                <h2 class="login-title">LOGIN PORTAL</h2>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form class="login-form" method="post" action="{{ route('login.post') }}">
                    @csrf
                    <div class="input-group">
                        <input type="text" id="email" name="email" placeholder="Email address or ID number" class="form-input" required>
                    </div>

                    <div class="input-group">
                        <input type="password" id="password" name="password" placeholder="Password" class="form-input" required>
                    </div>

                    <div class="forgot-password-container">
                        <a href="#" class="forgot-password">Forgot Password? Contact Admin</a>
                    </div>

                    <button type="submit" class="login-btn">Login</button>
                </form>


            </div>
        </div>
    </div>
</body>
</html>
