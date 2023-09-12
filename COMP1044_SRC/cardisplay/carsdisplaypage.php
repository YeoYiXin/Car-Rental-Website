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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cars Page</title>

    <link rel="stylesheet" href="./stylecar.css">
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
                <a href="#" class="active">
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
        <main>
            <div class="top">
                <h1>Our Collection</h1>
                <div class="theme">
                    <ion-icon name="sunny" class="active">lightmode</ion-icon>
                    <ion-icon name="moon">darkmode</ion-icon>
                </div>
            </div>

            <div class="gallery">
                <div class="card">
                    <a href="../cardisplay/luxuryproduct/luxurypage.php"><img
                            src="carpics/flyingspur.jpg"></a>
                    <div class="desc">
                        <h2>Luxury Cars</h2>
                        <h2>RM 1350 onwards</h2>
                        <p>per day</p>
                    </div>
                </div>
                <div class="card">
                    <a href="../cardisplay/sportsproduct/sportspage.php"><img
                            src="carpics/boxster.jpg"></a>
                    <div class="desc">
                        <h2>Sports Cars</h2>
                        <h2>RM 1600 onwards</h2>
                        <p>per day</p>
                    </div>
                </div>
                <div class="card">
                    <a href="../cardisplay/classicproduct/classicpage.php"><img
                            src="carpics/mk2.jpg"></a>
                    <div class="desc">
                        <h2>Classics</h2>
                        <h2>RM 2200 onwards</h2>
                        <p>per day</p>
                    </div>
                </div>
            </div>


        </main>
        <div class="right">
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
                    <div class="smalls">
                        <small class="text-muted">Staff</small>
                    </div>
                </div>
                <div class="photo">
                    <ion-icon name="person-circle-outline"></ion-icon>
                </div>
            </div>
        </div>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script>
        //Implements night mode and dark mode function
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