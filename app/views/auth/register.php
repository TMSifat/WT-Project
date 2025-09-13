<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <link rel="stylesheet" href="<?php echo asset('css/register.css'); ?>">
</head>
<body>
    <div class="reg-box">
        <h2>Student Registration</h2>
        <form action="<?php echo url('register'); ?>" method="POST" enctype="multipart/form-data">
            <input type="text" name="username" placeholder="Enter Username" required><br>
            <input type="password" name="password" placeholder="Enter Password" required><br>
            <input type="text" name="name" placeholder="Enter Full Name" required><br>
            <input type="text" name="roll" placeholder="Enter Roll Number" required><br>
            <input type="email" name="email" placeholder="Enter Email" required><br>
            <select name="department" required>
                <option value="">-- Select Department --</option>
                <option value="CSE">CSE</option>
                <option value="BBA">BBA</option>
                <option value="EEE">EEE</option>
                <option value="LAW">LAW</option>
                <option value="ENGLISH">ENGLISH</option>
            </select><br>
            <input type="file" name="profile_photo" accept="image/*" required><br>
            <button type="submit">Register</button>
        </form>
        <script src="<?php echo asset('js/register1.js'); ?>"></script>
        <a href="<?php echo url('login'); ?>">Already have an account? Login</a>
    </div>
</body>
</html>
