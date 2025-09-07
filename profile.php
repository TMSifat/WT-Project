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
    <!-- External CSS -->
    <link rel="stylesheet" href="profile.css">
</head>
<body>
    <div class="profile-box">
        <img src="<?php echo $student['profile_photo']; ?>" alt="Profile Photo">
        <h2><?php echo $student['name']; ?></h2>
        <p><b>Roll:</b> <?php echo $student['roll']; ?></p>
        <p><b>Email:</b> <?php echo $student['email']; ?></p>
        <p><b>Department:</b> <?php echo $student['department']; ?></p>
        <a href="update_profile.php" class="btn update-btn">Update Profile</a>
        <a href="logout.php" class="btn logout-btn">Logout</a>
        <a href="home.php" class="btn home-btn">🏠 Home</a>
    </div>
</body>
</html>
