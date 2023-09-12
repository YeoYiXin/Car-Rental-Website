<?php
//Include access to database
include("../dbconn.php");

//start session
session_start();


//Check whether the session is there otherwise log the user out
if (isset($_SESSION['staff-name'])) {
    $staffName = $_SESSION['staff-name'];
} else {
    header("Location: ../login/index.php");
    exit();
}

//Alerts the user if the inputs are invalid
if (isset($_GET['booking'])) {
    if ($_GET['booking'] == 'invalidbooking1') {
        echo '<script>alert("Invalid Booking. Please another time.")</script>';
    }
    if ($_GET['booking'] == 'invalidbooking2') {
        echo '<script>alert("Invalid Booking. Please another time.")</script>';
    }
}

?>

<!DOCTYPE html>
<html lang="en" scroll-behavior: smooth>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Bookings</title>

    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <div class="container">
        <aside>
            <div class="top">
                <div class="logo">
                    <h2>Presley's Luxury Cars</h2>
                </div>
            </div>

            <div class="sidebar">
                <a href="../dashboard/index.php">
                    <ion-icon name="grid-outline"></ion-icon>
                    <h3>Panel</h3>
                </a>
                <a href="../cardisplay/carsdisplaypage.php">
                    <ion-icon name="car-sport-outline"></ion-icon>
                    <h3>Cars</h3>
                </a>
                <a href="../bookings/index.php">
                    <ion-icon name="duplicate-outline"></ion-icon>
                    <h3>New Bookings</h3>
                </a>
                <a href="../modifybookings/index.php">
                    <ion-icon name="calendar-outline"></ion-icon>
                    <h3>Modify Bookings</h3>
                    <a href="#" class="active">
                        <ion-icon name="trash-outline"></ion-icon>
                        <h3>Delete Bookings</h3>
                    </a>
                    <a href="../logout/index.php">
                        <ion-icon name="log-out-outline"></ion-icon>
                        <h3>Logout</h3>
                    </a>
            </div>
        </aside>
        <!----------------------Main----------------->
        <main>
            <h1>Presley's Car Booking</h1>
            <form action="delete.php" method="POST" onsubmit="return showSubmittedMessage()">
                <div class="form-group">
                    <label for="first-name">Booking No:</label>
                    <input type="text" id="booking-number" name="booking-number" required>
                </div>
                <div class="form-group">
                    <label for="id-number">ID Number:</label>
                    <input type="number" min="0" id="id-number" name="id-number" required>
                </div>
                <button type="submit" name="delete-booking">Submit</button>
            </form>


        </main>
        <!--------------------Main End-------------------->
        <div class="right">
            <div class="top">
                <div class="theme">
                    <ion-icon name="sunny" class="active">lightmode</ion-icon>
                    <ion-icon name="moon">darkmode</ion-icon>
                </div>
                <div class="profile">
                    <div class="info">
                        <p>Hey, <b>
                                <?php //Places the staff name on the top right corner of the screen
                                if (isset($_SESSION['staff-name'])) {
                                    $staffName = $_SESSION['staff-name'];
                                    echo "$staffName";
                                } else {
                                    header("Location: ../login/index.php");
                                    exit();
                                }
                                ?>
                            </b></p>
                        <small class="text-muted">Staff</small>
                    </div>
                    <div class="photo">
                        <ion-icon name="person-circle-outline"></ion-icon>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <script>
        //Implements light mode and dark mode function
        const themebutton = document.querySelector(".theme");
        const body = document.body;

        const isDarkMode = localStorage.getItem('theme') === 'dark';

        if (isDarkMode) {
            body.classList.add('dark-theme');
            themebutton.querySelector('ion-icon[name="sunny"]').classList.remove('active');
            themebutton.querySelector('ion-icon[name="moon"]').classList.add('active');
        } else {
            body.classList.remove('dark-theme');
            themebutton.querySelector('ion-icon[name="sunny"]').classList.add('active');
            themebutton.querySelector('ion-icon[name="moon"]').classList.remove('active');
        }

        themebutton.addEventListener('click', () => {
            body.classList.toggle('dark-theme');

            localStorage.setItem('theme', body.classList.contains('dark-theme') ? 'dark' : 'light');

            themebutton.querySelector('ion-icon[name="sunny"]').classList.toggle('active');
            themebutton.querySelector('ion-icon[name="moon"]').classList.toggle('active');
        });
    </script>

</body>

</html>