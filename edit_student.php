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

    // pic upload
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
    <link rel="stylesheet" href="edit_student.css"> 
    <script src="edit_student.js" defer></script> 
</head>
<body>
    <div class="container">
        <h1>Edit Student</h1>
        <div class="profile-photo">
            <img id="preview" src="<?php echo $student['profile_photo'] ? $student['profile_photo'] : 'uploads/default.png'; ?>" alt="Profile Photo">
        </div>
        <form method="POST" enctype="multipart/form-data" id="editForm">
            <label>Name:</label>
            <input type="text" name="name" value="<?php echo $student['name']; ?>" required>

            <label>Email:</label>
            <input type="email" name="email" value="<?php echo $student['email']; ?>" required>

            <label>Department:</label>
            <select name="department" required>
                <option value="">-- Select Department --</option>
                <option value="CSE" <?php if($student['department']=="CSE") echo "selected"; ?>>CSE</option>
                <option value="BBA" <?php if($student['department']=="BBA") echo "selected"; ?>>BBA</option>
                <option value="EEE" <?php if($student['department']=="EEE") echo "selected"; ?>>EEE</option>
                <option value="LAW" <?php if($student['department']=="LAW") echo "selected"; ?>>LAW</option>
                <option value="ENGLISH" <?php if($student['department']=="ENGLISH") echo "selected"; ?>>ENGLISH</option>
            </select><br>

            <label>Change Profile Photo:</label>
            <input type="file" name="profile_photo" id="photoInput">

            <button type="submit" class="btn">Update</button>
        </form>
        <a class="back-link" href="admin_dashboard.php">⬅ Back to Dashboard</a>
    </div>
</body>
</html>
