<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - To Do List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            display: flex;
            height: 100vh;
            justify-content: center;
            align-items: center;
        }
        .container {
            background: #fff;
            padding: 20px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            text-align: center;
        }
        h2 {
            color: #28a745;
        }
        .btn {
            display: block;
            background: #007bff;
            color: white;
            text-decoration: none;
            padding: 10px;
            margin: 5px;
            border-radius: 5px;
        }
        .btn:hover {
            background: #0056b3;
        }
        .logout-btn {
            background: #dc3545;
            margin-top: 15px;
            width: 70px;
            margin-left: 150px;
        }
        .logout-btn:hover {
            background: #c82333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></h2>
        <p>Manage your tasks easily.</p>
        <a href="add_task.php" class="btn">Add Task➕ </a>
        <a href="upcoming_tasks.php" class="btn">View Upcoming Tasks📅</a>
        <a href="completed_tasks.php" class="btn">Tasks Done✅</a>
        <a href="task_list.php" class="btn">View All Tasks📋</a>

        <a href="logout.php" class="btn logout-btn">Logout</a>
    </div>
</body>
</html>
