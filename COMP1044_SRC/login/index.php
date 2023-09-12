<?php
session_start();
$error = "";
if (isset($_SESSION["error"])) {
    $error = $_SESSION["error"];
    unset($_SESSION["error"]);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="login.css">
    <title>Presley's Luxury Cars</title>
</head>

<body>
    <section>
        <div class="form-box">
            <div class="form-value">
                <?php if ($error != "") { ?>
                    <p>
                        <?php echo $error; ?>
                    </p>
                <?php } ?>
                <form action="insert.php" method="POST" autocomplete="off" onsubmit="return showSubmittedMessage()">
                    <h2>Login</h2>
                    <div class="inputbox">
                        <ion-icon name="mail-outline"></ion-icon>
                        <input type="text" id="staff-id" name="staff-id" required>
                        <label for="">Staff ID</label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="password" id="password" name="password" required>
                        <label for="">Password</label>
                    </div>
                    <button>Log in</button>
                </form>
            </div>
        </div>
    </section>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>