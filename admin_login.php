<?php
require_once("connection.inc.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input
    $User = $_POST["User"];
    $Password = $_POST["Password"];

    // Retrieve hashed password from the database
    try {
        $stmt = $pdo->prepare("SELECT Password FROM tb_admin WHERE User = ?");
        $stmt->bindParam(1, $User);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $hashedPassword = $row['Password'];
            // Debugging: Check the retrieved hashed password
            error_log("Retrieved hashed password: " . $hashedPassword);

            if ($hashedPassword && password_verify($Password, $hashedPassword)) {
                // Password is correct, login successful
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['logged_in'] = true;
                $_SESSION['User'] = $User;
                header("Location: admin.php");
                exit(); // Make sure to exit after redirection
            } else {
                echo "Invalid User or password.";
            }
        } else {
            echo "Invalid User or password.";
        }
    } catch (PDOException $e) {
        // Debugging: Log any database errors
        error_log("Database error: " . $e->getMessage());
        echo "An error occurred. Please try again later.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin.css"> 
    <title>Admin Login</title>
</head>
<body>
    
    <div class="header"></div>
    <div class="logo"><img src="logo_.png" alt="logo" width="120px" height="90px"></div>

    <form class="loginform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

        <input type="text" id="User" name="User" placeholder="user" required><br><br>
        <input type="password" id="Password" name="Password" placeholder="password" required><br><br>

        <div class="login_btn">
            <input type="submit" value="Login">
        </div>

    </form>

</body>
</html>
