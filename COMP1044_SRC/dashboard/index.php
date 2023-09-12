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


//Query and Prepare statements to select from the database and display the various data
$result = $conn->query("SELECT * FROM car");

$numbooking = $conn->query("SELECT count(Booking_ID) as total FROM booking WHERE CURRENT_DATE() BETWEEN Start_Date AND End_Date;");

$availcarsnum = $conn->query("SELECT count(Car_ID) as total FROM car WHERE Car_ID NOT IN (SELECT Car_ID FROM booking WHERE (CURRENT_DATE() BETWEEN Start_Date AND End_Date));");

$availcars = $conn->query("SELECT * FROM car WHERE Car_ID NOT IN (SELECT Car_ID FROM booking WHERE (CURRENT_DATE() BETWEEN Start_Date AND End_Date));");

$monthsale = $conn->query("SELECT sum(Amount) as total FROM payment WHERE Status = 'Paid' AND Booking_ID IN ( SELECT Booking_ID FROM booking WHERE MONTH(Start_Date) = MONTH(CURRENT_DATE()) AND YEAR(Start_Date) = YEAR(CURRENT_DATE()) )");

$carsnumsss = $conn->prepare("SELECT count(Car_ID) as total FROM booking WHERE CURRENT_DATE() BETWEEN Start_Date AND End_Date AND Car_ID = ?;");


$recentbooking = $conn->query("SELECT car.Model, car.Type, car.Price, booking.Start_Date, booking.Time_Booked 
    FROM booking INNER JOIN car ON booking.Car_ID = car.Car_ID ORDER BY booking.Start_Date DESC, booking.Time_Booked DESC LIMIT 5");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

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
                <a href="#" class="active">
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
            <h1>Panel</h1>
            <div class="date">
                <input type='date'>
            </div>

            <div class="insights">
                <div class="bookings">
                    <ion-icon name="create-outline"></ion-icon>
                    <div class="middle">
                        <div class="left">
                            <h3>Total Number of Current Bookings</h3>
                        </div>
                        <div class="number">
                            <h1>
                                <?php //Gets total number of current bookings from the database
                                $data = $numbooking->fetch_assoc();
                                echo $data['total'];
                                ?>
                            </h1>
                        </div>
                    </div>

                </div>
                <!----------------------Available----------------->
                <div class="available">
                    <ion-icon name="stats-chart-outline"></ion-icon>
                    <div class="middle">
                        <div class="left">
                            <h3>Number of Available Cars</h3>
                        </div>
                        <div class="number">
                            <h1>
                                <?php //Gets the total number of available cars
                                $data = $availcarsnum->fetch_assoc();
                                echo $data['total'];
                                ?>
                            </h1>
                        </div>
                    </div>

                </div>
                <!----------------------Sales----------------->
                <div class="sales">
                    <ion-icon name="analytics-outline"></ion-icon>
                    <div class="middle">
                        <div class="left">
                            <h3>Total Sales for the Month</h3>
                        </div>
                        <div class="number">
                            <h1>
                                <?php //Gets the total sales for the month
                                $data = $monthsale->fetch_assoc();
                                echo '£' . $data['total'];
                                ?>
                            </h1>
                        </div>
                    </div>
                </div>
            </div>

            <!------------------------Cars list-->
            <div class="cartext">
                <h2>Cars list</h2>
            </div>
            <div class="cars-list">
                <table>
                    <thead>
                        <tr>
                            <th>Car Model</th>
                            <th>Plate Number</th>
                            <th>Type</th>
                            <th>Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php if ($result->num_rows == 0) { //If no cars are in the database ?>
                            <h1>No cars found</h1>
                        <?php } ?>

                        <?php while ($row = $result->fetch_assoc()) { //Pulls the data of cars in the database and display them row by row?>
                            <tr>
                                <td>
                                    <?php echo $row["Model"]; ?>
                                </td>
                                <td>
                                    <?php echo $row["Plate_No"]; ?>
                                </td>
                                <td>
                                    <?php echo $row["Type"]; ?>
                                </td>
                                <td>
                                    <?php echo '£' . $row["Price"]; ?>
                                </td>
                                <td class=<?php //Executes, previous prepare statement to display whether a car is available or not
                                $carid = $row["Car_ID"];

                                $carsnumsss->bind_param("s", $carid);
                                $carsnumsss->execute();
                                $results = $carsnumsss->get_result();
                                $rows = $results->fetch_assoc();

                                if ($rows["total"] > 0) {
                                    $_SESSION["availcars"] = "Unavailable";
                                    echo 'reddy';
                                } else {
                                    $_SESSION["availcars"] = "Available";
                                    echo 'success';
                                }
                                ?>>
                                    <?php echo $_SESSION["availcars"]; ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
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
                                <?php
                                //Places the staff name on the top right corner of the screen
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

            <div class="recentbookings">
                <h2>Recent Bookings</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Car Model</th>
                            <th>Type</th>
                            <th>Price</th>
                            <th>Date</th>
                            <th>Time</th>
                        </tr>
                    <tbody>
                        <?php if ($result->num_rows == 0) { //If no cars are in the database ?>
                            <h1>No cars found</h1>
                        <?php } ?>

                        <?php while ($row = $recentbooking->fetch_assoc()) { //Pulls the data of recent bookings in the database and display them row by row ?>
                            <tr>
                                <td>
                                    <?php echo $row['Model']; ?>
                                </td>
                                <td>
                                    <?php echo $row['Type']; ?>
                                </td>
                                <td>
                                    <?php echo '£' . $row['Price']; ?>
                                </td>
                                <td>
                                    <?php //Function too display date
                                    $orgdate = $row['Start_Date'];
                                    $newdate = date("d/m/y", strtotime($orgdate));
                                    echo $newdate;
                                    ?>
                                </td>
                                <td>
                                    <?php echo $row['Time_Booked']; ?>
                                </td>
                            </tr>
                        <?php } ?>
                        <tr>
                    </tbody>
                    </thead>
                </table>
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