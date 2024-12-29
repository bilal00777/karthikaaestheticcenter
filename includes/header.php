<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        /* General Styling */
        .header {
            display: flex;
            background-color: #8a7a5c;
            padding: 10px 20px;
            color: white;
            align-items: center;
            justify-content: space-between;
        }

        .header .logo {
            font-size: 1.5em;
            font-weight: bold;
        }

        .header .hamburger {
            display: none;
            font-size: 1.8em;
            cursor: pointer;
        }

        /* Left Sidebar Navigation */
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #6f624c;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 20px;
            transition: transform 0.3s ease;
        }

        .sidebar a {
            padding: 15px 20px;
            display: block;
            color: white;
            text-decoration: none;
            font-size: 1.2em;
        }

        .sidebar a:hover {
            background-color: #8a7a5c;
        }

        /* Content Right Side */
        .main-content {
            margin-left: 250px;
            padding: 20px;
            transition: margin-left 0.3s ease;
        }

        /* Hamburger for Small Screens */
        .sidebar.collapsed {
            transform: translateX(-250px);
        }

        .main-content.collapsed {
            margin-left: 0;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-250px);
            }

            .main-content {
                margin-left: 0;
            }

            .header .hamburger {
                display: block;
            }

            .sidebar.open {
                transform: translateX(0);
            }
        }
    </style>
</head>
<body>

    <header class="header">
        <div class="logo">Admin Panel</div>
        <div class="hamburger" onclick="toggleSidebar()">&#9776;</div>
    </header>

    <nav class="sidebar" id="sidebar">
        <a href="admin_dashboard.php">Dashboard</a>
        <a href="admin_appointments.php">Appointments</a>
        <a href="consultion.php">consultion</a>
        <a href="settings.php">Settings</a>
        <a href="../logout.php">Logout</a>
    </nav>

    <div class="main-content" id="main-content">
        <!-- Main content of the page goes here -->






        
        <script>
    function toggleSidebar() {
        var sidebar = document.getElementById('sidebar');
        var content = document.getElementById('main-content');
        sidebar.classList.toggle('open');
        content.classList.toggle('collapsed');
    }
</script>
