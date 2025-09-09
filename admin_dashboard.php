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


if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']);
    mysqli_query($conn, "DELETE FROM students WHERE id = $id");
    header("Location: admin_dashboard.php");
    exit();
}


$result = mysqli_query($conn, "SELECT * FROM students WHERE role='student'");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <!-- External CSS -->
    <link rel="stylesheet" href="admin_dashboard.css">
</head>
<body>
    <h1>Welcome Admin, <?php echo $_SESSION['student']['name']; ?>!</h1>
    <a href="logout.php" class="logout-btn">Logout</a>
    <hr>
    <h2>All Students</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Photo</th>
            <th>Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Department</th>
            <th>Action</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td>
                <?php if ($row['profile_photo']) { ?>
                    <img src="<?php echo $row['profile_photo']; ?>" width="50" height="50" alt="Profile">
                <?php } else { ?>
                    <img src="uploads/default.png" width="50" height="50" alt="Default">
                <?php } ?>
            </td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['department']; ?></td>
            <td>
                <a href="edit_student.php?id=<?php echo $row['id']; ?>" class="btn edit-btn">Edit</a>
                <a href="admin_dashboard.php?delete_id=<?php echo $row['id']; ?>" class="btn delete-btn" onclick="return confirm('Are you sure you want to delete this student?');">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
