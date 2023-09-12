<?php
    //Start session
    session_start();

        //If the user submitted
        if (isset($_POST['delete-booking'])) {

            //Connection to database
            include ("../dbconn.php");

            //Declaring variables which user posted
            $id_number = $_POST['id-number'];
            $booking_num = $_POST["booking-number"];

            // Prepare and execute statement to select from booking and customer table
            $stmt = $conn->prepare("SELECT * FROM booking INNER JOIN customer ON booking.Customer_ID = customer.Customer_ID WHERE booking.Booking_ID = ? AND customer.ID_Number = ?;");
            $stmt->bind_param("ss", $booking_num, $id_number);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            //Session variables to be used throughout the code
            $_SESSION["reservation_no"] = $row["Booking_ID"];


            // Prepare and execute statement to delete from booking and customer table
            $stmt = $conn->prepare("DELETE booking FROM booking INNER JOIN customer ON booking.Customer_ID = customer.Customer_ID WHERE booking.Booking_ID = ? AND customer.ID_Number = ?;");
            $stmt->bind_param("ss", $booking_num, $id_number);
            $stmt->execute();

            //If one or more row is deleted then success
            if ($stmt->affected_rows > 0)
            {
                header("Location: ../deletebookings/index1.php?booking=successful");
                exit();
            }
            else { //Couldn't delete booking
                header("Location: ../deletebookings/index.php?booking=invalidbooking1");
                exit();
            }
        }
        else { //If error
            header("Location: ../deletebookings/index.php?booking=invalidbooking2");
            exit();
        }
?>