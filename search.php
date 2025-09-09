<?php
$conn = mysqli_connect("localhost", "root", "", "student_db");
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

$dept = $_GET['department'] ?? '';

$query = "SELECT * FROM students WHERE 1=1";

if (!empty($dept)) {
    $query .= " AND department LIKE '%$dept%'";
}

$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Search Results</title>
    <link rel="stylesheet" href="home.css">
</head>
<body>
    <div class="about">
        <h2>Search Results</h2>
        <?php if(mysqli_num_rows($result) > 0): ?>
            <table border="1" cellspacing="1" style="margin:auto;">
                <tr>
                    <th>Roll</th>
                    <th>Name</th>
                    <th>Department</th>
                </tr>
                <?php while($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo $row['roll']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['department']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p>No students found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
