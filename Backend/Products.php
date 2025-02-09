<?php
require_once 'conn.php';
class Product {
    private $id;
    private $name;
    private $price;
    private $image;
    private $brand;

    public function __construct($id, $name, $price, $image, $brand) {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->image = $image;
        $this->brand = $brand;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function getImage() {
        return $this->image;
    }

    public function setImage($image) {
        $this->image = $image;
    }

    public function getBrand() {
        return $this->brand;
    }

    public function setBrand($brand) {
        $this->brand = $brand;
    }

    public function displayProduct() {
        return "<div class='product-item' data-name='" . htmlspecialchars($this->getBrand()) . "'>
                    <img src='" . htmlspecialchars($this->getImage()) . "' alt='" . htmlspecialchars($this->getName()) . "'>
                    <h3>" . htmlspecialchars($this->getName()) . "</h3>
                    <p class='price'>" . number_format($this->getPrice(), 2) . "€</p>
                    <button>Add to cart</button>
                </div>";
    }

    public static function getAllProducts($pdo) {
        $query = "SELECT * FROM products";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        
        $products = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $product = new Product(
                $row['id'],
                $row['name'],
                $row['price'],
                $row['image'],
                $row['brand']
            );
            $products[] = $product;
        }
        return $products;
    }

    public static function createProduct($pdo, $name, $price, $image, $brand) {
        $query = "INSERT INTO products (name, price, image, brand, modified_at) 
        VALUES (:name, :price, :image, :brand,  NOW())";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':brand', $brand);

        if ($stmt->execute()) {
        $product = new Product($pdo->lastInsertId(), $name, $price, $image, $brand);            
        if(isset($id)) {
                Product::logAdminAction('insert', $id); 
        }  
        return true;
        }
        return false;
    }
    

    public static function getProductById($pdo, $id) {
        $query = "SELECT * FROM products WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return new Product(
                $row['id'],
                $row['name'],
                $row['price'],
                $row['image'],
                $row['brand']
            );
        }
        return null;
    }

    public static function updateProduct($pdo, $id, $name, $price, $image, $brand) {
        $query = "UPDATE products SET 
        name = :name,
        price = :price,
        image = :image,
        brand = :brand,
        modified_at = NOW() 
        WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':brand', $brand);
        if ($stmt->execute()) {
        $product = new Product($id, $name, $price, $image, $brand);
        $product->logAdminAction('update', $id);
            return true;
        }
        return false;
    }
    public static function deleteProduct($pdo, $id) {
         $query = "DELETE FROM admin_actions WHERE product_id = :id";
         $stmt = $pdo->prepare($query);
         $stmt->bindParam(':id', $id);
         $stmt->execute();
    
        $query = "DELETE FROM products WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            return true;  
        } else {
            return false; 
        }
    }
    

    public static function logAdminAction($action, $product_id) {
        global $conn;
        
        $sql = "INSERT INTO admin_actions (product_id, action, action_time) 
                VALUES (:product_id, :action, NOW())";
        
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
        $stmt->bindParam(':action', $action);

        $stmt->execute();
    }
    public static function getProductModifications($pdo) {
        $sql = "SELECT p.name AS product_name, aa.action, aa.action_time
                FROM admin_actions aa
                JOIN products p ON aa.product_id = p.id
                ORDER BY aa.action_time DESC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
