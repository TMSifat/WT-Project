<?php

class StudentModel
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function findByUsernameAndPassword(string $username, string $password)
    {
        // Using same hashing (md5) to keep behavior unchanged
        $usernameEsc = mysqli_real_escape_string($this->db, $username);
        $passwordHash = md5($password);
        $sql = "SELECT * FROM students WHERE username='$usernameEsc' AND password='$passwordHash'";
        $res = mysqli_query($this->db, $sql);
        return $res && mysqli_num_rows($res) === 1 ? mysqli_fetch_assoc($res) : null;
    }

    public function usernameExists(string $username): bool
    {
        $usernameEsc = mysqli_real_escape_string($this->db, $username);
        $res = mysqli_query($this->db, "SELECT id FROM students WHERE username='$usernameEsc' LIMIT 1");
        return $res && mysqli_num_rows($res) > 0;
    }

    public function create(array $data, ?array $file = null): bool
    {
        $username = mysqli_real_escape_string($this->db, $data['username'] ?? '');
        $password = md5($data['password'] ?? '');
        $name = mysqli_real_escape_string($this->db, $data['name'] ?? '');
        $roll = mysqli_real_escape_string($this->db, $data['roll'] ?? '');
        $email = mysqli_real_escape_string($this->db, $data['email'] ?? '');
        $department = mysqli_real_escape_string($this->db, $data['department'] ?? '');

        // Handle upload path same as original
        $photoPath = '';
        if ($file && isset($file['name'], $file['tmp_name']) && $file['name'] !== '') {
            if (!is_dir('public/uploads')) {
                mkdir('public/uploads', 0777, true);
            }
            $photoPath = 'public/uploads/' . time() . '_' . basename($file['name']);
            @move_uploaded_file($file['tmp_name'], $photoPath);
        }

        $sql = "INSERT INTO students (username, password, name, roll, email, department, profile_photo) VALUES (
            '$username', '$password', '$name', '$roll', '$email', '$department', '$photoPath'
        )";
        return (bool) mysqli_query($this->db, $sql);
    }

    public function allStudents()
    {
        return mysqli_query($this->db, "SELECT * FROM students WHERE role='student'");
    }

    public function deleteById(int $id): bool
    {
        return (bool) mysqli_query($this->db, "DELETE FROM students WHERE id = $id");
    }

    public function findById(int $id)
    {
        $res = mysqli_query($this->db, "SELECT * FROM students WHERE id = $id");
        return $res ? mysqli_fetch_assoc($res) : null;
    }

    public function updateById(int $id, array $data, ?array $file = null): bool
    {
        $existing = $this->findById($id);
        if (!$existing) return false;

        $name = mysqli_real_escape_string($this->db, $data['name'] ?? $existing['name']);
        $email = mysqli_real_escape_string($this->db, $data['email'] ?? $existing['email']);
        $department = mysqli_real_escape_string($this->db, $data['department'] ?? $existing['department']);

        $photo = $existing['profile_photo'];
        if ($file && isset($file['name']) && $file['name'] !== '') {
            if (!is_dir('public/uploads')) {
                mkdir('public/uploads', 0777, true);
            }
            $photo = 'public/uploads/' . time() . '_' . basename($file['name']);
            @move_uploaded_file($file['tmp_name'], $photo);
        }

        $sql = "UPDATE students SET name='$name', email='$email', department='$department', profile_photo='$photo' WHERE id=$id";
        return (bool) mysqli_query($this->db, $sql);
    }

    public function updateProfile(int $id, array $data, ?array $file = null): bool
    {
        $existing = $this->findById($id);
        if (!$existing) return false;

        $name = mysqli_real_escape_string($this->db, $data['name'] ?? $existing['name']);
        $roll = mysqli_real_escape_string($this->db, $data['roll'] ?? $existing['roll']);
        $email = mysqli_real_escape_string($this->db, $data['email'] ?? $existing['email']);
        $department = mysqli_real_escape_string($this->db, $data['department'] ?? $existing['department']);

        $password = $existing['password'];
        if (!empty($data['password'])) {
            $password = md5($data['password']);
        }

        $photo = $existing['profile_photo'];
        if ($file && isset($file['name']) && $file['name'] !== '') {
            if (!is_dir('public/uploads')) {
                mkdir('public/uploads', 0777, true);
            }
            $photo = 'public/uploads/' . time() . '_' . basename($file['name']);
            @move_uploaded_file($file['tmp_name'], $photo);
        }

        $sql = "UPDATE students SET name='$name', roll='$roll', email='$email', department='$department', password='$password', profile_photo='$photo' WHERE id=$id";
        return (bool) mysqli_query($this->db, $sql);
    }

    public function searchByDepartment(string $dept)
    {
        $deptEsc = mysqli_real_escape_string($this->db, $dept);
        $query = "SELECT * FROM students WHERE 1=1";
        if ($deptEsc !== '') {
            $query .= " AND department LIKE '%$deptEsc%'";
        }
        return mysqli_query($this->db, $query);
    }
}
