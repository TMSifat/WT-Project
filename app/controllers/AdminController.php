<?php

class AdminController
{
    private $students;

    public function __construct()
    {
        $this->students = new StudentModel();
    }

    private function ensureAdmin()
    {
        no_cache();
        if (!isset($_SESSION['student']) || ($_SESSION['student']['role'] ?? '') !== 'admin') {
            // For admin-only pages, send unauthorized users to the admin login
            redirect('admin_login');
        }
    }

    public function dashboard()
    {
        $this->ensureAdmin();
        if (isset($_GET['delete_id'])) {
            $this->students->deleteById((int) $_GET['delete_id']);
            redirect('admin_dashboard');
        }
        $result = $this->students->allStudents();
        view('admin/dashboard', ['result' => $result]);
    }

    public function editStudent()
    {
        $this->ensureAdmin();
        $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
        $student = $this->students->findById($id);
        if (!$student) {
            redirect('admin_dashboard');
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ok = $this->students->updateById($id, $_POST, $_FILES['profile_photo'] ?? null);
            if ($ok) {
                redirect('admin_dashboard');
            }
        }
        view('admin/edit_student', ['student' => $student]);
    }
}
