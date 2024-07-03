<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GDrive Register</title>
    <link rel="icon" type="image/x-icon" href="../img/favicon.ico">
    <link rel="stylesheet" href="../css/login.css">
    <script defer src="../js/number.js"></script>
</head>

<body>
    <div class="container">
        <div class="logobox">
            <div><img class="logo" src="../img/tth-logo-nb.png" alt="gdrive logo"></div>
            <div class="logotext">
                <h2>TreeTopHeights</h2>
                <h2>Register</h2>
            </div>
        </div>
        <form action="register_process.php" method="post">
            <div class="inLine"><label for="firstname">First&nbsp;Name:</label>
                <input type="text" name="firstname" id="firstname" required>
            </div>
            <div class="inLine"><label for="lastname">Last&nbsp;Name:</label>
                <input type="text" name="lastname" id="lastname" required>
            </div>
            <div class="inLine"><label for="mobile">Mobile:&nbsp;&nbsp;&nbsp;</label>
                <input type="tel" name="mobile" id="mobile" placeholder="Include country code(+xx)" required>
            </div>
            <div class="pStatus">
                <p id="text1">&nbsp;</p>
                <p id="text2"></p>
            </div>
            <div class="inLine"><label for="email">Email:&nbsp;&nbsp;&nbsp;&nbsp;</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="inLine"><label for="password">Password:</label>
                <input type="password" name="password" id="password" required>
                <input type="checkbox" id="check"> Show Password
            </div>
            <div class="inLine"><label for="password2">Confirm Password:</label>
                <input type="password" name="password2" id="password2" required>
                <input type="checkbox" id="confirm_check"> Show Password
            </div>
            <div class="password">
                8 characters minimum. 1 UPPER CASE, 1 lower case, 1 Number and 1&nbsp;Punctuation. Example ( Axbx3x?x )
            </div>
            <div class="buttonBox2">
                <button class="button color4" type="submit">Register</button>
                <a class="button color3" href="../logreg.php">Back</a>
            </div>
            <?php if (isset($_SESSION['message'])) { ?>
                <div>
                    <p class="sessmess1"><?php echo $_SESSION['message']; ?></p>
                    <?php unset($_SESSION['message']); ?>
                </div>
            <?php } else { ?>
                <div>
                    <p class="sessmess">No Messages</p>
                </div>
            <?php } ?>
        </form>

    </div>

    <script>
        window.onload = function() {
            //debugger;
            var password = document.getElementById("password");
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