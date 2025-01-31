<?php
session_start();

require_once '../Backend/conn.php';
require_once '../Backend/products.php';

$database = new dbConnect();
$conn = $database->connectDB();

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_product'])) {
        // Add a new product
        $name = $_POST['product_name'];
        $price = $_POST['product_price'];
        $brand = $_POST['product_brand'];
        $image = $_FILES['product_image']['name'];

        // Upload image
        $target_dir = "../image/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $target_file = $target_dir . basename($_FILES['product_image']['name']);
        move_uploaded_file($_FILES['product_image']['tmp_name'], $target_file);

        // Create product
        Product::createProduct($conn, $name, $price, "../image/" . $image, $brand);
        header("Location: manage_products.php");
        exit();
    } elseif (isset($_POST['update_product'])) {
        // Update an existing product
        $id = $_POST['product_id'];
        $name = $_POST['product_name'];
        $price = $_POST['product_price'];
        $brand = $_POST['product_brand'];

        // Handle image update
        if ($_FILES['product_image']['name']) {
            $image = $_FILES['product_image']['name'];
            $target_dir = "../image/";
            $target_file = $target_dir . basename($_FILES['product_image']['name']);
            move_uploaded_file($_FILES['product_image']['tmp_name'], $target_file);
        } else {
            $image = $_POST['existing_image'];
        }

        // Update product
        Product::updateProduct($conn, $id, $name, $price, "../image/" . $image, $brand);
        header("Location: manage_products.php");
        exit();
    }
}

// Handle delete request
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    Product::deleteProduct($conn, $id);
    header("Location: manage_products.php");
    exit();
}

// Fetch all products
$products = Product::getAllProducts($conn);

// Fetch product for editing
$edit_product = null;
if (isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];
    $edit_product = Product::getProductById($conn, $edit_id);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: rgb(165, 130, 150);
            margin: 0;
            padding: 0;
            padding-top: 40px;
        }
        .admin-dashboard {
            max-width: 800px;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h2 {
            margin-top:18px;
            color: #333;
            font-size: 30px;
            text-align: center;
        }

        h3 {
            font-size: 24px;
            color: #333;
            margin-top: 40px;
            border-bottom: 2px solid #ddd;
            padding-bottom: 10px;
        }
        .back-button {
            position: fixed;
            top: 20px;
            left: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 50%;
            padding: 10px;
            font-size: 18px;
            color: #333;
            cursor: pointer;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .back-button:hover {
            background-color: rgb(128, 97, 114);
            color: white;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-bottom: 20px;
        }
        label {
            font-size: 16px;
            color: #555;
        }
        input[type="text"], input[type="number"], input[type="file"] {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
            outline: none;
            width: 100%;
            box-sizing: border-box;
        }

        input[type="text"]:focus, input[type="number"]:focus, input[type="file"]:focus, select:focus {
            border-color: rgb(128, 97, 114);;
        }

        button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: rgb(68, 46, 57);
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 100%;
            box-sizing: border-box;
        }

        button:hover {
            background-color: rgb(122, 101, 113);
        }

        .product-list {
            margin-top: 20px;
        }
        .product-item {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 10px;
            margin-bottom: 10px;
        }
        }
        @media screen and (max-width: 480px) {
            h2{
                font-size: 26px;
            }
        .actions a {
            text-decoration: none;
            color: #333;
        }
        .actions a:hover {
            color: rgb(68, 46, 57);
        }
    </style>
</head>
<body>
    <div class="admin-dashboard">
    <a href="dashboard.php">Back to Dashboard</a>
        <h2>Manage Products</h2>

        <!-- Add/Edit Product Form -->
        <form method="POST" action="manage_products.php" enctype="multipart/form-data">
            <?php if ($edit_product): ?>
                <input type="hidden" name="product_id" value="<?php echo $edit_product->getId(); ?>">
                <input type="hidden" name="existing_image" value="<?php echo $edit_product->getImage(); ?>">
            <?php endif; ?>

            <label for="product_name">Product Name:</label>
            <input type="text" id="product_name" name="product_name" value="<?php echo $edit_product ? $edit_product->getName() : ''; ?>" required>

            <label for="product_price">Price:</label>
            <input type="number" id="product_price" name="product_price" step="0.01" value="<?php echo $edit_product ? $edit_product->getPrice() : ''; ?>" required>

            <label for="product_brand">Brand:</label>
            <input type="text" id="product_brand" name="product_brand" value="<?php echo $edit_product ? $edit_product->getBrand() : ''; ?>" required>

            <label for="product_image">Product Image:</label>
            <input type="file" id="product_image" name="product_image">

            <?php if ($edit_product): ?>
                <button type="submit" name="update_product">Update Product</button>
            <?php else: ?>
                <button type="submit" name="add_product">Add Product</button>
            <?php endif; ?>
        </form>

        <!-- Product List -->
        <div class="product-list">
            <?php foreach ($products as $product): ?>
                <div class="product-item">
                    <h3><?php echo htmlspecialchars($product->getName()); ?></h3>
                    <p>Price: <?php echo number_format($product->getPrice(), 2); ?>€</p>
                    <p>Brand: <?php echo htmlspecialchars($product->getBrand()); ?></p>
                    <img src="<?php echo htmlspecialchars($product->getImage()); ?>" alt="<?php echo htmlspecialchars($product->getName()); ?>">
                    <div class="actions">
                        <a href="manage_products.php?edit_id=<?php echo $product->getId(); ?>">Edit</a>
                        <a href="manage_products.php?delete_id=<?php echo $product->getId(); ?>" onclick="return confirm('Are you sure?');">Delete</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
