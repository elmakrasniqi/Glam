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

    
    public function login($email, $password) {
        $sql = "SELECT * FROM " . $this->table . " WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        
        return false;
    }

    public function register() {
        $sql = "SELECT * FROM " . $this->table . " WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":email", $this->email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return false;  // email exists
        }

        $sql = "INSERT INTO " . $this->table . " (first_name, last_name, email, password, role) 
                VALUES (:first_name, :last_name, :email, :password, :role)";
        $stmt = $this->conn->prepare($sql);

        
        $this->password = password_hash($this->password, PASSWORD_BCRYPT); //hash password

        $stmt->bindParam(":first_name", $this->first_name);
        $stmt->bindParam(":last_name", $this->last_name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":role", $this->role);

        return $stmt->execute();
    }

    public function update() {
        $sql = "UPDATE " . $this->table . " 
                SET first_name = :first_name, 
                    last_name = :last_name, 
                    email = :email, 
                    role = :role" . 

                    ($this->password ? ", password = :password" : "") . 
                " WHERE id = :id";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(":first_name", $this->first_name);
        $stmt->bindParam(":last_name", $this->last_name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":role", $this->role);
        $stmt->bindParam(":id", $this->id);

        if ($this->password) {
            $this->password = password_hash($this->password, PASSWORD_BCRYPT);
            $stmt->bindParam(":password", $this->password);
        }

        return $stmt->execute();
    }

    public function readAll() {
        $sql = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function readOne($id) {
        $sql = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function delete($id) {
        $sql = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }

    public function getUserByEmail($email) {
        $sql = "SELECT * FROM " . $this->table . " WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
