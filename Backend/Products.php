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

    // Getters and setters...
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

    // Display product method
    public function displayProduct() {
        return "<div class='product-item' data-name='" . htmlspecialchars($this->getBrand()) . "'>
                    <img src='" . htmlspecialchars($this->getImage()) . "' alt='" . htmlspecialchars($this->getName()) . "'>
                    <h3>" . htmlspecialchars($this->getName()) . "</h3>
                    <p class='price'>" . number_format($this->getPrice(), 2) . "€</p>
                    <button>Add to cart</button>
                </div>";
    }

    // Static method to fetch all products
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

    // Create a new product
    public static function createProduct($pdo, $name, $price, $image, $brand) {
        $query = "INSERT INTO products (name, price, image, brand) VALUES (:name, :price, :image, :brand)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':brand', $brand);
        return $stmt->execute();
    }

    // Read a single product by ID
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

    // Update an existing product
    public static function updateProduct($pdo, $id, $name, $price, $image, $brand) {
        $query = "UPDATE products SET name = :name, price = :price, image = :image, brand = :brand WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':brand', $brand);
        return $stmt->execute();
    }

    // Delete a product by ID
    public static function deleteProduct($pdo, $id) {
        $query = "DELETE FROM products WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>
