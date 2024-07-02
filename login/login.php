<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" type="image/x-icon" href="../img/favicon.ico">
    <link rel="stylesheet" href="../css/login.css">
</head>

<body>
    <div class="container">
        <div class="logobox">
            <div><img class="logo" src="../img/tth-logo-nb.png" alt="gdrive logo"></div>
            <div class="logotext">
                <h2>TreeTopHeights</h2>
                <h2>Login</h2>
            </div>
        </div>

        <form action="login_process.php" method="post">
            <div class="inLine"><label for="email">Email:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="inLine"><label for="password">Password:</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div class="buttonBox3">
                <button class="color2" type="submit">Login</button>
                <a class="button color1" href="../index.php">Back</a>
                <a class="button color4" href="forgot_password.php">Forgotten Password</a>
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