<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presley's Classical Cars</title>
    <link rel="stylesheet" href="styleproduct3.css">
</head>
<body>
    <div class = "header" id = "header">
        <nav id = "navbar">
          <div class = "logo">Presley's</div>
          <ul id = "menu">
            <li><a href = "../../dashboard/index.php">Home</a></li>
            <li><a href = "#" id = "mk2">MK 2</a></li>
            <li><a href = "#" id = "spirit">Spirit Limo</a></li>
            <li><a href = "#" id = "td">TD</a></li>
            <li><a href = "../../bookings/index.php">Booking</a></li>
          </ul>
        </nav>
        <div class="info">
            <div>
                <h2 id = "brand">Jaguar</h2>
                <p id = "color">White</p>
            </div>
            <div>
                <h2>Rental Price</h2>
                <p id = "price">RM 2200 per day</p>
            </div>
            <div>
                <h2>Year</h2>
                <p id = "speed">1994</p>
            </div>
            <div class="line"></div>
            <div>
                <h2 id = "model">MK 2</h2>
            </div>
        </div>
    </div>
    <script>
        //Changes depending on car chosen
        var header = document.getElementById("header");
        var mk2 = document.getElementById("mk2");
        var spirit = document.getElementById("spirit");
        var td = document.getElementById("td");
        var brand = document.getElementById("brand");
        var color = document.getElementById("color");
        var model = document.getElementById("model");
        var price = document.getElementById("price");
        var year = document.getElementById("year");

        mk2.onclick = function(){
            header.style.backgroundImage = "url(classiccar/classic1.jpg)";
            brand.innerHTML = "Jaguar";
            color.innerHTML = "White";
            model.innerHTML = "MK 2";
            price.innerHTML = "RM 2200 per day";
            year.innerHTML = "1994";
        }

        spirit.onclick = function(){
            header.style.backgroundImage = "url(classiccar/classic2.jpg)";
            brand.innerHTML = "Rolle Royce";
            color.innerHTML = "Georgian Silver";
            model.innerHTML = "Silver Spirit Limo";
            price.innerHTML = "RM 3200per day";
            year.innerHTML = "1981";
        }

        td.onclick = function(){
            header.style.backgroundImage = "url(classiccar/classic3.jpg)";
            brand.innerHTML = "MG";
            color.innerHTML = "Red";
            model.innerHTML = "TD";
            price.innerHTML = "RM 2500 per day";
            year.innerHTML = "1952";
        }
    </script>
</body>
</html>