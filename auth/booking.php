<?php
require('auth-navbar.php');?>

<!doctype html>
<html lang="eng">
<head>
    <title>Booking page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.phptutorial.net/app/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<main>
    <form action="config/process_booking.php" method="post">
        <h1>Book a room</h1>
    <div>
<label for="room">Select a room:</label>
<select name="room" required >
    <option>Board room</option>
    <option>Training room</option>
</select>
    </div>
        <div>
<label for="book_day">Choose a day:</label>
            <input type="date" name="book_day" id="book_day" required>
        </div>
        <div>
            <label for="book_time">Choose time:</label>
            <select name="book_time" required>
                <option>08:00-10:00</option>
                <option >10:00-12:00</option>
                <option >12:00-14:00</option>
                <option >14:00-16:00</option>
                <option >16:00-18:00</option>
            </select>
        </div>

        <button type="submit" name="book">Book</button>
    </form>

</main>
</body>
</html>
