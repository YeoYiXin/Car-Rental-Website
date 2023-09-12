<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presley's Sports Cars</title>
    <link rel="stylesheet" href="styleproduct2.css">
</head>
<body>
    <div class = "header" id = "header">
        <nav id = "navbar">
          <div class = "logo">Presley's</div>
          <ul id = "menu">
            <li><a href = "../../dashboard/index.php">Home</a></li>
            <li><a href = "#" id = "scuderia">F430 Scuderia</a></li>
            <li><a href = "#" id = "murcielago">Murcielago LP640</a></li>
            <li><a href = "#" id = "boxster">Boxster</a></li>
            <li><a href = "#" id = "SC430">SC430</a></li>
            <li><a href = "../../bookings/index.php">Booking</a></li>
          </ul>
        </nav>
        <div class="info">
            <div>
                <h2 id = "brand">Ferrari</h2>
                <p id = "color">Red</p>
            </div>
            <div>
                <h2>Rental Price</h2>
                <p id = "price">RM 6000 per day</p>
            </div>
            <div>
                <h2>Top Speed</h2>
                <p id = "speed">320 km/h</p>
            </div>
            <div class="line"></div>
            <div>
                <h2 id = "model">F430 Scuderia</h2>
            </div>
        </div>
    </div>
    <script>
        //Changes depending on the car chosen
        var header = document.getElementById("header");
        var scuderia = document.getElementById("scuderia");
        var murcielago = document.getElementById("murcielago");
        var boxster = document.getElementById("boxster");
        var SC430 = document.getElementById("SC430");
        var brand = document.getElementById("brand");
        var color = document.getElementById("color");
        var model = document.getElementById("model");
        var price = document.getElementById("price");
        var speed = document.getElementById("speed");

        scuderia.onclick = function(){
            header.style.backgroundImage = "url(sportscar/sports1.jpg)";
            brand.innerHTML = "Ferrari";
            color.innerHTML = "Rede";
            model.innerHTML = "F430 Scuderia";
            price.innerHTML = "RM 6000 per day";
            speed.innerHTML = "320 km/h";
        }

        murcielago.onclick = function(){
            header.style.backgroundImage = "url(sportscar/sports2.jpg)";
            brand.innerHTML = "Lamborghini";
            color.innerHTML = "Matte Black";
            model.innerHTML = "Murcielago LP640";
            price.innerHTML = "RM 7000 per day";
            speed.innerHTML = "340 km/h";
        }

        boxster.onclick = function(){
            header.style.backgroundImage = "url(sportscar/sports3.jpg)";
            brand.innerHTML = "Porsche";
            color.innerHTML = "White";
            model.innerHTML = "Boxster";
            price.innerHTML = "RM 2800 per day";
            speed.innerHTML = "274 km/h";
        }

        SC430.onclick = function(){
            header.style.backgroundImage = "url(sportscar/sports4.jpg)";
            brand.innerHTML = "Lexus";
            color.innerHTML = "Black";
            model.innerHTML = "SC430";
            price.innerHTML = "RM 1350 per day";
            speed.innerHTML = "250 km/h";
        }
    </script>
</body>
</html>