<?php
session_start();

if (!isset($_SESSION['user_authenticated']) || !$_SESSION['user_authenticated']) {
    // Redirect to the login page if the user is not authenticated
    header("Location: login.php");
    exit();
}

$firstName = $_SESSION['user_fName'];
$lastName = $_SESSION['user_lName'];


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style.css">
    <title>GDrive ChangePW</title>
    <link rel="icon" type="image/x-icon" href="../img/favicon.ico">
</head>

<body>
    <div class="container">
        <div class="mLine">
            <div>
                <?php echo $firstName . " " . $lastName; ?>
            </div>
            <div>
                <?php
                //date_default_timezone_set("Australia/Brisbane");
                //echo date_default_timezone_get();
                echo date('d/m/Y') . " " . date("h:i a");
                ?></div>
        </div>
        <div class="logobox">
            <div><img class="logo" src="../img/GDrive_logo.png" alt="gdrive logo"></div>
            <div class="logotext">
                <h1 class="upper">Change</h1>
                <h1 class="lower">Password</h1>
            </div>
        </div>

        <form action="change_password_process.php" method="post">
            <div class="inLine"><label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="inLine"><label for="current_password">Current Password:</label>
                <input type="password" name="current_password" id="current_password" required>
            </div>
            <div class="inLine"><label for="new_password">New Password:</label>
                <input type="password" name="new_password" id="new_password" required>
                <input type="checkbox" id="check"> Show
            </div>
            <div class="inLine"><label for="password2">C'firm New Password:</label>
                <input type="password" name="password2" id="password2" required>
                <input type="checkbox" id="confirm_check"> Show
            </div>
            <div class="password">
                8 characters minimum. 1 UPPER CASE, 1 lower case, 1 Number and 1&nbsp;Punctuation. Example ( Axbx3x?x )
            </div>
            <div class="buttonBox2">
                <button class="button color12" type="submit">Change Password</button>
                <a class="button color32" href="../mdashboard.php">Back</a>
            </div>
        </form>

    </div>

    <script>
        window.onload = function() {
            //debugger;
            var password = document.getElementById("new_password");
            var password2 = document.getElementById("password2");

            var check = document.getElementById("check");
            var confirm_check = document.getElementById("confirm_check");

            check.onchange = function() {
                if (this.checked) {
                    password.type = "text";
                } else {
                    password.type = "password";
                }
            };

            confirm_check.onchange = function() {
                if (this.checked) {
                    password2.type = "text";
                } else {
                    password2.type = "password";
                }
            };

            function validatePassword() {
                if (password.value != password2.value) {
                    password2.setCustomValidity("Passwords Don't Match");
                } else {
                    password2.setCustomValidity('');
                }
                password2.reportValidity();
            }

            password.onchange = validatePassword;
            password2.onkeyup = validatePassword;
        };
    </script>
</body>

</html>