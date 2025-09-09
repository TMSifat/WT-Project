<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="style.css"> <!-- Optional CSS -->
</head>
<body>
    <div class="container">
        <h1>Admin Login</h1>
        <form action="login.php" method="POST" onsubmit="return validateLoginForm(event)">

            <input type="hidden" name="login_type" value="admin">

            <label>Username</label>
            <input type="text" id="username" name="username" placeholder="Enter your username" required onkeyup="validateUsername(this)">
            <small id="usernameMessage"></small>

            <label>Password</label>
            <div style="display: flex; align-items: center;">
                <input type="password" id="password" name="password" placeholder="Enter your password" required style="flex: 1;">
                <span id="toggleIcon" onclick="togglePassword()" style="cursor:pointer; margin-left:5px;"></span>
            </div>

            <button type="submit" class="btn">Login</button>
        </form>

        <div class="extra-links">
            <a href="home.php"> Home</a>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
