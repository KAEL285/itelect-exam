<?php
include './connection/config.php';
$con = connection();

if (isset($_POST['btnUpdate'])) {
    $username = mysqli_real_escape_string($con, $_POST['email']);
    $pass = mysqli_real_escape_string($con, $_POST['pass']);

    
    $updateQuery = mysqli_query($con, "UPDATE `users` SET `password` = '$pass' WHERE `username` = '$username'");

    if ($updateQuery) {
        // Redirect to manageuser.php after successful update
        echo '<script> alert("Data Updated Successfully"); window.location="manageuser.php"; </script>';
    } else {
        echo '<script> alert("Error updating data: ' . htmlspecialchars(mysqli_error($con)) . '"); </script>';
    }
}

if (isset($_POST['btnDelete'])) {
    $username = mysqli_real_escape_string($con, $_POST['email']);
    
   
    $deleteQuery = mysqli_query($con, "DELETE FROM `users` WHERE `username` = '$username'");

    if ($deleteQuery) {
        echo '<script> alert("Data Deleted Successfully"); window.location="manageuser.php"; </script>';
    } else {
        echo '<script> alert("Error deleting data: ' . htmlspecialchars(mysqli_error($con)) . '"); </script>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Update User</title>
<link rel="icon" type="image/png" href="icon1.jpg">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
<link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container" id="signIn">
        <?php
            $userID = $_GET['ID'];
            $selectUserID = mysqli_query($con, "SELECT * FROM `users` WHERE `userID` = '$userID'");

            while($row = mysqli_fetch_assoc($selectUserID)){
        ?>
        <h1 class="form-title">UPDATE</h1>
        <form method="post" action="">
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="username" name="email" id="exampleInputEmail" placeholder="username" value="<?=$row['username'];?>" required readonly>
                <label for="exampleInputEmail">Username</label>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="text" name="pass" id="exampleInputPassword" placeholder="password" value="<?=$row['password'];?>" required>
                <label for="exampleInputPassword">Password</label>
            </div>
            <button type="submit" name="btnUpdate" class="btn btn-primary">Update</button>
            <button type="submit" name="btnDelete" class="btn btn-danger" onclick="return confirm('Delete this user? ');">Delete</button>
        </form>
    </div>
    <?php } ?>
</body>
</html>
