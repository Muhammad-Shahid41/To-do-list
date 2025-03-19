<?php
$host = "localhost";
$username = "root";
$password = null;
$dbname = "todo_list";

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Database connection failed" . $conn->connect_error);
}

function disconnect(){
}
    
function connect() {
    // definition for connecting to DB
}