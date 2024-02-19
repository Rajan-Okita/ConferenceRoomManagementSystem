<?php

require('config/connection.php');

if(isset($_GET['selected_date']) && isset($_GET['room'])) {

    $selected_date = mysqli_real_escape_string($con, $_GET['selected_date']);
    $selected_room = mysqli_real_escape_string($con, $_GET['room']);

    $booked_times_query = "SELECT book_time FROM booking_tbl WHERE day_booked = '$selected_date' AND room_id = '$selected_room'";
    $booked_times_result = mysqli_query($con, $booked_times_query);

    $booked_times = array();
    while ($row = mysqli_fetch_assoc($booked_times_result)) {
        $booked_times[] = $row['book_time'];
    }

    // Return booked times as JSON
    echo json_encode($booked_times);
} else {
    // Return an error message if parameters are not set
    echo "Error: Parameters 'selected_date' and 'room' are required.";
}
?>
