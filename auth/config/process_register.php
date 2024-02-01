<?php
require('connection.php');

$f_name=$_POST['first_name'];
$l_name=$_POST['last_name'];
$email=$_POST['email'];
$password=password_hash($_POST['password'],PASSWORD_DEFAULT);
$role=$_POST['role'];

$qry=("insert into users_tbl(first_name,last_name,email_address,password,role)
values('$f_name','$l_name','$email','$password','$role')");

$qryCon= mysqli_query($con,$qry);

if ($qryCon) {
    header("location:../../index.php");
   }else{
    echo 'error' .mysqli_error($con);
}
