<?php
require_once 'conn.php';

class User {
    protected $conn;
    protected $table = "users";

    public $first_name;
    public $last_name;
    public $email;
    public $password;
    public $role;

    public function __construct() {
        $database = new dbConnect();
        $this->conn = $database->connectDB();
    }

    public function register() {
        $sql = "INSERT INTO " . $this->table . " (first_name, last_name, email, password, role) 
                VALUES (:first_name, :last_name, :email, :password, :role)";

        $stmt = $this->conn->prepare($sql);

        // Sanitize inputs
        $this->first_name = htmlspecialchars(strip_tags($this->first_name));
        $this->last_name = htmlspecialchars(strip_tags($this->last_name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = password_hash($this->password, PASSWORD_BCRYPT); // Hash password
        $this->role = htmlspecialchars(strip_tags($this->role));

        // Bind parameters
        $stmt->bindParam(":first_name", $this->first_name);
        $stmt->bindParam(":last_name", $this->last_name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":role", $this->role);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
