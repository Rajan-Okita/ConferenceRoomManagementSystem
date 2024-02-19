<?php
require('auth-navbar.php');
require('config/connection.php');


$booking_time_query = "show columns from booking_tbl where field = 'book_time'";
$booking_time_query_result = mysqli_query($con,$booking_time_query);

$available_times = array();
if ($booking_time_query_result->num_rows == 1) {
    $row = $booking_time_query_result->fetch_assoc();
    
    preg_match_all("/'(.*?)'/", $row["Type"], $matches);
    $available_times = $matches[1];
} else {
    echo "Error: Unable to fetch book_time column information.";
}
while ($row = $booking_time_query_result->fetch_assoc()) {
    $available_times[] = $row['book_time'];
}

?>
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

    <script>
        function populateTimes() {
            let selectedDate = document.getElementById("selected_date").value;

            let availableTimes = <?php echo json_encode($available_times); ?>;

            let selectTime = document.getElementById("select_time");

            selectTime.innerHTML = "";

            for (let i = 0; i < availableTimes.length; i++) {
                let option = document.createElement("option");
                option.text = availableTimes[i];
                selectTime.add(option);
            }
        }
    </script>
    
</head>
<body>
<main>
    <form action="config/process_booking.php" method="post">
        <h1>Book a room</h1>
    <div>
        <?php
        $room_name_query="select room_name from rooms_tbl";
        $room_name_query_result=mysqli_query($con,$room_name_query);
        if(!$room_name_query_result){
            echo 'Error: '.msqli_error($con);
        }
        ?>

<label for="room">Select a room:</label>
<select name="room" required >
    <?php
    while($room_name_row = mysqli_fetch_assoc($room_name_query_result)){
        echo "<option>" . $room_name_row['room_name'] . "</option>";
    }
    ?>
</select>
    </div>
        <div>
            <label for="selected_date">Choose a day:</label>
            <input type="date" name="selected_date" id="selected_date" onchange="populateTimes()" required>
        </div>
        <div>
            <label for="select_time">Choose time:</label>
            <select name="select_time" id="select_time" required>
                
            </select>
        </div>
        <button type="submit" name="book">Book</button>
    </form>

</main>
</body>
</html>
