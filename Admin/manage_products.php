<?php
session_start();

require_once '../Backend/conn.php';
require_once '../Backend/Products.php';

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

        // Call createProduct to add the new product
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

        // Call updateProduct to update the product details
        Product::updateProduct($conn, $id, $name, $price, "../image/" . $image, $brand);
        header("Location: manage_products.php");
        exit();
    }
}

// Handle delete request
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    // Call deleteProduct to delete the product
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
    // Call getProductById to fetch the product for editing
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
    font-family: 'Roboto', sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
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

.admin-dashboard {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

h2 {
    font-size: 1.8rem;
    color: #333;
    text-align: center;
    margin-bottom: 20px;
}

h3 {
    font-size: 1.5rem;
    color: #333;
    margin-bottom: 20px;
    text-align: center;
}

/* Form Styles */
form {
    display: flex;
    flex-direction: column;
    gap: 15px;
    margin-bottom: 30px;
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    font-size: 14px;
    color: #555;
    margin-bottom: 5px;
}

.form-group input {
    width: 100%;
    padding: 10px;
    font-size: 14px;
    border: 1px solid #ddd;
    border-radius: 4px;
    outline: none;
    box-sizing: border-box;
}

.form-group input:focus {
    border-color: rgb(128, 97, 114);
}

button {
    padding: 10px 20px;
    font-size: 14px;
    background-color: rgb(128, 97, 114);
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: rgb(100, 75, 90);
}

/* Product List Styles */
.product-list {
    margin-top: 20px;
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: space-between;
}

.product-item {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: calc(33.33% - 20px); /* Ensure 3 items per row, with some space between */
    box-sizing: border-box;
    text-align: center;
}

.product-item h3 {
    font-size: 1.2rem;
    color: #333;
    margin-bottom: 10px;
}

.product-item p {
    font-size: 14px;
    color: #555;
    margin-bottom: 5px;
}

.product-item img {
    max-width: 100%;
    height: auto;
    border-radius: 4px;
    margin-bottom: 10px;
}

.actions {
    display: flex;
    gap: 10px;
}

.actions a {
    padding: 5px 10px;
    font-size: 14px;
    border-radius: 4px;
    text-decoration: none;
    transition: background-color 0.3s ease;
}

.actions a:first-child {
    background-color: rgb(128, 97, 114);
    color: white;
}

.actions a:first-child:hover {
    background-color: rgb(100, 75, 90);
}

.actions a:last-child {
    background-color: rgb(193, 107, 104);
    color: white;
}

.actions a:last-child:hover {
    background-color: rgb(186, 91, 88);
}

/* Responsive Styles */
@media screen and (max-width: 1024px) {
    .product-item {
        width: calc(50% - 20px); /* 2 items per row for larger tablets */
    }
}

@media screen and (max-width: 768px) {
    .product-item {
        width: 100%; /* 1 item per row for mobile screens */
    }
}

    </style>
</head>
<body>
    <div class="admin-dashboard">
    <?php if(!isset($_GET['action']) || $_GET['action'] !== 'view'): ?>
    <a href="dashboard.php" class="back-button">
            <i class="fas fa-arrow-left"></i>
        </a>
    <?php endif; ?>
        <h2>Manage Products</h2>

        <!-- Add/Edit Product Form -->
        <form method="POST" action="manage_products.php" enctype="multipart/form-data">
    <?php if ($edit_product): ?>
        <input type="hidden" name="product_id" value="<?php echo $edit_product->getId(); ?>">
        <input type="hidden" name="existing_image" value="<?php echo $edit_product->getImage(); ?>">
    <?php endif; ?>

    <div class="form-group">
        <label for="product_name">Product Name:</label>
        <input type="text" id="product_name" name="product_name" value="<?php echo $edit_product ? $edit_product->getName() : ''; ?>" required>
    </div>

    <div class="form-group">
        <label for="product_price">Price:</label>
        <input type="number" id="product_price" name="product_price" step="0.01" value="<?php echo $edit_product ? $edit_product->getPrice() : ''; ?>" required>
    </div>

    <div class="form-group">
        <label for="product_brand">Brand:</label>
        <input type="text" id="product_brand" name="product_brand" value="<?php echo $edit_product ? $edit_product->getBrand() : ''; ?>" required>
    </div>

    <div class="form-group">
        <label for="product_image">Product Image:</label>
        <input type="file" id="product_image" name="product_image">
    </div>

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
