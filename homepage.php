<?php
session_start()?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Homepage</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">

    <a class="navbar-brand" href="#">
        <img src="logo.jpeg" alt="logo" style="width:60px;">
    </a>

    <ul class="navbar-nav me-auto">
        <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Book room</a>
        </li>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Help</a>
        </li>
    </ul>
    <form class="d-flex" >
        <?php
        echo $_SESSION['sessionuser'];
        echo "\t";
        echo $_SESSION['sessionname'];
        ?>
    </form>
</nav>

<div class="d-grid">
   <div class="centered">
        <table>
            <h1 style="text-align: center">Welcome to room booking platform</h1>
            <div class="d-grid gap-2">
                <a href="booking.php" button type="button" class="btn btn-primary btn-block">Book a room</button></a>
                <a href="#" button type="button" class="btn btn-primary btn-block">View booked rooms</button></a>
            </div>
        </table>
    </div>
</body>
</html>
