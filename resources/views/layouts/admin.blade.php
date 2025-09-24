<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 280px;
            background: linear-gradient(180deg, #2563eb 0%, #1e40af 100%);
            box-shadow: 4px 0 15px rgba(0, 0, 0, 0.1);
        }

        .sidebar-header {
            padding: 25px 20px;
            text-align: center;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
        }

        .logo {
            color: white;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .logo i {
            margin-right: 10px;
        }

        .subtitle {
            color: rgba(255, 255, 255, 0.8);
            font-size: 14px;
        }

        .nav-menu {
            padding: 20px 0;
        }

        .nav-section {
            margin-bottom: 30px;
        }

        .section-title {
            color: rgba(255, 255, 255, 0.6);
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 0 20px;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .nav-item {
            margin-bottom: 5px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .nav-link.active {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            border-right: 3px solid #60a5fa;
        }

        .nav-link i {
            width: 20px;
            margin-right: 15px;
            text-align: center;
        }

        .submenu {
            display: none;
            background: rgba(0, 0, 0, 0.1);
            padding-left: 40px;
        }

        .submenu.show {
            display: block;
        }

        .submenu .nav-link {
            padding: 8px 20px;
            font-size: 14px;
        }

        /* Main Content */
        .main-content {
            width: calc(100vw - 280px);
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            margin: 20px;
            margin-left: 0;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        /* Header */
        .header {
            background: white;
            padding: 20px 30px;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .header-left h1 {
            color: #1f2937;
            font-size: 28px;
            font-weight: 600;
        }

        .breadcrumb {
            color: #6b7280;
            font-size: 14px;
            margin-top: 5px;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .academic-year {
            background: #3b82f6;
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            font-size: 14px;
            font-weight: 500;
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(45deg, #3b82f6, #1d4ed8);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }

        /* Dashboard Content */
        .dashboard-content {
            padding: 30px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            border-left: 4px solid #3b82f6;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        .stat-card h3 {
            color: #6b7280;
            font-size: 14px;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-value {
            font-size: 32px;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 5px;
        }

        .stat-change {
            font-size: 12px;
            color: #10b981;
        }

        .quick-actions {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .quick-actions h2 {
            color: #1f2937;
            margin-bottom: 20px;
            font-size: 20px;
        }

        .action-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }

        .action-btn {
            background: linear-gradient(45deg, #3b82f6, #1d4ed8);
            color: white;
            padding: 15px;
            border-radius: 10px;
            text-decoration: none;
            text-align: center;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(59, 130, 246, 0.4);
        }

        .action-btn i {
            margin-right: 8px;
        }

        /* Toggle Button */
        .sidebar-toggle {
            position: absolute;
            top: 15px;
            right: -15px;
            background: #3b82f6;
            color: white;
            border: none;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                left: -280px;
                top: 0;
                height: 100vh;
                z-index: 1000;
            }

            .sidebar.show {
                left: 0;
            }

            .main-content {
                margin: 10px;
                border-radius: 10px;
            }

            .header {
                padding: 15px 20px;
            }

            .dashboard-content {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <nav class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="logo">
                    <i class="fas fa-graduation-cap"></i>
                    SIS
                </div>
                <div class="subtitle">Student Information System</div>
            </div>

            <div class="nav-menu">
                <div class="nav-section">
                    <div class="section-title">Main</div>
                    <div class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link ">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>Dashboard</span>
                        </a>
                    </div>
                </div>

                <div class="nav-section">
                    <div class="section-title">User Management</div>
                    <div class="nav-item {{ request()->routeIs('admin.registrars.create') ? 'active' : '' }}">
                        <a href="{{ route('admin.registrars.create') }}" class="nav-link">
                            <i class="fas fa-users"></i>
                            <span>Registrars</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="{{ route('admin.advisers.index') }}" class="nav-link">
                            <i class="fas fa-chalkboard-teacher"></i>
                            <span>Faculty / Advisers</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-user-graduate"></i>
                            <span>Students</span>
                        </a>
                    </div>
                </div>

                <div class="nav-section">
                    <div class="section-title">Academic</div>
                    <div class="nav-item">

                    <div class="nav-item">
                        <a href="{{ route('admin.sections.index') }}" class="nav-link">
                            <i class="fas fa-door-open"></i>
                            <span>Sections</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="{{ route('admin.subjects.index') }}" class="nav-link">
                            <i class="fas fa-book"></i>
                            <span>Subjects</span>
                        </a>
                    </div>

                     <div class="nav-item">
                        <a href="{{ route('admin.section_subjects.index') }}" class="nav-link">
                            <i class="fas fa-calendar-alt"></i>
                            <span>Assign subjects</span>
                        </a>
                    </div>

                      <div class="nav-item">
                        <a href="{{ route('admin.schedules.index') }}" class="nav-link">
                            <i class="fas fa-calendar-alt"></i>
                            <span>Assign schedules</span>
                        </a>
                    </div>




                     <a href="#" class="nav-link" onclick="toggleSubmenu(this)">
                            <i class="fas fa-layer-group"></i>
                            <span>Grade Levels (JHS)</span>
                            <i class="fas fa-chevron-down" style="margin-left: auto;"></i>
                        </a>
                        <div class="submenu">
                            <a href="#" class="nav-link">Grade 7</a>
                            <a href="#" class="nav-link">Grade 8</a>
                            <a href="#" class="nav-link">Grade 9</a>
                            <a href="#" class="nav-link">Grade 10</a>
                        </div>
                    </div>
                    <div class="nav-item">
                        <a href="#" class="nav-link" onclick="toggleSubmenu(this)">
                            <i class="fas fa-code-branch"></i>
                            <span>Strands (SHS)</span>
                            <i class="fas fa-chevron-down" style="margin-left: auto;"></i>
                        </a>
                        <div class="submenu">
                            <a href="#" class="nav-link">STEM</a>
                            <a href="#" class="nav-link">ABM</a>
                            <a href="#" class="nav-link">HUMSS</a>
                            <a href="#" class="nav-link">GAS</a>
                        </div>
                    </div>

                </div>

                <div class="nav-section">
                    <div class="section-title">Reports</div>
                    <div class="nav-item">
                        <a href="#" class="nav-link" onclick="toggleSubmenu(this)">
                            <i class="fas fa-list"></i>
                            <span>Student Master List</span>
                            <i class="fas fa-chevron-down" style="margin-left: auto;"></i>
                        </a>
                        <div class="submenu">
                            <a href="#" class="nav-link">JHS Students</a>
                            <a href="#" class="nav-link">SHS Students</a>
                        </div>
                    </div>
                    <div class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-user-tie"></i>
                            <span>Adviser List</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-chart-bar"></i>
                            <span>Enrollment Report</span>
                        </a>
                    </div>
                </div>

                <div class="nav-section">
                    <div class="section-title">System</div>
                    <div class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-cogs"></i>
                            <span>System Settings</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-calendar-check"></i>
                            <span>Academic Year</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf

                           <button type="submit" class="nav-link" style="
                                display: flex;
                                align-items: center;
                                padding: 12px 20px;
                                color: rgba(255, 255, 255, 0.9);
                                text-decoration: none;
                                transition: all 0.3s ease;
                                background: none;
                                border: none;
                                width: 100%;
                                cursor: pointer;
                                font-size: 15px;
                            ">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </button>

                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Header -->
            <header class="header">
                <div class="header-left">
                    <h1>Dashboard</h1>

                </div>
                <div class="header-right">
                    <div class="academic-year">
                        Academic Year: 2024-2025
                    </div>
                    <div class="user-menu">
                        <div class="user-avatar">A</div>
                        <div>
                            <div style="font-weight: 600;">{{ $admin->name }}</div>
                            <div style="font-size: 12px; color: #6b7280;">System Admin</div>
                        </div>
                    </div>
                </div>
            </header>

            @yield('content')




    <script>


        function toggleSubmenu(element) {
            const submenu = element.parentNode.querySelector('.submenu');
            const chevron = element.querySelector('.fa-chevron-down, .fa-chevron-up');

            if (submenu) {
                submenu.classList.toggle('show');

                if (chevron) {
                    if (submenu.classList.contains('show')) {
                        chevron.className = 'fas fa-chevron-up';
                    } else {
                        chevron.className = 'fas fa-chevron-down';
                    }
                }
            }
        }

        function logout() {
            if (confirm('Are you sure you want to logout?')) {
                alert('Logging out...');
                // Implement logout functionality here
            }
        }

        // Mobile responsiveness
        window.addEventListener('resize', function() {
            const sidebar = document.getElementById('sidebar');
            if (window.innerWidth <= 768) {
                sidebar.classList.remove('show');
            }
        });

        // Add active state to nav links
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function(e) {
                if (!this.getAttribute('onclick') || !this.getAttribute('onclick').includes('toggleSubmenu')) {
                    document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
                    this.classList.add('active');
                }
            });
        });
    </script>
</body>
</html>
