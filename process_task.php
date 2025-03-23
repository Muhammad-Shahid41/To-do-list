<?php
session_start();
if(!isset($_SESSION["user_id"])){
    header("Location: login.php");
    exit();
}

include "db_connect.php";

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $user_id= $_SESSION["user_id"];
    $title= htmlspecialchars(trim($_POST["title"]));
    $description= htmlspecialchars(trim($_POST["description"]));
    $due_date= $_POST['due_date'];
    $status= "pending";

    if(empty($title) || empty($description) || empty($due_date)){
        echo "<script>alert('All fields are requred'); window.location='add_task.php';</script>";
        exit();
    }

    $sql= "INSERT INTO tasks(USER_ID,TITLE,Description,due_date,Status ) VALUES (?,?,?,?,?)";
    $stmt= $conn->prepare($sql);
    $stmt-> bind_param("issss",$user_id,$title,$description,$due_date,$status);
    if($stmt->execute()){
        echo "<script>alert('Task added successfully');window.location='dashboard.php';</script>";
    }
    else{
        echo "<script>alert('Error adding task');window.location='add_task.php';</script>";
    }
}
$stmt->close();
$conn->close();
?>  