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
function uploadImage($file) {
    $target_dir = "uploads/";

    if(!is_dir($target_dir)){
        mkdir($target_dir, 0777, true);
    }
    if(!is_writeable($target_dir)){
        return "Sorry, the upload directory is not writable.";
    }
    $target_file =  $target_dir . basename($file["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if(getimagesize($file["tmp_name"])==false) {
        return "File is not an image.";
    }
    if(file_exists($target_file)){
        return "Sorry, file already exists.";
    }
    if($file["size"]>5000000) {
        return "Sorry, your file is too large.";
    }
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        return "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    }
    if(move_uploaded_file($file["tmp_name"], $target_file)){
        return $target_file;
    }else {
        return"Sorry, there was an error uploading your file.";
    }

}

function getAllProducts() {
    $db = new Database();
    $conn = $db->connect();
    $sql = "SELECT * FROM products";
    $stmt = $conn->query($sql);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $db->close();
    return $products;
}
$products = getAllProducts();

if(isset($_POST['add_product'])) {
    $name = $_POST['product_name'];
    $price = $_POST['product_price'];
    $brand = $_POST['product_brand'];

    $image = null;
    if(isset($_POST['image_option']) && $_POST['image_option'] == 'file' && isset($_FILES['product_image'])) {
        $image = uploadImage($_FILES['product_image']);
        if(strpos($image, "Sorry") !== false) {
            echo "<script>alert('$image');</script>";
            $image = null;
        } elseif(isset($_POST['image_option']) && $_POST['image_option'] == 'url' && !empty($_POST['image_url'])) {
         $image = $_POST['image_url'];
    
        }

        $db = new Database();
        $conn = $db->connect();
        
        $sql = "INSERT INTO products (name, price, brand, image) VALUES (:name, :price, :brand, :image)";
        
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':brand', $brand);
        $stmt->bindParam(':image', $image);
        $stmt->execute();

        $db->close();
    }

    
   
    $products = getAllProducts();
}

if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    $db = new Database();
    $conn = $db->connect();
    $sql = "DELETE FROM products WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $delete_id);
    $stmt->execute();
    $db->close();
    
    header("Location: manage_products.php");
    exit();
}

$products = getAllProducts();



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
            font-family: 'Quicksand', sans-serif;
            background-color: rgb(165, 130, 150);
            margin: 0;
            padding: 0;
            padding-top: 40px;
        }
        .admin-dashboard {
            top:10px;
            padding: 40px;
            max-width: 600px;
            margin: auto;
            background-color: #fff;
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
            gap: 15px;
            margin-bottom: 30px;
        }

        label {
            font-size: 16px;
            color: #555;
        }
        input[type="radio"] {
        display: inline-block;
        vertical-align: middle;
        margin-right: 10px; 
        margin-bottom:-21px;
        }

        input[type="text"], input[type="number"], input[type="file"], select {
            padding: 12px;
            font-size: 16px;
            border: 2px solid #ddd;
            border-radius: 4px;
            outline: none;
            width: 100%;
            box-sizing: border-box;
        }

        input[type="text"]:focus, input[type="number"]:focus, input[type="file"]:focus, select:focus {
            border-color: rgb(128, 97, 114);;
        }

        button {
            padding: 12px 20px;
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
            margin-top: 30px;
        }

        .footer {
            background-color: rgb(165, 130, 150);
            text-align: center;
            padding: 20px 0;
            margin-top: 30px;
        }

        .footer p {
            color: white;
        }

        @media screen and (max-width: 768px) {
            .admin_dashboard {
                padding: 20px;


            }
            form{
                margin-bottom: 20px;
                padding: 20px;
            }
            
            button {
                width: auto;
                margin-top: 20px;
            }
            .back-button {
                border-radius: 50%;
                padding: 8px;
                font-size: 15px;
                top: 3px;
                 left: 10px;
            }
        }
        @media screen and (max-width: 480px) {
            h2{
                font-size: 26px;
            }
            h3 {
                font-size: 20px;
            }
            input[type="text"], input[type="number"], input[type="file"], select, button {
                font-size: 14px;
                padding: 10px;
            }
        }

    </style>
</head>
<body>
    <div class="admin-dashboard">
        <h2>Manage Products - Admin Dashboard</h2>

        <a href="makeup.php" class="back-button">
            <i class="fas fa-arrow-left"></i>
        </a>
        <h3>Add Products</h3>

        <form method="POST" action="manage_products.php" enctype="multipart/form-data">
            <label for="product_name">Product Name</label>
            <input type="text" id="product_name" name="product_name" required>

            <label for="product_price">Price</label>
            <input type="number" id="product_price" name="product_price" required>

            <label for="product_brand">Brand</label>
            <input type="text" id="product_brand" name="product_brand" required>

            <label for="image_option">Image Option</label>
            <input type="radio" id="file_option" name="image_option" value="file" onclick="toggleImageInput(true);" checked>
            <label for="file_option">Choose a File</label>
            <input type="radio" id="url_option" name="image_option" value="url" onclick="toggleImageInput(false);">
            <label for="url_option">Add a Link</label>

            <div id="file_input" class="image-input">
                <label for="product_image">Product Image</label>
                <input type="file" id="product_image" name="product_image" accept="image/*">
            </div>

            <div id="url_input" class="image-input" style="display: none;">
                <label for="image_url">Image URL</label>
                <input type="text" id="image_url" name="image_url" placeholder="Enter image URL">
            </div>

            <button type="submit" name="add_product">Add Product</button>
        </form>
    

        </div>
    </div>

    <footer class="footer">
        <p>Copyright © 2024 Glam. All rights reserved!</p>
    </footer>

    <script>
        function toggleImageInput(showFileInput) {
            if(showFileInput) {
                document.getElementById('file_input').style.display = 'block';
                document.getElementById('url_input').style.display = 'none';
            } else {
                document.getElementById('file_input').style.display = 'none';
                document.getElementById('url_input').style.display = 'block';
            }
        }
    </script>
</body>
</html>
