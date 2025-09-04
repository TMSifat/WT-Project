<?php
session_start();
if (!isset($_SESSION['student'])) {
    header("Location: login.html");
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "student_db");

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

$student = $_SESSION['student'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name       = trim($_POST['name']);
    $roll       = trim($_POST['roll']);
    $email      = trim($_POST['email']);
    $department = trim($_POST['department']);
    $password   = !empty($_POST['password']) ? md5(trim($_POST['password'])) : $student['password'];
    
    // যদি নতুন ছবি আপলোড করে
    if (!empty($_FILES['profile_photo']['name'])) {
        $photo_name = $_FILES['profile_photo']['name'];
        $photo_tmp  = $_FILES['profile_photo']['tmp_name'];
        $photo_path = "uploads/" . time() . "_" . $photo_name;
        move_uploaded_file($photo_tmp, $photo_path);
    } else {
        $photo_path = $student['profile_photo'];
    }

    // Update ডাটাবেস
    $sql = "UPDATE students SET 
            name='$name', roll='$roll', email='$email', department='$department', 
            password='$password', profile_photo='$photo_path'
            WHERE id=".$student['id'];

    if (mysqli_query($conn, $sql)) {
        // Update session data
        $student['name'] = $name;
        $student['roll'] = $roll;
        $student['email'] = $email;
        $student['department'] = $department;
        $student['password'] = $password;
        $student['profile_photo'] = $photo_path;

        $_SESSION['student'] = $student;

        echo "<script>alert('Profile updated successfully!'); window.location='profile.php';</script>";
    } else {
        echo "Error updating profile: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .update-box {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
            width: 350px;
            text-align: center;
        }
        img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 15px;
            border: 3px solid #4CAF50;
            object-fit: cover;
        }
        input {
            width: 90%;
            padding: 10px;
            margin: 8px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button {
            background: #4CAF50;
            color: white;
            border: none;
            padding: 10px;
            width: 100%;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background: #45a049;
        }
        a {
            display: block;
            margin-top: 12px;
            color: #3498db;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="update-box">
        <h2>Update Profile</h2>
        <img src="<?php echo $student['profile_photo']; ?>" alt="Profile Photo">
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="text" name="name" value="<?php echo $student['name']; ?>" required><br>
            <input type="text" name="roll" value="<?php echo $student['roll']; ?>" required><br>
            <input type="email" name="email" value="<?php echo $student['email']; ?>" required><br>
            <input type="text" name="department" value="<?php echo $student['department']; ?>" required><br>
            <input type="password" name="password" placeholder="Enter new password (optional)"><br>
            <input type="file" name="profile_photo" accept="image/*"><br>
            <button type="submit">Update</button>
        </form>
        <a href="profile.php">Back to Profile</a>
    </div>
</body>
</html>
