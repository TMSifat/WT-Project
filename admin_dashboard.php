<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "student_db");
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// যদি Admin না হয় → login এ পাঠাও
if (!isset($_SESSION['student']) || $_SESSION['student']['role'] !== 'admin') {
    header("Location: login.html");
    exit();
}

// ডিলিট বাটনে ক্লিক হলে ছাত্র ডিলিট করো
if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']);
    mysqli_query($conn, "DELETE FROM students WHERE id = $id");
    header("Location: admin_dashboard.php");
    exit();
}

// সব ছাত্রের ডেটা নিয়ে আসো
$result = mysqli_query($conn, "SELECT * FROM students WHERE role='student'");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial;
            background-color: #f4f4f4;
            padding: 20px;
        }
        h1 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: center;
        }
        th {
            background: #007BFF;
            color: white;
        }
        tr:hover {
            background: #f1f1f1;
        }
        .btn {
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 5px;
            color: white;
        }
        .edit-btn {
            background: #28a745;
        }
        .delete-btn {
            background: #dc3545;
        }
    </style>
</head>
<body>
    <h1>Welcome Admin, <?php echo $_SESSION['student']['name']; ?>!</h1>
    <a href="logout.php">Logout</a>
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
                    <img src="<?php echo $row['profile_photo']; ?>" width="50" height="50">
                <?php } else { ?>
                    <img src="uploads/default.png" width="50" height="50">
                <?php } ?>
            </td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['department']; ?></td>
            <td>
                <a href="edit_student.php?id=<?php echo $row['id']; ?>" class="btn edit-btn">Edit</a>
                <a href="admin_dashboard.php?delete_id=<?php echo $row['id']; ?>" class="btn delete-btn" onclick="return confirm('Are you sure?');">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
