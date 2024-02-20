<?php
require('auth-navbar.php');
require('config/connection.php');

$booking_time_query = "show columns from booking_tbl where field = 'book_time'";
$booking_time_query_result = mysqli_query($con,$booking_time_query);

$available_times = array();
if ($booking_time_query_result->num_rows == 1) {
    $booking_time_row = $booking_time_query_result->fetch_assoc();
    
    preg_match_all("/'(.*?)'/", $booking_time_row["Type"], $matches);
    $available_times = $matches[1];
} else {
    echo "Error: Unable to fetch book_time column information.";
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

            let room = document.getElementById("selected_room").value;
            

            let xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    let bookedTimes = JSON.parse(xhr.responseText);
                    let selectTime = document.getElementById("selected_time");
                    selectTime.innerHTML = "";

                    <?php foreach($available_times as $time): ?>
                    if (!bookedTimes.includes("<?php echo $time; ?>")) {
                        let option = document.createElement("option");
                        option.text = "<?php echo $time; ?>";
                        selectTime.add(option);
                    }
                    <?php endforeach; ?>
                }
            };
                    
            
            xhr.open("GET", "get_booked_times.php?selected_date=" + selectedDate + "&room=" + room, true);
            xhr.send();
        }
    </script>
    
</head>
<body>
<main>
    <form action="config/process_booking.php" method="post">
        <h1>Book a room</h1>
    <div>
        <?php
        $room_name_query="select room_name, rooms_id from rooms_tbl";
        $room_name_query_result=mysqli_query($con,$room_name_query);
        if(!$room_name_query_result){
            echo 'Error: '.msqli_error($con);
        }
        ?>

<label for="room">Select a room:</label>
<select name="room" id="selected_room" onchange="populateTimes()" required >
    <?php
    while($room_name_row = mysqli_fetch_assoc($room_name_query_result)){
        echo '<option value="' . $room_name_row['rooms_id'] . '">' . $room_name_row['room_name'] . '</option>';
    }
    ?>
</select>
    </div>
        <div>
            <label for="selected_date">Choose a day:</label>
            <input type="date" name="selected_date" id="selected_date" onchange="populateTimes()" required>
        </div>
        <div>
            <label for="selected_time">Choose time:</label>
            <select name="selected_time" id="selected_time" required>
                
            </select>
        </div>
        <button type="submit" name="booked">Book</button>
    </form>

</main>
</body>
</html>
