<?php /** @var mysqli_result $result */ ?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="<?php echo asset('css/admin_dashboard.css'); ?>">
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
                <?php if (!empty($row['profile_photo'])) { ?>
                    <img src="<?php echo upload_url($row['profile_photo']); ?>" width="50" height="50" alt="Profile">
                <?php } else { ?>
                    <img src="<?php echo asset('uploads/default.png'); ?>" width="50" height="50" alt="Default">
                <?php } ?>
            </td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['department']; ?></td>
            <td>
                <a href="<?php echo url('edit_student.php'); ?>?id=<?php echo $row['id']; ?>" class="btn edit-btn">Edit</a>
                <a href="<?php echo url('admin_dashboard.php'); ?>?delete_id=<?php echo $row['id']; ?>" class="btn delete-btn" onclick="return confirm('Are you sure you want to delete this student?');">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
