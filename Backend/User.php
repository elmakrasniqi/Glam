<?php
require_once 'conn.php';

class User {
    protected $conn;
    protected $table = "users";

    public $id;
    public $first_name;
    public $last_name;
    public $email;
    public $password;
    public $role;

    public function __construct() {
        $database = new dbConnect();
        $this->conn = $database->connectDB();
    }

    // Login method
    public function login($email, $password) {
        $sql = "SELECT * FROM " . $this->table . " WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user && password_verify($password, $user['password'])) {
            return $user; // Return the user data
        }
        
        return false; // Invalid credentials
    }

    // Register method
    public function register() {
        $sql = "SELECT * FROM " . $this->table . " WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":email", $this->email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return false; // Email already exists
        }

        $sql = "INSERT INTO " . $this->table . " (first_name, last_name, email, password, role) 
                VALUES (:first_name, :last_name, :email, :password, :role)";
        $stmt = $this->conn->prepare($sql);

        $this->first_name = htmlspecialchars(strip_tags($this->first_name));
        $this->last_name = htmlspecialchars(strip_tags($this->last_name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = password_hash($this->password, PASSWORD_BCRYPT); // Hash the password
        $this->role = htmlspecialchars(strip_tags($this->role));

        $stmt->bindParam(":first_name", $this->first_name);
        $stmt->bindParam(":last_name", $this->last_name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":role", $this->role);

        if ($stmt->execute()) {
            return true; // User registered successfully
        }
        return false;
    }
       // Read method: Fetch all users
       public function readAll() {
        $sql = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Read method: Fetch single user by ID
    public function readOne($id) {
        $sql = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update method
    public function update() {
        $sql = "UPDATE " . $this->table . " 
                SET first_name = :first_name, 
                    last_name = :last_name, 
                    email = :email, 
                    role = :role
                WHERE id = :id";
        $stmt = $this->conn->prepare($sql);

        $this->first_name = htmlspecialchars(strip_tags($this->first_name));
        $this->last_name = htmlspecialchars(strip_tags($this->last_name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->role = htmlspecialchars(strip_tags($this->role));

        $stmt->bindParam(":first_name", $this->first_name);
        $stmt->bindParam(":last_name", $this->last_name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":role", $this->role);
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true; // User updated successfully
        }
        return false;
    }

    // Delete method
    public function delete($id) {
        $sql = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id);

        if ($stmt->execute()) {
            return true; // User deleted successfully
        }
        return false;
    }
}


?>
 
