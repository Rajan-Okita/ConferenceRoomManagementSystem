<?php
require("connection.php");
session_start();
if(isset($_POST['password']) && isset($_POST['email'])) {
    $password = $_POST['password'];
    $email = mysqli_real_escape_string($con, $_POST['email']);

    if (!empty($email) && !empty($password)) {
        $query = "select * from users_tbl where email_address='$email' and password='$password'";
        $result = mysqli_query($con, $query);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['sessionuser'] = $row['first_name'];
            $_SESSION['sessionname'] = $row['last_name'];
            if ($row['role'] == '1') {
                $_SESSION['sessionid']= $row['role'];
                header("location:../../homepage.php");
            } else {
                header("location:../../adminpage.php");
            }
            exit();
        } else {
            exit();
        }
    } else {
        echo "Invalid credentials";
    }
}
?>