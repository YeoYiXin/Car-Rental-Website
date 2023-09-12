<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    session_start();
    //Start session

    //If user posted ID and Password
    if (isset($_POST['staff-id']) && isset($_POST['password'])) {
        //Connection to database
        include("../dbconn.php");

        //Declaring variables which user posted
        $id = $_POST['staff-id'];
        $password = $_POST['password'];


        
        // Prepare and execute statement to select from staff table
        $stmt = $conn->prepare("SELECT * FROM staff WHERE Staff_ID = ? AND Password = ?");
        $stmt->bind_param("ss", $id, md5($password)); //md5 is an encryption for the password

        $stmt->execute();
        $result = $stmt->get_result();

        //Session variables to be used throughout the code
        $_SESSION["staff_id"] = $id;

        if ($result->num_rows > 0){
            //If staff exists then session is declared and user is taken to the dashboard
            $row = $result->fetch_assoc();
            $fullName = $row['First_Name'] . " " . $row['Last_Name'];
            $_SESSION['staff-name'] = $fullName;    
            header("Location: ../dashboard/index.php");
            exit();
        }
        else {
            //Either incorrect staffID or password
            $_SESSION["error"] = " <script>alert('Incorrect Staff ID or password. Please try again.')</script>";
            header("Location: ../login/index.php");
            exit();
        }
    }

    else{ //If error
        header("Location: ../login/index.php?invalid=invalid-details");
    }
?>