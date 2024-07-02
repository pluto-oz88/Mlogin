<?php session_start();

if (isset($_GET['token'])) {
    $token = $_GET['token'];
} else {
    $token = $_SESSION['token'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="icon" type="image/x-icon" href="../img/favicon.ico">
    <link rel="stylesheet" href="../css/login.css">
</head>

<body>
    <div class="container">
        <div class="logobox">
            <div><img class="logo" src="../img/tth-logo-nb.png" alt="gdrive logo"></div>
            <div class="logotext">
                <h2>TreeTopHeights</h2>
                <h2>Reset Password</h2>
            </div>
        </div>

        <form action="reset_password_process.php" method="post">
            <input type="hidden" name="token" value="<?php echo $token; ?>">
            <div class="inLine"><label for="password">Password:</label>
                <input type="password" name="password" id="password" required>
                <input type="checkbox" id="check"> Show
            </div>
            <div class="inLine"><label for="password2">Confirm Password:</label>
                <input type="password" name="password2" id="password2" required>
                <input type="checkbox" id="confirm_check"> Show
            </div>
            <div class="password">
                8 characters minimum. 1 UPPER CASE, 1 lower case, 1 Number and 1&nbsp;Punctuation. Example ( Axbx3x?x )
            </div>

            <div class="buttonBox2">
                <button class="color1" type="submit">Reset Password</button>
                <a class="button color3" href="../index.php">Back</a>
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