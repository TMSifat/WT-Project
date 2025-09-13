<?php

class HomeController
{
    private $students;

    public function __construct()
    {
        $this->students = new StudentModel();
    }

    public function home()
    {
        view('home/home');
    }

    public function search()
    {
        $dept = $_GET['department'] ?? '';
        $result = $this->students->searchByDepartment($dept);
        view('home/search', ['result' => $result]);
    }
}

