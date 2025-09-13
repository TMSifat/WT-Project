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
            redirect('login.php');
        }
    }

    public function dashboard()
    {
        $this->ensureAdmin();
        if (isset($_GET['delete_id'])) {
            $this->students->deleteById((int) $_GET['delete_id']);
            redirect('admin_dashboard.php');
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
            redirect('admin_dashboard.php');
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ok = $this->students->updateById($id, $_POST, $_FILES['profile_photo'] ?? null);
            if ($ok) {
                redirect('admin_dashboard.php');
            }
        }
        view('admin/edit_student', ['student' => $student]);
    }
}
