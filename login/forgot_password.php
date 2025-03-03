<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GDrive Forgot</title>
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

        <form action="forgot_password_process.php" method="post">
            <div class="inLine">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="buttonBox2">
                <button class="color1" type="submit">Send Password<br>Reset Link</button>
                <a class="button color3" href="login.php">Back</a>
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


</body>

</html>