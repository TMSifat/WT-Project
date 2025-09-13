<?php

class AuthController
{
    private $students;

    public function __construct()
    {
        $this->students = new StudentModel();
    }

    public function showStudentLogin()
    {
        view('auth/login_student');
    }

    public function showAdminLogin()
    {
        view('auth/login_admin');
    }

    public function login(string $loginType = 'student')
    {
        $username = trim($_POST['username'] ?? '');
        $password = trim($_POST['password'] ?? '');
        $login_type = $_POST['login_type'] ?? $loginType;

        $user = $this->students->findByUsernameAndPassword($username, $password);
        if ($user) {
            // Role gate to preserve behavior
            if ($login_type === 'admin' && ($user['role'] ?? 'student') !== 'admin') {
                echo "<script>alert('Access denied! Please use the Student Login'); window.location='login.php';</script>";
                exit();
            } elseif ($login_type === 'student' && ($user['role'] ?? 'student') !== 'student') {
                echo "<script>alert('Access denied! Please use the Admin Login'); window.location='login.php';</script>";
                exit();
            }

            $_SESSION['student'] = $user;
            if (($user['role'] ?? 'student') === 'admin') {
                redirect('admin_dashboard.php');
            } else {
                redirect('profile.php');
            }
        }

        echo "<script>alert('Invalid username or password'); window.location='login.php';</script>";
        exit();
    }

    public function logout()
    {
        $role = isset($_SESSION['student']['role']) ? $_SESSION['student']['role'] : 'student';
        // Invalidate session + cookie
        $_SESSION = [];
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
        }
        session_destroy();
        no_cache();
        header('Clear-Site-Data: "cache"');
        if ($role === 'admin') {
            redirect('admin_login.php');
        }
        redirect('login.php');
    }
}
