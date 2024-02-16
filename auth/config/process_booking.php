<?php
require("connection.php");
session_start();
$query = "SELECT users_id FROM users_tbl";
$result = mysqli_query($con, $query);
if ($result && mysqli_num_rows($result) > 0) {
$row = mysqli_fetch_assoc($result);}
$users_id=$_SESSION['session_id'] = $row['users_id'];

$query = "SELECT rooms_id FROM rooms_tbl";
$result = mysqli_query($con, $query);
if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);}
$room_id=$_SESSION['session_room'] = $row['rooms_id'];

if (isset($_POST['book'])) {

    $room = $_POST['room'];
    $book_day = $_POST['book_day'];
    $book_time = $_POST['book_time'];

    $day_of_week = date('w', strtotime($book_day));
    if ($day_of_week == 0) {
        echo "Sorry, bookings are not allowed on Sundays.";
    } else {

        $room_check_query = "SELECT * FROM booking_tbl WHERE room = '$room' AND day_booked = '$book_day' AND book_time = '$book_time'";
        $existing_booking = mysqli_query($con, $room_check_query);

        if (mysqli_num_rows($existing_booking) > 0) {
            echo "Sorry, this room is already booked for the selected time slot. Please choose another time.";
        } else {

            $booking_query = "INSERT INTO booking_tbl (room, day_booked, book_time,users_id,room_id) VALUES ('$room', '$book_day', '$book_time','$users_id','$room_id')";
            $booking_query_con = mysqli_query($con, $booking_query);

            if ($booking_query_con) {
                echo "Booking successful!";
            } else {
                echo "Error: " . mysqli_error($con);
            }
        }
    }
}
?>
