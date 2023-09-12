<?php
//Starts session
session_start();

//If the user submitted
if (isset($_POST['modify-booking'])) {

    //Connection to database
    include("../dbconn.php");

    //Declaring variables which user posted
    $id_number = $_POST['id-number'];
    $booking_num = $_POST["booking-number"];
    $start_date = $_POST['start-date'];
    $end_date = $_POST['end-date'];

    $curtime = new DateTime();

    //Checking if the inputted variables are valid
    if ($start_date >= $curtime) {
        header("Location: ../modifybookings/index.php?booking=datepast");
        exit();
    }
    if ($end_date <= $start_date) {
        header("Location: ../modifybookings/index.php?booking=endbeforestart");
        exit();
    }


    // Prepare and execute statement to select from customer and booking table table
    $stmt = $conn->prepare("SELECT * FROM booking INNER JOIN customer ON booking.Customer_ID = customer.Customer_ID WHERE customer.ID_Number = ? AND booking.Booking_ID = ? AND booking.Car_ID NOT IN (SELECT Car_ID FROM booking WHERE (((? BETWEEN Start_Date AND End_Date) OR (? BETWEEN Start_Date AND End_Date)) AND Booking_ID != ?));");
    $stmt->bind_param("sssss", $id_number, $booking_num, $start_date, $end_date, $booking_num);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();


    //If the car is available to modify then the user to the next step
    if ($result->num_rows > 0) {
        //Session to show reservation number
        $_SESSION["reservation_no"] = $row["Booking_ID"];
        
        // Prepare and execute statement then modify/update the booking row
        $stmt = $conn->prepare("UPDATE booking SET Start_Date = ?, End_Date = ? WHERE Booking_ID = ?");
        $stmt->bind_param("sss", $start_date, $end_date, $booking_num);
        $stmt->execute();
        header("Location: ../modifybookings/index1.php?booking=successful");
        exit();
    } else { //Not available to modify booking
        header("Location: ../modifybookings/index.php?booking=invalidbooking1");
        exit();
    }
} else { //If error
    header("Location: ../modifybookings/index.php?booking=invalidbooking2");
    exit();
}
?>