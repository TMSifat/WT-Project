<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "student_db");
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

if (!isset($_SESSION['student']) || $_SESSION['student']['role'] !== 'admin') {
    header("Location: login.html");
    exit();
}

$id = intval($_GET['id']);
$result = mysqli_query($conn, "SELECT * FROM students WHERE id = $id");
$student = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $department = $_POST['department'];

    // প্রোফাইল ছবি আপলোড
    if ($_FILES['profile_photo']['name']) {
        $target_dir = "uploads/";
        $target_file = $target_dir . time() . "_" . basename($_FILES['profile_photo']['name']);
        move_uploaded_file($_FILES['profile_photo']['tmp_name'], $target_file);
    } else {
        $target_file = $student['profile_photo'];
    }

    mysqli_query($conn, "UPDATE students SET name='$name', email='$email', department='$department', profile_photo='$target_file' WHERE id=$id");
    header("Location: admin_dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 450px;
            background: #fff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        }

        .container h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .profile-photo {
            display: flex;
            justify-content: center;
            margin-bottom: 15px;
        }

        .profile-photo img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid #007BFF;
            box-shadow: 0px 0px 8px rgba(0, 123, 255, 0.3);
        }

        label {
            font-weight: bold;
            display: block;
            margin: 8px 0 5px;
            color: #555;
        }

        input[type="text"],
        input[type="email"],
        input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            margin-bottom: 12px;
            outline: none;
            transition: 0.3s;
            font-size: 15px;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="file"]:focus {
            border-color: #007BFF;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.4);
        }

        .btn {
            width: 100%;
            padding: 12px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 10px;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 12px;
            color: #007BFF;
            text-decoration: none;
            font-size: 15px;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Student</h1>
        <div class="profile-photo">
            <img src="<?php echo $student['profile_photo'] ? $student['profile_photo'] : 'uploads/default.png'; ?>" alt="Profile Photo">
        </div>
        <form method="POST" enctype="multipart/form-data">
            <label>Name:</label>
            <input type="text" name="name" value="<?php echo $student['name']; ?>" required>

            <label>Email:</label>
            <input type="email" name="email" value="<?php echo $student['email']; ?>" required>

            <label>Department:</label>
            <input type="text" name="department" value="<?php echo $student['department']; ?>">

            <label>Change Profile Photo:</label>
            <input type="file" name="profile_photo">

            <button type="submit" class="btn">Update</button>
        </form>
        <a class="back-link" href="admin_dashboard.php">⬅ Back to Dashboard</a>
    </div>
</body>
</html>
