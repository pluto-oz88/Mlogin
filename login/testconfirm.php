<?php
ini_set('session.cookie_secure', 1);
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set('Australia/Brisbane');


$_SESSION['journeyNo'] = 357;

$_SESSION['user_authenticated'] = true;
$_SESSION['user_id'] = 0;
$_SESSION['user_email'] = 'gdunsby@gmail.com';
$_SESSION['user_fName'] = "CASUAL - ";
$_SESSION['user_lName'] = 'Fred Smith';
$_SESSION['user_mobile'] = '+6146747416';
$_SESSION['confirmed'] = 0;

echo '<pre>';
var_dump($_SESSION);
echo '</pre>';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php
    echo '<br>confirmed: ' . $_SESSION['confirmed'];
    echo '<br>user_fName: ' . $_SESSION['user_fName'];
    echo '<br>user_authenticated: ' . $_SESSION['user_authenticated'];
    echo '<br>user_lName: ' . $_SESSION['user_lName'];
    echo '<br>user_id: ' . $_SESSION['user_id'];
    echo '<br>user_email: ' . $_SESSION['user_email'];
    echo '<br>user_mobile: ' . $_SESSION['user_mobile'];
    echo '<br>journeyNo: ' . $_SESSION['journeyNo'];
    echo '<br>';

    ?>

    <a href="confirmtrip.php"><br>Confirm Trip</a>

</body>

</html>