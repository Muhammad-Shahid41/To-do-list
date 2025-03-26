<?php
session_start();
include "db_connect.php";

if($_SERVER['REQUEST_METHOD'] == "POST" &&isset ($_POST['task_id'])){
    $task_id= $_POST['task_id'];
    $user_id= $_SESSION['user_id'];

    $sql= "DELETE FROM tasks WHERE ID = ? AND USER_ID = ?";
    $stmt= $conn->prepare($sql);
    $stmt->bind_param("ii", $task_id, $user_id);

    if($stmt->execute()){
        header("Location: task_list.php? success= Task deleted successfully");
    }
    else{   
        header("Location: task_list.php? error = Failed to delete task");
    }
    exit();
}
else{
    header("Location: task_list.php ? error= ivalid request");
    exit();
}
?>