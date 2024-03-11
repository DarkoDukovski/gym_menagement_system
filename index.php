<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT admin_id, password FROM admins WHERE username = ?";

    $run = $conn->prepare($sql);
    $run->bind_param("s", $username);
    $run->execute();

    $results = $run->get_result();

    if ($results->num_rows == 1) { 
        $admin = $results->fetch_assoc();

        if (password_verify($password, $admin['password'])) {
            // Start the session before setting session variables
            session_start();

            $_SESSION['admin_id'] = $admin['admin_id'];

            // Close the connection after setting the session variables
            $conn->close();

            header('location: admin_dashboard.php');
            exit();
        } else {
            $_SESSION['error'] = "Incorrect password!";
            header('location: index.php');
            exit();
        }
    } else {
        $_SESSION['error'] = "Incorrect username!";
        header('location: index.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <style>
      body {
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
      }
      .container {
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        padding: 30px;
        width: 300px;
      }
      h2 {
        text-align: center;
        margin-bottom: 20px;
      }
      form {
        display: flex;
        flex-direction: column;
      }
      input[type="text"],
      input[type="password"],
      input[type="submit"] {
        padding: 10px;
        margin-bottom: 15px;
        border-radius: 5px;
        border: 1px solid #ccc;
      }
      input[type="submit"] {
        background-color: #333;
        color: #fff;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s ease;
      }
      input[type="submit"]:hover {
        background-color: #555;
      }
      .error {
        color: red;
        text-align: center;
        margin-bottom: 10px;
      }
    </style>
</head>
<body>

<div class="container">
    <h2>Admin Login</h2>
    
    <?php
    if(isset($_SESSION['error'])) {
        echo '<div class="error">' . $_SESSION['error'] . '</div>';
        unset($_SESSION['error']);
    }
    ?>
    
    <form action="" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username">
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password">
        
        <input type="submit" value="Login">
    </form>
</div>

</body>
</html>
