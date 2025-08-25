<?php

$conn = mysqli_connect("localhost", "root", "", "student_db");

if (!$conn) {

    die("Database connection failed: " . mysqli_connect_error());

}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username   = trim($_POST['username']);

    $password   = md5(trim($_POST['password']));

    $name       = trim($_POST['name']);

    $roll       = trim($_POST['roll']);

    $email      = trim($_POST['email']);

    $department = trim($_POST['department']);

    // Check if username already exists

    $check_user = "SELECT * FROM students WHERE username='$username'";

    $result = mysqli_query($conn, $check_user);

    if (mysqli_num_rows($result) > 0) {

        echo "<script>alert('Username already exists! Try another.'); window.location='register.html';</script>";

    } else {

        // Insert new student

        $sql = "INSERT INTO students (username, password, name, roll, email, department)

                VALUES ('$username', '$password', '$name', '$roll', '$email', '$department')";

        

        if (mysqli_query($conn, $sql)) {

            echo "<script>alert('Registration Successful! Please Login.'); window.location='login.html';</script>";

        } else {

            echo "Error: " . $sql . "<br>" . mysqli_error($conn);

        }

    }

}

?>