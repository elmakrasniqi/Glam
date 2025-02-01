<?php
require_once '../Backend/User.php';

class ManageUser extends User {
    
    public function __construct() {
        parent::__construct();
    }

    // Count users
    public function getUserCount() {
        $sql = "SELECT COUNT(*) FROM " . $this->table;
        $stmt = $this->conn->query($sql);
        return $stmt->fetchColumn();
    }

    // Add a new user
    public function addUser($first_name, $last_name, $email, $role, $password) {
        // Check if the email already exists
        $check_sql = "SELECT COUNT(*) FROM " . $this->table . " WHERE email = :email";
        $check_stmt = $this->conn->prepare($check_sql);
        $check_stmt->bindParam(":email", $email);
        $check_stmt->execute();
        $emailExists = $check_stmt->fetchColumn();

        if ($emailExists > 0) {
            return "error: Email already exists.";
        }

        // Insert new user if email is unique
        $sql = "INSERT INTO " . $this->table . " (first_name, last_name, email, role, password) 
                VALUES (:first_name, :last_name, :email, :role, :password)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":first_name", $first_name);
        $stmt->bindParam(":last_name", $last_name);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":role", $role);
        $stmt->bindParam(":password", password_hash($password, PASSWORD_DEFAULT));
        
        return $stmt->execute() ? "success" : "error";
    }

    // Update user details
    public function updateUser($id, $first_name, $last_name, $email, $role, $password = null) {
        $sql = "UPDATE " . $this->table . " 
                SET first_name = :first_name, 
                    last_name = :last_name, 
                    email = :email, 
                    role = :role";
        
        if ($password) {
            $sql .= ", password = :password";
        }

        $sql .= " WHERE id = :id";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":first_name", $first_name);
        $stmt->bindParam(":last_name", $last_name);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":role", $role);

        if ($password) {
            $stmt->bindParam(":password", password_hash($password, PASSWORD_DEFAULT));
        }

        return $stmt->execute();
    }
}

// Create an instance of ManageUser
$userManager = new ManageUser();

// Initialize edit_user to avoid undefined variable warnings
$edit_user = [];

// Handling form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_user'])) {
        $result = $userManager->addUser($_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['role'], $_POST['password']);
        
        if ($result === "success") {
            header("Location: manage_users.php");
            exit();
        } else {
            echo "<script>alert('Error: Email already exists!');</script>";
        }
    } elseif (isset($_POST['update_user'])) {
        $password = empty($_POST['password']) ? null : $_POST['password'];
        $userManager->updateUser($_POST['user_id'], $_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['role'], $password);
        header("Location: manage_users.php");
        exit();
    }
}

// Handling delete request
if (isset($_GET['delete_id'])) {
    $userManager->delete($_GET['delete_id']);
    header("Location: manage_users.php");
    exit();
}

// Fetch user data if editing
if (isset($_GET['edit_id'])) {
    $edit_user = $userManager->readOne($_GET['edit_id']);
}

// Fetching all users
$users = $userManager->readAll();
$userCount = $userManager->getUserCount();
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
            }
        }
    </style>
</head>
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
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" <?php echo !$edit_user ? 'required' : ''; ?>>
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
    </div>
</body>
</html>
