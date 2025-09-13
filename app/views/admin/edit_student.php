<?php /** @var array $student */ ?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
    <link rel="stylesheet" href="<?php echo asset('css/edit_student.css'); ?>">
    <script src="<?php echo asset('js/edit_student.js'); ?>" defer></script>
</head>
<body>
    <div class="container">
        <h1>Edit Student</h1>
        <div class="profile-photo">
            <img id="preview" src="<?php echo !empty($student['profile_photo']) ? upload_url($student['profile_photo']) : asset('uploads/default.png'); ?>" alt="Profile Photo">
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
        <a class="back-link" href="<?php echo url('admin_dashboard.php'); ?>">← Back to Dashboard</a>
    </div>
</body>
</html>
