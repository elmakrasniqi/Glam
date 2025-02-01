<?php
session_start();
require_once '../Backend/conn.php';

$database = new dbConnect();
$conn = $database->connectDB();

$userCRUD = new UserCRUD($conn);


if($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['update_user'])) {
        
        $id = $_POST['user_id'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $role = $_POST['role'];

        $userCRUD->updateUser($id, $first_name, $last_name, $email, $role, );

        header("Location: manage_users.php");
        exit();
    } elseif (isset($_POST['add_user'])) {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $role = $_POST['role'];

        $userCRUD->addUser($first_name, $last_name, $email, $role);
        header("Location: manage_users.php");
        exit();
    }
}
        // Fetch all users
        $users = $userCRUD->getAllUsers();
        $userCount = $userCRUD->getUserCount();

        // Fetch user for editing
        $edit_user = null;
        if (isset($_GET['edit_id'])) {
            $edit_id = $_GET['edit_id'];
            $edit_user = $userCRUD->getUserById($edit_id);
        }

class UserCRUD {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAdminNameById($admin_id) {
        $sql = "SELECT first_name, last_name FROM users WHERE id = :admin_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':admin_id', $admin_id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt = $stmt->fetch();
        if($result) {
            return $result['first_name'] . ' ' . $result['last_name'];
        }
        return null;
    }

    public function updateUser($id, $first_name, $last_name, $email, $role) {
        $sql = "UPDATE users SET
                first_name = :first_name,
                last_name = :last_name,
                email = :email,
                role = :role
                WHERE id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':role', $role);

        return $stmt->execute();
    }

    public function getUserById($id) {
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function deleteUserById($id) {
        $sql = "DELETE FROM users WHERE id = :id"; 
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);  
        return $stmt->execute();
    }

    public function getUserCount() {
        $sql = "SELECT COUNT(*) FROM users";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchColumn();
    }

    public function getAllUsers() {
        $sql = "SELECT * FROM users";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll();
    }

    public function addUser($first_name, $last_name, $email, $role) {
        $sql = "INSERT INTO users (first_name, last_name, email, role) VALUES (:first_name, :last_name, :email, :role)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':role', $role);
        return $stmt->execute();
    }

}


// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_user'])) {
        // Add a new user
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $role = $_POST['role'];

        $userCRUD->addUser($first_name, $last_name, $email, $role);
        header("Location: manage_users.php");
        exit();
    } elseif (isset($_POST['update_user'])) {
        // Update an existing user
        $id = $_POST['user_id'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $role = $_POST['role'];

        $userCRUD->updateUser($id, $first_name, $last_name, $email, $role);
        header("Location: manage_users.php");
        exit();
    }
}

// Handle delete request
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    $userCRUD->deleteUserById($id);
    header("Location: manage_users.php");
    exit();
}

// Fetch all users
$users = $userCRUD->getAllUsers();
$userCount = $userCRUD->getUserCount();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* General Styles */
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

        .content {
            padding: 30px;
            max-width: 1200px;
            margin: 0 auto;
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
        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
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

        .btn {
            padding: 10px 20px;
            font-size: 14px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-primary {
            background-color: rgb(128, 97, 114);
            color: white;
        }

        .btn-primary:hover {
            background-color: rgb(100, 75, 90);
        }

        /* Table Styles */
        .table-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
            border-radius: 6px;
        }

        table th,
        table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: rgb(166, 136, 152);
            color: #fff;
            font-weight: 500;
        }

        table tr:hover {
            background-color: #f9f9f9;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .btn-edit {
            background-color: rgb(128, 97, 114);
            color: white;
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 12px;
        }

        .btn-edit:hover {
            background-color: rgb(100, 75, 90);
        }

        .btn-delete {
            background-color: rgb(193, 107, 104);
            color: white;
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 12px;
        }

        .btn-delete:hover {
            background-color: rgb(186, 91, 88);
        }

        /* Responsive Styles */
        @media screen and (max-width: 768px) {
            .content {
                padding: 15px;
            }

            .form-container,
            .table-container {
                padding: 15px;
            }

            table th,
            table td {
                padding: 10px;
            }

            .action-buttons {
                flex-direction: column;
                gap: 5px;
            }

            .btn-edit,
            .btn-delete {
                width: 100%;
                text-align: center;
                padding: 5px;
            }
        }
    </style>
    <body>
    <a href="dashboard.php" class="back-button">
        <i class="fas fa-arrow-left"></i>
    </a>

    <div class="content">
        <h2>Manage Users (Total Users: <?php echo $userCount; ?>)</h2>
        
        <!-- Add/Edit User Form -->
        <div class="form-container">
            <h3><?php echo $edit_user ? 'Edit User' : 'Add User'; ?></h3>
            <form method="POST" action="manage_users.php">
                <?php if ($edit_user): ?>
                    <input type="hidden" name="user_id" value="<?php echo $edit_user['id']; ?>">
                <?php endif; ?>

                <div class="form-group">
                    <label for="first_name">First Name:</label>
                    <input type="text" id="first_name" name="first_name" value="<?php echo $edit_user ? $edit_user['first_name'] : ''; ?>" required>
                </div>

                <div class="form-group">
                    <label for="last_name">Last Name:</label>
                    <input type="text" id="last_name" name="last_name" value="<?php echo $edit_user ? $edit_user['last_name'] : ''; ?>" required>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo $edit_user ? $edit_user['email'] : ''; ?>" required>
                </div>

                <div class="form-group">
                    <label for="role">Role:</label>
                    <input type="text" id="role" name="role" value="<?php echo $edit_user ? $edit_user['role'] : ''; ?>" required>
                </div>

                <div class="form-group">
                    <?php if ($edit_user): ?>
                        <button type="submit" name="update_user" class="btn btn-primary">Update User</button>
                    <?php else: ?>
                        <button type="submit" name="add_user" class="btn btn-primary">Add User</button>
                    <?php endif; ?>
                </div>
            </form>
        </div>

        <!-- User List -->
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($user['first_name']) . ' ' . htmlspecialchars($user['last_name']); ?></td>
                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                            <td><?php echo htmlspecialchars($user['role']); ?></td>
                            <td class="action-buttons">
                                <a href="?edit_id=<?php echo $user['id']; ?>" class="btn btn-edit">Edit</a>
                                <a href="?delete_id=<?php echo $user['id']; ?>" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <h2>Product Modification </h2>

    <div class="table-container">
    <table>
    <thead>
        <tr>
            <th>Product Name</th>
            <th>Action</th>
            <th>Modification Date</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT p.name AS product_name, aa.action, aa.action_time
        FROM admin_actions aa
        JOIN products p ON aa.product_id = p.id
        ORDER BY aa.action_time DESC";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $modifications = $stmt->fetchAll();

        // Loop to show modifications
        foreach ($modifications as $modification) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($modification['product_name']) . "</td>"; 
            echo "<td>" . htmlspecialchars($modification['action']) . "</td>";
            echo "<td>" . htmlspecialchars($modification['action_time']) . "</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>
    </div>
    </div>

    
</body>
</html>
