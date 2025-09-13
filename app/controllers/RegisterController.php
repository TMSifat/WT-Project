<?php

class RegisterController
{
    private $students;

    public function __construct()
    {
        $this->students = new StudentModel();
    }

    public function showForm()
    {
        view('auth/register');
    }

    public function register()
    {
        // Mimic old behavior
        if ($this->students->usernameExists(trim($_POST['username'] ?? ''))) {
            echo "<script>alert('Username already exists! Try another.'); window.location='register.php';</script>";
            exit();
        }

        $ok = $this->students->create($_POST, $_FILES['profile_photo'] ?? null);
        if ($ok) {
            echo "<script>alert('Registration Successful! Please Login.'); window.location='login.php';</script>";
            exit();
        }

        echo "<script>alert('Registration failed!'); window.location='register.php';</script>";
        exit();
    }
}

