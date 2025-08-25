<?php

session_start();

if (!isset($_SESSION['student'])) {

    header("Location: login.html");

    exit();

}

$student = $_SESSION['student'];

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Student Profile</title>

    <style>

        body {

            font-family: Arial, sans-serif;

            background-color: #f2f2f2;

            display: flex;

            justify-content: center;

            align-items: center;

            height: 100vh;

        }

        .profile-box {

            background: white;

            padding: 20px;

            border-radius: 10px;

            box-shadow: 0 0 10px rgba(0,0,0,0.2);

            width: 350px;

            text-align: left;

        }

        h2 {

            color: #333;

            text-align: center;

        }

        p {

            font-size: 16px;

            margin: 5px 0;

        }

        .logout-btn {

            display: block;

            text-align: center;

            margin-top: 15px;

            background: #e74c3c;

            color: white;

            padding: 8px;

            border-radius: 5px;

            text-decoration: none;

        }

        .logout-btn:hover {

            background: #c0392b;

        }

    </style>

</head>

<body>

    <div class="profile-box">

        <h2>Student Details</h2>

        <p><b>Name:</b> <?php echo $student['name']; ?></p>

        <p><b>Roll:</b> <?php echo $student['roll']; ?></p>

        <p><b>Email:</b> <?php echo $student['email']; ?></p>

        <p><b>Department:</b> <?php echo $student['department']; ?></p>

        <a href="logout.php" class="logout-btn">Logout</a>

    </div>

</body>

</html>