<?php if (session_status() === PHP_SESSION_NONE) { session_start(); } ?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Profile Management System</title>
    <link rel="stylesheet" href="<?php echo asset('css/home.css'); ?>">
    <link rel="stylesheet" href="<?php echo asset('css/search.css'); ?>">
</head>
<body>
    <nav class="navbar">
        <div class="navbar-left">
            <?php if(isset($_SESSION['role'])): ?>
                <span> Logged in as: <?php echo ucfirst($_SESSION['role']); ?></span>
            <?php else: ?>
                <span> You are in Guest Mode</span>
            <?php endif; ?>
        </div>
        <div class="navbar-right">
            <?php if(isset($_SESSION['role'])): ?>
                <?php if($_SESSION['role'] == 'admin'): ?>
                    <a href="<?php echo url('admin_dashboard'); ?>" class="nav-btn">Admin Dashboard</a>
                <?php elseif($_SESSION['role'] == 'student'): ?>
                    <a href="<?php echo url('student_dashboard'); ?>" class="nav-btn">Student Dashboard</a>
                <?php elseif($_SESSION['role'] == 'faculty'): ?>
                    <a href="<?php echo url('faculty_dashboard'); ?>" class="nav-btn">Faculty Dashboard</a>
                <?php endif; ?>
                <a href="<?php echo url('logout'); ?>" class="nav-btn logout">Logout</a>
            <?php else: ?>
                <a href="<?php echo url('login'); ?>" class="nav-btn">Login</a>
                <a href="<?php echo url('register'); ?>" class="nav-btn register">Register</a>
                <a href="<?php echo url('admin_login'); ?>" class="nav-btn admin-login">Admin Login</a>
            <?php endif; ?>
        </div>
    </nav>

    <header class="hero">
        <h1> Student Profile Management System</h1>
        <p>A complete portal for Students, Faculties, and Admins</p>
        <a href="<?php echo url('login'); ?>" class="cta-btn">Get Started</a>
    </header>

    <?php if(!isset($_SESSION['role'])): ?>
        <section class="guest-search">
            <h2>Search Student By Department</h2>
            <form action="<?php echo url('search'); ?>" method="GET" class="search-form">
                 <select name="department" required>
                <option value="">-- Select Department --</option>
                <option value="CSE">CSE</option>
                <option value="BBA">BBA</option>
                <option value="EEE">EEE</option>
                <option value="LAW">LAW</option>
                <option value="ENGLISH">ENGLISH</option>
            </select><br>
                <button type="submit">Search</button>
            </form>
        </section>
    <?php endif; ?>

    <section class="about">
        <h2>About This Project</h2>
        <p>This system helps manage students, faculties, and admins efficiently. 
        Students can register and update their profiles, faculties can view and grade students, 
        and admins have full control over the system.</p>
    </section>

    <section class="features">
        <h2>Key Features</h2>
        <div class="feature-cards">
            <div class="card">
                <h3> Student Panel</h3>
                <p>Register, edit your profile, and view your courses easily.</p>
            </div>
            <div class="card">
                <h3> Faculty Panel</h3>
                <p>View student details, give grades and provide feedback.</p>
            </div>
            <div class="card">
                <h3> Admin Panel</h3>
                <p>Manage all users, system settings, and oversee activities.</p>
            </div>
        </div>
    </section>

    <section class="contact">
        <h2>Contact Us</h2>
        <p>For support or queries, reach out at:</p>
        <p><b>Email:</b> support@gmail.com</p>
        <p><b>Phone:</b> +880 1795108689</p>
    </section>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Student Profile System | Developed by Tanvir Sifat</p>
    </footer>
</body>
</html>
