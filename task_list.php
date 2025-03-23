<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include "db_connect.php";

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM tasks WHERE USER_ID = ? ORDER BY DUE_DATE ASC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task List</title>
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
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        .completed {
            text-decoration: line-through;
            color: gray;
        }
        .action-btn {
            padding: 5px 10px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            margin: 2px;
        }
        .complete-btn {
            background: #28a745;
            color: white;
        }
        .complete-btn:hover{
            background:rgb(2, 131, 32);
        }
        .delete-btn {
            background: #dc3545;
            color: white;
        }
        .delete-btn:hover{
            background:rgb(189, 8, 27) ;
        }
        .back-btn {
            display: inline-block;
            margin-top: 10px;
            text-decoration: none;
            color: #007bff;
        }
        form {
            display: inline;
        }
        table {
    width: 100%;
    border-collapse: collapse;  
    table-layout: fixed;                
}

th, td {
    padding: 10px;
    border-bottom: 1px solid #ddd;
    text-align: left;
    vertical-align: top;    
    word-wrap: break-word; 
    white-space: normal; 
}

th {
    background-color: #f8f9fa;
}
.delete-btn{
    margin-left: 20px;
}

    </style>
</head>
<body>
 <div class="container">
    <h2>Your Task List</h2>
    <table>
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Due Date</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        <?php while($task = $result->fetch_assoc()): ?>
            <tr>
                <td class="<?= $task['Status']== 'completed' ? 'completed': '' ?>">
                <?= htmlspecialchars($task['TITLE'])?>
        </td>
            <td><?= htmlspecialchars($task['Description'])?></td>
            <td><?= htmlspecialchars($task['due_date'])?></td>
            <td><?= $task['Status']?></td>
            <td>

                <?php if($task['Status'] !="completed"): ?>
                    <form action="mark_completed.php" method="POST"></form>
                    <input type="hidden" name="task_id" value="<?=$task['ID'] ?>">
                    <input type="hidden" name="Status" value="completed">
                    <button type="submit" class="action-btn complete-btn">✔️Mark Done</button>
                    </form>
                    <?php endif;?>

                    <form action="delete_task.php" method="POST">
                        <input type="hidden" name="task_id" value="<?= $task["ID"]?>">
                        <button type="submit" class="action-btn delete-btn">Delete</button>
                    </form>
            </td>
            </tr>
            <?php endwhile; ?>
    </table>
    <a href="dashboard.php" class="back-btn"> Back to dashboard</a>
 </div>   
</body>
</html>