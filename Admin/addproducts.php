<?php
session_start();

class Database {
    private $conn;
    private $servername = "localhost:3307";
    private $username = "root";
    private $password = "";
    private $dbname = "glam_db";  

    public function connect() {
        try {
            $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
        return $this->conn;
    }

    public function close() {
        $this->conn = null;
    }
}

$database = new Database();
$conn = $database->connect();

$query = "SELECT * FROM products";
$stmt = $conn->prepare($query);
$stmt->execute();
$products = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Make-Up Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: Arial, sans-serif;
        background-color: rgb(165, 130, 150);
        color: #333;
    }

    h2 {
        text-align: center;
        margin: 40px 0;
        font-size: 2.5em;
        color: white;
    }

    h3 {
        text-align: center;
        margin-top: 20px;
        font-size: 1.5em;
        color: white;
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

    .add-product-container {
        text-align: center;
        margin: 20px;
    }

    .add-product-container button {
        background-color: rgb(68, 46, 57);
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        font-size: 1.2em;
        cursor: pointer;
    }

    .add-product-container button a {
        text-decoration: none;
        color: white;
    }
    #manage_products {
        display: none;
    }
    #products {
        padding: 20px;
    }

    .product-list {
        margin: 30px;
        padding: 30px;
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 20px;
        justify-items: center;
        max-width: 100%;
    }

    .product-item {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: stretch;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 20px;
        padding: 50px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        text-align: center;
        transition: transform 0.3s ease;
        position: relative;
    }

    .product-item:hover {
        transform: scale(1.05);
    }

    .product-item img {
        width: 100%;
    height: auto;
    border-radius: 8px;
    margin-bottom: 10px;
    clear: both;
    }

    .product-item h3 {
    font-size: 1.2em;
    color: #333;
    font-weight: bold;
    margin-bottom: 10px;
    flex-shrink: 0;
    line-height: 1.2;
    display: inline-block;
    }

    .product-item .price {
    font-size: 15px;
    color: rgb(38, 34, 34);
    margin-bottom: 15px;
    flex-shrink: 0;
    }

    .product-item button {
        background-color: #000;
        color: #fff;
        padding: 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 1em;
        width: 100%;
    }

    .product-item button:hover {
        background-color: #444;
    }

    .product-item a {
        text-decoration: none;
        color: #d32f2f;
    }

    .product-item a:hover {
        color: #b71c1c;
    }

    footer {
        background-color: rgb(165, 130, 150);
        color: white;
        padding: 20px;
        text-align: center;
    }
    @media (max-width: 1200px) {
        .product.list {
            grid-template-colums:reapeat(3,1fr);
        }
        
    }
    @media (max-width:768px) {
        .product-list {
            grid-template-columns: repeat(2,1fr);
        }
        h2 {
            font-size: 1.5em;
        }
        .product-item h3 {
            font-size: 1em;
        }
        
    }
    @media (max-width: 480px) {
    .product-list {
        grid-template-columns: 1fr;
    }

    h2 {
        font-size: 1.5em;
    }

    .product-item {
        padding: 10px;
    }

    .product-item h3 {
        font-size: 0.9em;
    }

    .product-item .price {
        font-size: 1em;
    }
}
    </style>
</head>
<body>
    <h2>Make-Up Dashboard For Admin</h2>
    <a href="dashboard.php" class="back-button">
            <i class="fas fa-arrow-left"></i>
        </a>
    <div class="add-product-container">
        <button><a href="manage_products.php">Add products</a></button>
    </div>
    <h3>Existing Products</h3>
    <section id="products">
        <div class="product-list">
        <?php foreach ($products as $product): ?>
                <div class="product-item">
                    <h3><?php echo $product['name']; ?></h3>
                    <p>Price: $<?php echo $product['price']; ?></p>
                    <p>Brand: <?php echo $product['brand']; ?></p>

                    <?php if ($product['image']): ?>
            
            <img src="<?php echo $product['image']; ?>" alt="Product Image" style="max-width: 100px; max-height: 100px;">
        <?php else: ?>
            <p>No image assigned</p>
        <?php endif; ?>

        <a href="manage_products.php?edit_id=<?php echo $product['id']; ?>">Edit</a>
        <a href="manage_products.php?delete_id=<?php echo $product['id']; ?>" onclick="return confirm('Are you sure?');">Delete</a>
                
    </div>
    <?php endforeach; ?>
    </section>

    <footer>
        <p>Copyright © 2024 Glam. All rights reserved!</p>
    </footer>

    <Script>
        function editProducts(productId) {
            window.location.href='manage_products.php?edit id='+productId;

        }
    </Script>
</body>
</html>