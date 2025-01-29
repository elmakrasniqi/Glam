<?php
require_once '../Backend/conn.php';

class UserCRUD {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
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
}

$database = new dbConnect();
$conn = $database->connectDB();

$userCRUD = new UserCRUD($conn);

$users = [];
$userCount = $userCRUD->getUserCount();

if (isset($_GET['action'])) {
    if ($_GET['action'] == 'delete' && isset($_GET['id'])) {
        $userCRUD->deleteUserById($_GET['id']);
        header("Location: manage_users.php");
        exit();
    } elseif ($_GET['action'] == 'view' && isset($_GET['id'])) {
        $userId = $_GET['id'];
        $user = $userCRUD->getUserById($userId);
    }
} else {
    $users = $userCRUD->getAllUsers();
    $userCount = $userCRUD->getUserCount();
}
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
        body { 
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            min-height: 100vh;
            background-color: #f4f4f4;
            color: #333;
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
            width: 100%;
            background-color: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        h2 {
            font-size: 1.8rem;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        .user-detail {
            margin-top: 20px;
            padding: 20px;
            background-color: #fafafa;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
            font-size: 16px;
            border-radius: 8px;
            overflow: hidden;
            table-layout: fixed;
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
            padding: 10px 12px;
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

        .user-detail a {
            color: rgb(128, 97, 114);
            text-decoration: none;
        }

        @media screen and (max-width: 768px) {
            .content h2 {
                font-size: 20px;
            }

            .user-detail {
                padding: 15px;
            }

            .back-button {
                top: 15px;
                left: 15px;
                font-size: 16px;
            }

            th, td {
                padding: 15px 10px;
                font-size: 12px;
            }

            .action-buttons {
                display: flex;
                flex-direction: column; 
                gap: 10px;
                justify-content: center;
                align-items: center; 
            }

            .action-buttons a {
                font-size: 12px;
                padding: 6px 10px;
                width: 80%; 
                text-align: center; 
            }

            .action-buttons a.delete {
                font-size: 12px;
                padding: 6px 10px;
                width: 80%; 
            }

            .user-detail a {
                font-size: 14px;
            }

            .user-detail {
                padding: 15px;
            }
        }

        @media screen and (max-width: 480px) {
            .user-detail {
                padding: 10px;
            }

            table {
                font-size: 12px;
            }

            .back-button {
                top: 15px;
                left: 15px;
                font-size: 16px;
            }

            .user-detail a {
                font-size: 14px;
            }

            .action-buttons a {
                font-size: 12px;
                padding: 5px 8px;
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
    
    <?php if (isset($user)): ?>
        <div class="user-detail">
            <h3>User Details</h3>
            <p><strong>Name:</strong> <?php echo htmlspecialchars($user['first_name']) . ' ' . htmlspecialchars($user['last_name']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
            <p><strong>Role:</strong> <?php echo htmlspecialchars($user['role']); ?></p>
            <p><strong>Last Login:</strong> <?php echo $user['last_login'] ? htmlspecialchars($user['last_login']) : 'Not available'; ?></p>
            <a href="manage_users.php">Back to Users</a>
        </div>
    <?php else: ?>
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
                            <a href="?action=view&id=<?php echo $user['id']; ?>">View</a>
                            <a href="?action=delete&id=<?php echo $user['id']; ?>" class="delete" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

</body>
</html>
