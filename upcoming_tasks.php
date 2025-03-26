<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

include "db_connect.php";

$user_id= $_SESSION['user_id'];
$sql= "SELECT * FROM tasks WHERE USER_ID= ? AND STATUS='Pending' ORDER BY due_date ASC";
$stmt= $conn->prepare($sql);
$stmt->bind_param("i",$user_id);
$stmt->execute();
$result= $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upcoming Tasks</title>
    <style>
         body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            background: #fff;
            padding: 20px;
            width: 100%;
            min-height: 700px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            text-align: center;
        }

        h2 {
            color: #28a745;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            table-layout: fixed;
        }

        th,
        td {
            padding: 10px;
           border-bottom: 1px solid #ddd;
          text-align: left;
          vertical-align: top;    
          word-wrap: break-word; 
          white-space: normal; 
          overflow-wrap: break-word;
        }

        th {
            background-color: #f2f2f2;
        }
        a{
            text-decoration: none;
            color: blue;
        }
        .margin{
            margin-top: 30px;
        }
    </style>
</head>
<body>
  <div class="container">
    <h2>Upcoming Tasks</h2>
    <table>
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Due Date</th>
        </tr>
        <?php while ($task= $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($task['TITLE']) ?></td>
                <td><?= htmlspecialchars($task['Description']) ?></td>
                <td><?= htmlspecialchars($task['due_date'])?></td>
            </tr>
            <?php endwhile; ?>
    </table>
    <div class="margin">
    <a href="dashboard.php">⬅️Back to dashboard</a>
        </div>
  </div>  
</body>
</html>