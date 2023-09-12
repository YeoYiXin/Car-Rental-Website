<?php
session_start();

if (isset($_POST['submit-booking'])) {
    include("../dbconn.php");

    $first_name = $_POST['first-name'];
    $last_name = $_POST['last-name'];
    $date_birth = $_POST['date-birth'];
    $address = $_POST['address'];
    $po_box = $_POST['po-box'];
    $id_num = $_POST['id-number'];

    $booking_id = uniqid("BO");
    $customer_id = uniqid("CO");
    $payment_id = uniqid("PAY");

    // Prepare and execute statement to insert into customer table

    if ($date_birth > '2010/04/01') {
        header("Location: ../bookings/index1.php?booking=ageyoung");
        exit();
    }


    if ($row) {
        $customer_id = $row["Customer_ID"];
    } else {
        // Otherwise, insert a new customer record and generate a new customer ID
        $stmt = $conn->prepare("INSERT INTO customer (Customer_ID, First_Name, Last_Name, Date_of_Birth, Address, PO_Box, ID_Number) VALUES (?, ?, ?, ?, ?, ?, ?);");
        $stmt->bind_param("sssssss", $customer_id, $first_name, $last_name, $date_birth, $address, $po_box, $id_num);
        if (!$stmt->execute()) {
            die("Insert into customer table failed: " . $stmt->error);
        }
    }

    // Prepare and execute statement to select from customer table
    $qry = $conn->prepare("SELECT * FROM customer WHERE First_Name = ? AND Last_Name = ? AND ID_Number = ?");
    $qry->bind_param("sss", $first_name, $last_name, $id_num);
    if (!$qry->execute()) {
        die("Select from customer table failed: " . $qry->error);
    }
    $result = $qry->get_result();
    $row = $result->fetch_assoc();

    // Prepare and execute statement to insert into booking table
    $stmt1 = $conn->prepare("INSERT INTO booking (Booking_ID, Car_ID, Customer_ID, Staff_ID, Start_Date, End_Date) VALUES (?, ?, ?, ?, ?, ?);");
    $stmt1->bind_param("ssssss", $booking_id, $_SESSION["car_id"], $row["Customer_ID"], $_SESSION["staff_id"], $_SESSION["start_date"], $_SESSION["end_date"]);
    if (!$stmt1->execute()) {
        die("Insert into booking table failed: " . $stmt1->error);
    }

    // Prepare and execute statement to select from booking table
    $qry1 = $conn->prepare("SELECT * FROM booking WHERE Car_ID = ? AND Customer_ID = ? AND Start_Date = ? AND End_Date = ?");
    $qry1->bind_param("ssss", $_SESSION["car_id"], $row["Customer_ID"], $_SESSION["start_date"], $_SESSION["end_date"]);
    if (!$qry1->execute()) {
        die("Select from booking table failed: " . $qry1->error);
    }
    $result1 = $qry1->get_result();
    $row1 = $result1->fetch_assoc();

    $_SESSION["reservation_no"] = $row1["Booking_ID"];

    // Prepare and execute statement to insert into payment table
    $stmt2 = $conn->prepare("INSERT INTO payment (Payment_ID, Customer_ID, Booking_ID, Amount, Status) VALUES (?, ?, ?, ?, 'Paid');");
    $stmt2->bind_param("ssss", $payment_id, $row["Customer_ID"], $row1["Booking_ID"], $_SESSION["car_price"]);
    if (!$stmt2->execute()) {
        die("Insert into payment table failed: " . $stmt2->error);
    }

    //Booking successful
    header("Location: ../bookings/index2.php?booking=successful");
    exit();
} else {
    //If error
    header("Location: ../bookings/index.php?booking=invalidbooking");
    exit();
}
?>