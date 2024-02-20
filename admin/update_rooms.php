<?php
session_start();
require("../auth/config/connection.php");

if (isset($_GET['rooms_id'])) {
    $rooms_id = $_GET['rooms_id'];
} else {

    header("Location: admin_page.php");
    exit();
}
var_dump($rooms_id);
?>

