<?php
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

class ProductCRUD {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAllProducts() {
        $sql = "SELECT * FROM products";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll();
    }

    public function getProductCount() {
        $sql = "SELECT COUNT(*) FROM products";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchColumn();
    }

    public function deleteProductById($id) {
        $sql = "DELETE FROM products WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}

$db = new Database();
$conn = $db->connect();
$productCRUD = new ProductCRUD($conn);
$products = $productCRUD->getAllProducts();
$productCount = $productCRUD->getProductCount();

if (isset($_GET['action'])) {
    if ($_GET['action'] == 'delete' && isset($_GET['id'])) {
        $productCRUD->deleteProductById($_GET['id']);
        header("Location: manage_products.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../dashboard.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            min-height: 100vh;
            background-color: #f4f4f4;
            color: #333;
        }

        .sidebar {
            width: 250px;
            background-color: rgb(128, 97, 114); 
            height: 100%;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 30px;
            color: white;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 0 10px 10px 0;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar ul li {
            padding: 20px;
            text-align: left;
            transition: 0.3s;
        }

        .sidebar ul li:hover {
            background-color: rgb(68, 46, 57); 
            cursor: pointer;
        }

        .sidebar ul li a {
            color: white;
            text-decoration: none;
            font-size: 18px;
        }

        .sidebar ul li i {
            margin-right: 7px;
        }

        .content {
            margin-left: 250px;
            padding: 30px;
            width: 100%;
            background-color: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        h2 {
            font-size: 1.8rem;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
            font-size: 16px;
            border-radius: 8px;
            overflow: hidden;
        }

        table, th, td {
            border: 1px solid #ddd;
            padding: 12px 15px;
            text-align: center;
        }

        th {
            background-color: rgb(166, 136, 152);
            color: #495057;
            font-weight: 500;
        }

        td {
            background-color: #fff;
            color: #6c757d;
        }

        tr:hover {
            background-color: #f1e2e2;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
            justify-content: center;
        }

        .action-buttons a {
            border-radius: 8px;
            padding: 8px 15px;
            background-color: rgb(128, 97, 114);
            color: white;
            text-decoration: none;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .action-buttons a:hover {
            background-color: #5a6268;
        }

        .action-buttons a.delete {
            background-color: rgb(193, 107, 104);
        }

        .action-buttons a.delete:hover {
            background-color: rgb(186, 91, 88);
        }
        .content button a{
            text-decoration:none;
            color: rgb(128, 97, 114);
            padding: 10px;
            border-radius:5px;
        }

        @media screen and (max-width: 768px) {
            .sidebar {
                width: 0;
            }
            .content {
                margin-left: 0;
            }
            .sidebar.active {
                width: 250px;
            }
        }
    </style>
</head>
<body>
<div class="sidebar">
    <ul>
            <li onclick="showSection('dashboard')">
                <a href="dashboard.php">
                <i class="fas fa-home"></i>Dashboard</a>
            </li>
            <li onclick="showSection('manage_messages')">
                <a href="manage_messages.php">Manage Messages</a>
            </li>
            <li onclick="showSection('manage_products')">
                <a href="manage_products.php">Manage Products</a>
            </li>
            <li onclick="showSection('manage_users')">
                <a href="manage_users.php">Manage Users</a>
            </li>
            <li >
                <a href="logout.php">Logout</a>
            </li>
        </ul>
    </div>

    <div class="content">
        <h2>Manage Products (Total Products: <?php echo $productCount; ?>)</h2>
        <button><a href="add_product.php">Add New Product</a></button>
        
        <table>
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Discount</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (count($products) > 0) {
                    foreach ($products as $product) {
                        echo "<tr>";
                        echo "<td>" . $product['name'] . "</td>";
                        echo "<td>" . $product['price'] . "€</td>";
                        echo "<td>" . $product['discount'] . "%</td>";
                        echo "<td class='action-buttons'>";
                        echo "<a href='edit_product.php?id=" . $product['id'] . "'>Edit</a>";
                        echo " <a href='?action=delete&id=" . $product['id'] . "' class='delete'>Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No products found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
