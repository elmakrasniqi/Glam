<?php
session_start();


if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit();
}

$products = [
    ['name' => 'Lipstick', 'price' => '$20', 'description' => 'High-quality lipstick for all occasions.'],
    ['name' => 'Foundation', 'price' => '$30', 'description' => 'Long-lasting foundation for a flawless look.']
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>
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

    <h1>Manage Products</h1>
    <table>
        <tr>
            <th>Product Name</th>
            <th>Price</th>
            <th>Description</th>
        </tr>
        <?php foreach ($products as $product): ?>
            <tr>
                <td><?php echo htmlspecialchars($product['name']); ?></td>
                <td><?php echo htmlspecialchars($product['price']); ?></td>
                <td><?php echo htmlspecialchars($product['description']); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
