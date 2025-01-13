<?php
session_start();

// Kontrollo nëse përdoruesi është loguar si admin
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit();
}

// Për momentin, do të simulojmë disa përdorues
$users = [
    ['username' => 'admin', 'email' => 'admin@domain.com'],
    ['username' => 'johndoe', 'email' => 'johndoe@example.com']
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav>
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="manage_messages.php">Manage Messages</a></li>
            <li><a href="manage_products.php">Manage Products</a></li>
            <li><a href="manage_users.php">Manage Users</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <h1>Manage Users</h1>
    <table>
        <tr>
            <th>Username</th>
            <th>Email</th>
        </tr>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo htmlspecialchars($user['username']); ?></td>
                <td><?php echo htmlspecialchars($user['email']); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
