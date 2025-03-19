<?php
include "db_connect.php";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username=htmlspecialchars($_POST["username"]);
    $email=htmlspecialchars($_POST["email"]);
    $password=password_hash($_POST["password"],PASSWORD_BCRYPT);

    $checkuser= $conn->prepare("SELECT * FROM users WHERE email=?");
    $checkuser->bind_param("s",$email);
    $checkuser->execute();
    $result= $checkuser->get_result();
   
    if($result->num_rows>0){
        echo "Email already exists.Try logging in";
    }
    else{
        $stmt= $conn->prepare("INSERT INTO users(username,email,password) VALUES(?,?,?)");
        $stmt->bind_param("sss",$username,$email,$password);
        if($stmt->execute()){
            echo"Signup successfull <a href='login.php'>Login here</a>";
        }
        else{
            echo "signup failed";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            display: flex;
            height: 100vh;
            justify-content: center;
            align-items: center;
            background-color: #f0f2f5;
        }
        .container {
            background: #fff;
            padding: 20px;
            width: 100%;
            height: 55%;
            max-width: 360px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        h2{
            font-weight: 700;
            text-align: center;
            margin-top: -4px;
            color: #28a745;
        }
        h3 {
             text-align: center; 
            }
        input, button {
            width: 90%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        button {
            background-color: #28a745;
            color: #fff;
            border: none;
            cursor: pointer;
            margin-left: 10px;
        }
        button:hover { background-color: #218838; }
        .link {
             text-align: center;
              margin-top: 10px;
             }
    </style
</head>
<body>
    <div class="container">
    <h2>Welcome to To Do List</h2>
            <h3>Sign up</h3>
        <form method="post" action="signup.php">
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Sign up</button>
            <div class="link">
                Already have an account? <a href="login.php">Login here</a>
            </div>
        </form>
    </div>
</body>
</html>