<?php /** @var array $student */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile</title>
    <link rel="stylesheet" href="<?php echo asset('css/profile.css'); ?>">
</head>
<body>
    <div class="profile-box">
        <img src="<?php echo upload_url($student['profile_photo']); ?>" alt="Profile Photo">
        <h2><?php echo $student['name']; ?></h2>
        <p><b>Roll:</b> <?php echo $student['roll']; ?></p>
        <p><b>Email:</b> <?php echo $student['email']; ?></p>
        <p><b>Department:</b> <?php echo $student['department']; ?></p>
        <a href="<?php echo url('update_profile'); ?>" class="btn update-btn">Update Profile</a>
        <a href="<?php echo url('logout'); ?>" class="btn logout-btn">Logout</a>
        <a href="<?php echo url('home'); ?>" class="btn home-btn"> Home</a>
    </div>
</body>
</html>
