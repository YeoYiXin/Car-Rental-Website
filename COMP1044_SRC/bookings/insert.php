<?php
//Starts session
session_start();

//If the user submitted
if (isset($_POST['check-avail'])) {

    //Connection to database
    include("../dbconn.php");

    //Declaring variables which user posted
    $start_date = $_POST['start-date'];
    $end_date = $_POST['end-date'];
    $car_model = $_POST['car-model'];

    $curtime = new DateTime();
    $curtime->modify("-1 day");
    $start_dates = new DateTime($start_date);

    //Checking if the inputted variables are valid
    if ($curtime > $start_dates) {
        header("Location: ../bookings/index.php?booking=datepast");
        exit();
    }
    if ($end_date <= $start_date) {
        header("Location: ../bookings/index.php?booking=endbeforestart");
        exit();
    }


    // Prepare and execute statement to select from car table
    $stmt = $conn->prepare("SELECT * FROM car WHERE Model = ? AND Car_ID NOT IN (SELECT Car_ID FROM booking WHERE (? BETWEEN Start_Date AND End_Date) OR (? BETWEEN Start_Date AND End_Date));");

    //Session variables to be used throughout the code
    $_SESSION["start_date"] = $start_date;
    $_SESSION["end_date"] = $end_date;

    $stmt->bind_param("sss", $car_model, $start_date, $end_date);

    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    //Session variables to be used throughout the code
    $_SESSION["car_price"] = $row["Price"];
    $_SESSION["car_id"] = $row["Car_ID"];

    //If the car is availble then then the user to the next step
    if ($result->num_rows > 0) {
        header("Location: ../bookings/index1.php");
        exit();
    } else { //Car not available
        header("Location: ../bookings/index.php?booking=carnotavail");
        exit();
    }
} else {
    //If error
    header("Location: ../bookings/index.php?booking=invalidbooking");
    exit();
}
?>