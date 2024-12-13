<?php
session_start();

// for user check kung naka log in na
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

include './connection/config.php';
$con = connection();

if (isset($_POST['btnSave'])) {
    $username = $_POST['email'];
    $pass = $_POST['pass'];
    $date = date('d-m-y');

    // Check if username already exists
    $checkQuery = mysqli_query($con, "SELECT * FROM `users` WHERE `username` = '$username'");

    // If username is exists na
    if (mysqli_num_rows($checkQuery) > 0) {
        $_SESSION['error'] = 'Username already exists!';
    } else {
        // Insert data if username is hindi pa nagagamit
        $inserQuery = mysqli_query($con, "INSERT INTO `users`(`username`, `password`, `date`) VALUES ('$username', '$pass', '$date')");
        
        if ($inserQuery) {
            $_SESSION['success'] = 'Data inserted successfully!';
        } else {
            $_SESSION['error'] = 'Error: ' . mysqli_error($con);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Manage Users</title>
<link rel="icon" type="image/png" href="icon1.jpg">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
<link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Welcome!</h1>
        <div class="container" id="signIn">
        <h1 class="form-title">Submit</h1>
            <form method="post" action="">
                <div class="input-group">
                    <i class="fas fa-envelope"></i>
                    <input type="username" name="email" id="exampleInputEmail" placeholder="username" required>
                    <label for="exampleInputEmail">Username</label>
                </div>
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="pass" id="exampleInputPassword" placeholder="password" required>
                    <label for="exampleInputPassword">Password</label>
                </div>
                <button type="submit" name="btnSave" class="btn btn-primary">Save</button>
            </form>
        </div>

        <!-- Logout Button -->
        <div class="logout-container">
        <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>

        <div class="container1"></div>
         <div class="col-6 p-3">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Tbl.ID</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $selectQuery = mysqli_query($con, "SELECT * FROM users");
                while ($row = mysqli_fetch_assoc($selectQuery)) {
                    ?>
                    <tr>
                        <td><?= $row['userID'] ?></td>
                        <td><?= $row['username'] ?></td> 
                        <td><?= $row['password'] ?></td> 
                        <td><?= $row['date'] ?></td> 
                        <td><a href="viewUser.php?ID=<?php echo $row['userID'];?>"><i class="fa fa-eye"></i></a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
      
    <!-- Display error or success messages -->
       <?php
    if (isset($_SESSION['success'])) {
        echo '<script> alert("' . $_SESSION['success'] . '"); </script>';
        unset($_SESSION['success']);
    } elseif (isset($_SESSION['error'])) {
        echo '<script> alert("' . $_SESSION['error'] . '"); </script>';
        unset($_SESSION['error']);
    }
    ?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
</body>
</html>
