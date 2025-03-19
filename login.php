<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
            max-width: 360px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        
        h2 {
             text-align: center; 
             color: #28a745;
             
            }
            h3 {
             text-align: center; 
            }
            p{
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
        button:hover { 
            background-color: #218838; 
        }
        .link {
             text-align: center; margin-top: 10px; 
            }
    </style>
</head>
<body>
    <div class="container">
    <h2>Welcome to To Do List</h2>
    <h3>Login</h3>
    <p>Login here to access your tasks.</p>
        <form action="login.php" method="post">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <div class="link">
            Don't have an account? <a href="signup.php">Sign up here</a>
        </div>
    </div>
</body>
</html>