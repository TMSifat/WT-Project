<?php /** @var array $student */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <link rel="stylesheet" href="<?php echo asset('css/update_profile.css'); ?>">
</head>
<body>
    <div class="update-box">
        <h2>Update Profile</h2>
        <img src="<?php echo upload_url($student['profile_photo']); ?>" alt="Profile Photo">
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
        <a href="<?php echo url('profile.php'); ?>">Back to Profile</a>
    </div>
    <script src="<?php echo asset('js/update_profile.js'); ?>"></script>
</body>
</html>
