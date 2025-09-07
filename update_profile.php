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
            WHERE id=" . $student['id'];

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
    <!-- External CSS -->
    <link rel="stylesheet" href="update_profile.css">
</head>
<body>
    <div class="update-box">
        <h2>Update Profile</h2>
        <img src="<?php echo $student['profile_photo']; ?>" alt="Profile Photo">
        <form action="" method="POST" enctype="multipart/form-data" onsubmit="return validateForm(event)">
            <input type="text" name="name" id="name" value="<?php echo $student['name']; ?>" required><br>
            <input type="text" name="roll" id="roll" value="<?php echo $student['roll']; ?>" required><br>
            <input type="email" name="email" id="email" value="<?php echo $student['email']; ?>" required><br>
            
            <select name="department" id="department" required>
                <option value="">-- Select Department --</option>
                <option value="CSE" <?php echo ($student['department']=="CSE")?"selected":""; ?>>CSE</option>
                <option value="BBA" <?php echo ($student['department']=="BBA")?"selected":""; ?>>BBA</option>
                <option value="EEE" <?php echo ($student['department']=="EEE")?"selected":""; ?>>EEE</option>
                <option value="LAW" <?php echo ($student['department']=="LAW")?"selected":""; ?>>LAW</option>
                <option value="ENGLISH" <?php echo ($student['department']=="ENGLISH")?"selected":""; ?>>ENGLISH</option>
            </select><br>

            <input type="password" name="password" id="password" placeholder="Enter new password (optional)"><br>
            <input type="file" name="profile_photo" id="profile_photo" accept="image/*"><br>
            <button type="submit">Update</button>
        </form>
        <a href="profile.php">Back to Profile</a>
    </div>
    <script src="update_profile.js"></script>
</body>
</html>
