<?php
ini_set('session.cookie_secure', 1);
session_start();
ini_set('display_errors', 1);
//date_default_timezone_set('Australia/Brisbane');

require "db.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="icon" type="image/x-icon" href="../img/favicon.ico">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

    <?php

    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $fname = $_POST['fname'];


    $_SESSION['user_authenticated'] = true;
    $_SESSION['user_id'] = 0;
    $_SESSION['user_email'] = $email;
    $_SESSION['user_fName'] = "CASUAL - ";
    $_SESSION['user_lName'] = $fname;
    $_SESSION['user_mobile'] = $mobile;
    $_SESSION['confirmed'] = 0;

    header("Location: ../plantrip.php");
    exit();


    ?>

</body>

</html>