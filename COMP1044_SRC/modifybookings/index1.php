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

?>

<!DOCTYPE html>
<html lang="en" scroll-behavior: smooth>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify Bookings</title>

    <link rel="stylesheet" href="./style1.css">
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
                <a href="#" class="active">
                    <ion-icon name="calendar-outline"></ion-icon>
                    <h3>Modify Bookings</h3>
                    <a href="../deletebookings/index.php">
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
            <div class="restitle">
                <h2>Successfully Modified Booking No: </h2>
            </div>
            <div class="reserve">
                <h1>
                    <?php //Displays the modified booking number to the user
                    if (isset($_GET['booking'])) {
                        if ($_GET['booking'] == 'successful') {
                            echo $_SESSION["reservation_no"];
                        }
                    }
                    ?>
                </h1>
            </div>
            <div class="return">
                <button>
                    <a href="../dashboard/index.php">
                        <h2>Return to Dashboard</h2>
                    </a>
                </button>
            </div>
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