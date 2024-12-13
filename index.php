<?php
// Start session 
session_start();

// check for login if submitted na ba
if (isset($_POST['btnLogin'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // default credential
    $validUsername = "michael";
    $validPassword = "12345";

    // Check sa credential if tama
    if ($username === $validUsername && $password === $validPassword) {
        // Set session variables
        $_SESSION['username'] = $username;

        // direct/connect to manageuser.php after successful login
        header("Location: manageuser.php");
        exit();
    } else {
        $error_message = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>
<link rel="icon" type="image/png" href="icon1.jpg">
<link rel="stylesheet" href="login-style.css">
</head>
<body>
    <div class="container" id="loginForm">
        <h1>Login</h1>
        <form method="post" action="">
            <div class="input-group">
                
                <label for="username">Username</label>
                <input type="text" name="username" id="username"  required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password"  required>
            </div>
            <button type="submit" name="btnLogin" class="btn btn-primary">Login</button>

            <?php if (isset($error_message)) { echo "<p class='error'>$error_message</p>"; } ?>
        </form>
    </div>
</body>
</html>