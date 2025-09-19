<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Dashboard</title>
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

        /* Toggle Button - Removed */

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
                    <div class="nav-item">
                        <a href="{{ route('registrar.dashboard') }}" class="nav-link active">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>Dashboard</span>
                        </a>
                    </div>
                </div>

                <div class="nav-section">
                    <div class="section-title">Student Management</div>
                    <div class="nav-item">
                        <a href="#" class="nav-link" onclick="toggleSubmenu(this)">
                            <i class="fas fa-user-plus"></i>
                            <span>Enrollment</span>
                            <i class="fas fa-chevron-down" style="margin-left: auto;"></i>
                        </a>
                        <div class="submenu">
                            <a href="{{ route('registrar.enrollment.create') }}" class="nav-link">Add Student</a>
                        </div>
                    </div>
                    <div class="nav-item">
                        <a href="{{ route('registrar.students.index') }}" class="nav-link" onclick="toggleSubmenu(this)">
                            <i class="fas fa-user-graduate"></i>
                            <span>Student Records</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-file-alt"></i>
                            <span>Generate Student Profile Report</span>
                        </a>
                    </div>
                </div>

                <div class="nav-section">
                    <div class="section-title">Sections & Subjects</div>
                    <div class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-door-open"></i>
                            <span>View Sections</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-book"></i>
                            <span>View Subjects</span>
                        </a>
                    </div>

                    <div class="nav-item">
                        <a href="#" class="nav-link" onclick="toggleSubmenu(this)">
                            <i class="fas fa-calendar-alt"></i>
                            <span>Schedule</span>
                            <i class="fas fa-chevron-down" style="margin-left: auto;"></i>
                        </a>
                        <div class="submenu">
                            <a href="#" class="nav-link">View Full Schedule</a>
                            <a href="#" class="nav-link">Assign Subjects to Schedule</a>
                            <a href="#" class="nav-link">Check Conflicts</a>
                        </div>
                    </div>
                </div>

                <div class="nav-section">
                    <div class="section-title">Faculty / Advisers</div>
                    <div class="nav-item">
                        <a href="#" class="nav-link" onclick="toggleSubmenu(this)">
                            <i class="fas fa-chalkboard-teacher"></i>
                            <span>View Advisers</span>
                            <i class="fas fa-chevron-down" style="margin-left: auto;"></i>
                        </a>
                        <div class="submenu">
                            <a href="#" class="nav-link">JHS Advisers</a>
                            <a href="#" class="nav-link">SHS Advisers</a>
                        </div>
                    </div>
                    <div class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-user-tie"></i>
                            <span>Assign Advisers to Sections</span>
                        </a>
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
                            <a href="#" class="nav-link">Filter by Grade</a>
                            <a href="#" class="nav-link">Filter by Strand</a>
                            <a href="#" class="nav-link">Filter by Section</a>
                        </div>
                    </div>
                    <div class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-chart-bar"></i>
                            <span>Enrollment Report</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-users"></i>
                            <span>Adviser / Faculty List</span>
                        </a>
                    </div>
                </div>

                <div class="nav-section">
                    <div class="section-title">System</div>
                    <div class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-calendar-check"></i>
                            <span>System Settings</span>
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
                    <div class="breadcrumb">Dashboard</div>
                </div>
                <div class="header-right">
                    <div class="academic-year">
                        Academic Year: 2024-2025
                    </div>
                    <div class="user-menu">
                        <div class="user-avatar">R</div>
                        <div>
                            <div style="font-weight: 600;">{{ $registrar->name }}</div>

                        </div>

                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <div class="dashboard-content">
                <!-- Statistics Cards -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <h3>Total Students</h3>
                        <div class="stat-value">{{ $students }}</div>
                        <div class="stat-change">
                            <i class="fas fa-arrow-up"></i> +5.2% from last month
                        </div>
                    </div>
                    <div class="stat-card">
                        <h3>Total Sections</h3>
                        <div class="stat-value">{{ $sections }}</div>
                        <div class="stat-change">
                            <i class="fas fa-minus"></i> No change
                        </div>
                    </div>
                    <div class="stat-card">
                        <h3>Total Advisers</h3>
                        <div class="stat-value">{{ $advisers }}</div>
                        <div class="stat-change">
                            <i class="fas fa-arrow-up"></i> +2.1% from last month
                        </div>
                    </div>
                    <div class="stat-card">
                        <h3>Enrollment Rate</h3>
                        <div class="stat-value">95.7%</div>
                        <div class="stat-change">
                            <i class="fas fa-arrow-up"></i> +1.8% from last year
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="quick-actions">
                    <h2>Quick Actions</h2>
                    <div class="action-grid">
                        <button class="action-btn">
                            <i class="fas fa-user-plus"></i>
                           <a href="{{ route('registrar.enrollment.create') }}" style="text-decoration: none; color: white;">Enroll Student</a>
                        </button>
                        <button class="action-btn">
                            <i class="fas fa-eye"></i>
                           <a href="{{ route('registrar.students.index') }}" style="text-decoration: none; color: white;">View Student Records</a>
                        </button>
                        <button class="action-btn">
                            <i class="fas fa-door-open"></i>
                            View Sections
                        </button>
                        <button class="action-btn">
                            <i class="fas fa-calendar-alt"></i>
                            View Schedule
                        </button>
                        <button class="action-btn">
                            <i class="fas fa-chalkboard-teacher"></i>
                            View Advisers
                        </button>
                        <button class="action-btn">
                            <i class="fas fa-file-download"></i>
                            Generate Reports
                        </button>
                    </div>
                </div>
            </div>
        </main>
    </div>

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




        window.addEventListener('resize', function() {
            const sidebar = document.getElementById('sidebar');
            if (window.innerWidth <= 768) {
                sidebar.classList.remove('show');
            }
        });


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
