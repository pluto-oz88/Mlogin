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

    <title>GDrive Del</title>
    <link rel="icon" type="image/x-icon" href="../img/favicon.ico">
    <link rel="stylesheet" href="../css/style.css">
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
                <a class="button color32" href="../mdashboard.php">Back</a>
            </div>
        </form>
    </div>
</body>

</html>