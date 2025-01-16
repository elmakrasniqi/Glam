<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
    background-color: #f6f0f0; 
}

h1 {
    color: #333;
}

.sidebar {
    width: 250px;
    background-color: rgb(128, 97, 114); /* Light pink sidebar */
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


table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table th, table td {
    padding: 12px 18px;
    text-align: left;
    border: 1px solid #ddd;
    border-radius: 8px;
}

table th {
    background-color: #f7d1d1; 
    color: #333;
}

table tr:nth-child(even) {
    background-color: #f9f9f9;
}

table tr:hover {
    background-color: #f1e2e2;
}

table td {
    background-color: #fff;
}

@media screen and (max-width: 768px) {
    .sidebar {
        width: 200px;
    }
    .content {
        margin-left: 200px;
    }
}

@media screen and (max-width: 480px) {
    .sidebar {
        width: 100%;
        height: auto;
        position: relative;
    }
    .content {
        margin-left: 0;
        width: 100%;
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
                <a href="makeup.php">Make-Up</a>
            </li>
            </li>
            <li onclick="showSection('manage_users')">
                <a href="manage_users.php">Manage Users</a>
            </li>
            <li >
                <a href="LogOut.php">Logout</a>
            </li>
        </ul>
    </div>

    <div class="content">
        <div id="dashboard">
            <h2>This is the main section where you can manage all your content. Use the sidebar to navigate through different options.</h2>
        </div>
    </div>
</body>
</html>