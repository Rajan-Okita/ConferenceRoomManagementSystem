<!DOCTYPE html>
<html lang="en">
<head>
    <title>Room page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://www.phptutorial.net/app/css/style.css">
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">

    <a class="navbar-brand" href="#">
        <img src="../logo.jpeg" alt="logo" style="width:60px;">
    </a>

    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="../homepage.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Help</a>
        </li>
    </ul>
</nav>


<div class="container mt-5">
    <?php
    session_start();
    require("config/connection.php");

    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }

    $user_id = $_SESSION['user_id'];

    $view_booking_query = "SELECT booking_tbl.*, rooms_tbl.room_name 
                          FROM booking_tbl 
                          INNER JOIN rooms_tbl ON booking_tbl.room_id = rooms_tbl.rooms_id
                          WHERE booking_tbl.users_id = '$user_id'";
    $view_booking_result = mysqli_query($con, $view_booking_query);

    if (mysqli_num_rows($view_booking_result) > 0) {
        echo "<h1>Bookings for " . $_SESSION['sessionuser'] . " " . $_SESSION['sessionname'] . "</h1>";
        echo "<div class='table-responsive'>";
        echo "<table class='table table-striped'>
                    <thead>
                        <tr>
                            <th>Day Booked</th>
                            <th>Time</th>
                            <th>Room</th>
                        </tr>
                    </thead>
                    <tbody>";
        while ($view_booking_row = mysqli_fetch_assoc($view_booking_result)) {
            echo "<tr>";
            echo "<td>" . $view_booking_row['day_booked'] . "</td>";
            echo "<td>" . $view_booking_row['book_time'] . "</td>";
            echo "<td>" . $view_booking_row['room_name'] . "</td>"; // Display room name
            echo "</tr>";
        }
        echo "</tbody></table></div>";
    } else {
        echo "<p class='text-muted'>You have no bookings.</p>";
    }
    ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
