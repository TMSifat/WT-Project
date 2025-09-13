<?php

class ProfileController
{
    private $students;

    public function __construct()
    {
        $this->students = new StudentModel();
    }

    private function ensureLoggedIn()
    {
        no_cache();
        if (!isset($_SESSION['student'])) {
            redirect('login.php');
        }
    }

    public function viewProfile()
    {
        $this->ensureLoggedIn();
        $student = $_SESSION['student'];
        view('profile/view', ['student' => $student]);
    }

    public function updateProfile()
    {
        $this->ensureLoggedIn();
        $student = $_SESSION['student'];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ok = $this->students->updateProfile((int)$student['id'], $_POST, $_FILES['profile_photo'] ?? null);
            if ($ok) {
                // refresh session data
                $_SESSION['student'] = $this->students->findById((int)$student['id']);
                echo "<script>alert('Profile updated successfully!'); window.location='profile.php';</script>";
                return;
            }
        }
        // Reload latest
        $student = $this->students->findById((int)$student['id']);
        view('profile/update', ['student' => $student]);
    }
}
