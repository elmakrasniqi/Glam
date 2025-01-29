<?php
require_once '../Backend/conn.php';

class MessageCRUD {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getMessageCount($conn) {
        $sql = "SELECT COUNT(*) FROM contacts";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchColumn();
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
    public function getPRoductCount() {
        $sql = "SELECT COUNT(*) FROM products";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchColumn();
    }
}
class UserCRUD {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getUserCount() {
        $sql = "SELECT COUNT(*) FROM users";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchColumn();
    }
}
$database = new dbConnect();
$conn = $database->connectDB();

$productCrud = new ProductCRUD($conn);
$products = $productCrud->getAllProducts();

$productCount = count($products);

$messageCrud = new MessageCRUD($conn);
$messageCount = $messageCrud->getMessageCount($conn);

$userCrud = new UserCRUD($conn);  
$userCount = $userCrud->getUserCount(); 

class WeeklyStats {

private $conn;

public function __construct($conn) {
    $this->conn = $conn;
}

public function getWeeklyProductCount() {
    $sql = "SELECT COUNT(*)FROM products WHERE created_at > DATE_SUB(NOW(), INTERVAL 1 WEEK)";
    $stmt = $this->conn->query($sql);
    return  $stmt->fetchColumn();
}

public function getWeeklyMessageCount() {
    $sql = "SELECT COUNT(*)FROM contacts WHERE created_at > DATE_SUB(NOW(), INTERVAL 1 WEEK)";
    $stmt = $this->conn->query($sql);
    return  $stmt->fetchColumn();
    }

public function getWeeklyUserCount(){
    $sql = "SELECT COUNT(*) FROM users WHERE created_at > DATE_SUB(NOW(), INTERVAL 1 WEEK)";
    $stmt = $this->conn->query($sql);
    return $stmt->fetchColumn();
    }
}
$weelkyStats = new WeeklyStats($conn);
$weeklyProducts = $weelkyStats->getWeeklyProductCount();
$weeklyMessages = $weelkyStats->getWeeklyMessageCount();
$weeklyUsers = $weelkyStats->getWeeklyUserCount();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../dashboard.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            min-height: 100vh;
            background-color: #f6f0f0; 
        }

        h1 {
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
            transition: 0.3s;
        }

        .content h2 {
            color: #495057;
            font-size: 28px;
            margin-bottom: 20px;
        }

        .content p {
            color: #6c757d;
        }

      
        .stats-container {
            display: flex;
            justify-content: center;
            margin-top: 40px;
            gap: 20px;
        }

        .stat-card {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 30%;
            text-align: center;
            margin-bottom: 20px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .stat-icon {
            font-size: 40px;
            color: #8f5e70;
            margin-bottom: 15px;
        }

        .stat-card h3 {
            font-size: 22px;
            color: #333;
            margin-bottom: 10px;
        }

        .stat-card p {
            font-size: 16px;
            color: #555;
            margin-top: 5px;
        }
        .weekly-activity {
            width: 100%;
            margin-top: 20px;
            border-radius: 10px;
            padding: 10px;
            height: auto;
            min-height: 200px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        canvas {
            width: 100% !imortant;
            max-width: 600px;
            border-radius: 10px;
            justify-content: center;
            align-items: center;
        }
       
     @media screen and (max-width: 768px) {
        .sidebar {
        width: 120px;
    }

    .content {
        margin-left: 120px;
        overflow: hidden;
    }
    .content h2{
        font-size:20px;

    }
    

    .stats-container {
        flex-direction: column;
        align-items: center;
    }

    .stat-card {
        width: 70%;
        margin-bottom: 20px;
        height: 115px; 
    }

    .weekly-activity {
        width: 100%;
        margin-top: 60px; 
        border-radius: 10px;
        padding: 20px;
        height: auto;
        min-height: 300px;
    }

    canvas {
        max-width: 100%;
        max-width:300px;
        height: 300px;
    }
    
}

@media screen and (max-width: 480px) {
    .sidebar {
        width: 100%;
        position: relative;
        height: auto;
    }

    .content {
        margin-left: 0;
        width: 80%;
        padding: 15px;
    }

    .stats-container {
        flex-direction: column;
        align-items: center;
        gap: 10px;
    }

    .stat-card {
        width: 90%;
        height: 70px; 
    }

    .weekly-activity {
        margin-top: 20px;
        min-height: 250px;
        padding: 8px;
        height:auto;
    }

    canvas {
        max-width: 100%;
        max-width:300px;
        height: 300px;
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
            <li onclick="showSection('manage_users')">
                <a href="addproducts.php">Make-Up</a>
            </li>
            <li onclick="showSection('manage_users')">
                <a href="manage_users.php">Manage Users</a>
            </li>
            <li>
                <a href="LogOut.php">Logout</a>
            </li>
        </ul>
    </div>

    <div class="content">
        <div id="dashboard">
            <h2>Welcome to the Admin Dashboard</h2>

            
            <div class="stats-container">
                <div class="stat-card">
                    <i class="fas fa-box-open stat-icon"></i>
                    <h3>Total Products</h3>
                    <p><?php echo count($products); ?> Products</p> 
                </div>
                <div class="stat-card">
                    <i class="fas fa-comment-dots stat-icon"></i>
                    <h3>Total Messages</h3>
                    <p><?php echo $messageCount; ?> Messages</p> 
                </div>
                <div class="stat-card">
                    <i class="fas fa-users stat-icon"></i>
                    <h3>Total Users</h3>
                    <p><?php echo $userCount; ?> Users</p> 
                 </div>
    </div>
<div class="weekly-activity">
    <h2>Weekly Activity</h2>
    <canvas id="activityChart" width="600" height="100"></canvas>
    <script>
        var ctx = document.getElementById('activityChart').getContext('2d');
        var activityChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Products Added', 'Messages Received', 'Users Registered'],
                datasets: [{
                    label:'Weekly Activity',
                    data:[<?php echo $weeklyProducts;?>, <?php echo $weeklyMessages?>, <?php echo $weeklyUsers;?>],
                    backgroundColor:['rgba(75, 192, 192, 0.2)', 'rgba(153, 102, 255, 0.2)',  'rgba(255, 159, 64, 0.2)'],
                    borderColor: ['rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)',  'rgba(255, 159, 64, 1)'],
                    borderWidth: 1
                        }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
                </script>
            </div>
        </div>
    </div>
</body>
</html>
