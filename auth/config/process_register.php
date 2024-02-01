<?php
require('connection.php');

    $f_name = $_POST['first_name'];
    $l_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

$email_check_query="select * from users_tbl where email_address='$email'" ;
$result=mysqli_query($con,$email_check_query);
if(mysqli_num_rows($result)>0){
    echo "email already exists";
}else {

    $qry = ("insert into users_tbl(first_name,last_name,email_address,password,role)
values('$f_name','$l_name','$email','$password','$role')");

    $qryCon = mysqli_query($con, $qry);

    if ($qryCon) {
        header("location:../../index.php");
    } else {
        echo 'error' . mysqli_error($con);
    }
}
