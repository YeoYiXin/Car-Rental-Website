<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presley's Luxury Cars</title>
    <link rel="stylesheet" href="styleproduct.css">
</head>
<body>
    <div class = "header" id = "header">
        <nav id = "navbar">
          <div class = "logo">Presley's</div>
          <ul id = "menu">
            <li><a href = "../../dashboard/index.php">Home</a></li>
            <li><a href = "#" id = "phantom">Phantom</a></li>
            <li><a href = "#" id = "spur">Flying Spur</a></li>
            <li><a href = "#" id = "CLS">CLS 350</a></li>
            <li><a href = "#" id = "stype">S Type</a></li>
            <li><a href = "../../bookings/index.php">Booking</a></li>
          </ul>
        </nav>
        <div class="info">
            <div>
                <h2 id = "brand">Rolls Royce</h2>
                <p id = "color">Blue</p>
            </div>
            <div>
                <h2>Rental Price</h2>
                <p id = "price">RM 9800 per day</p>
            </div>
            <div class="line"></div>
            <div>
                <h2 id = "model">Phantom</h2>
            </div>
        </div>
    </div>
    <script>
        //Changes depending on the car chosen
        var header = document.getElementById("header");
        var phantom= document.getElementById("phantom");
        var spur = document.getElementById("spur");
        var cls = document.getElementById("CLS");
        var stype = document.getElementById("stype");
        var brand = document.getElementById("brand");
        var color = document.getElementById("color");
        var model = document.getElementById("model");
        var price = document.getElementById("price");

        phantom.onclick = function(){
            header.style.backgroundImage = "url(luxurycar/lux1.jpg)";
            brand.innerHTML = "Rolls Royce";
            color.innerHTML = "Blue";
            model.innerHTML = "Phantom";
            price.innerHTML = "RM 9800 per day";
        }

        spur.onclick = function(){
            header.style.backgroundImage = "url(luxurycar/lux2.jpg)";
            brand.innerHTML = "Bentley";
            color.innerHTML = "White";
            model.innerHTML = "Continental Flying Spur";
            price.innerHTML = "RM 4800 per day";
        }

        cls.onclick = function(){
            header.style.backgroundImage = "url(luxurycar/lux3.jpg)";
            brand.innerHTML = "Mercedez Benz";
            color.innerHTML = "Silver";
            model.innerHTML = "CLS 350";
            price.innerHTML = "RM 1350 per day";
        }

        stype.onclick = function(){
            header.style.backgroundImage = "url(luxurycar/lux4.jpg)";
            brand.innerHTML = "Jaguar";
            color.innerHTML = "Champagne";
            model.innerHTML = "S Type";
            price.innerHTML = "RM 1350 per day";
        }
    </script>
</body>
</html>