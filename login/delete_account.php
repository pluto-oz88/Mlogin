<?php
session_start();

$firstName = $_SESSION['user_fName'];
$lastName = $_SESSION['user_lName'];


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>GDrive Del</title>
    <link rel="icon" type="image/x-icon" href="../img/favicon.ico">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="container">
        <div class="logobox">
            <div><img class="logo" src="../img/GDrive_logo.png" alt="gdrive logo"></div>
            <div class="logotext">
                <h1 class="upper">Delete</h1>
                <h1 class="lower">Account</h1>
            </div>
        </div>

        <form action="delete_account_process.php" method="post">
            <div class="inLine">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="inLine">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div class="buttonBox2">
                <button class="color12" type="submit">Delete Account</button>
                <a class="button color32" href="../index.php">Back</a>
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