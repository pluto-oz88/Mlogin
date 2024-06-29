<?php
session_start();
date_default_timezone_set('Australia/Brisbane');


if (isset($_SESSION['confirmed'])) {
    if ($_SESSION['confirmed']) {
        echo "CONFIRMED: " . $_SESSION['confirmed'];
        $string = $_SESSION['user_fName'];

        if ($_SESSION['user_id'] === 0) {
            header("Location: ../guest.php");
            //echo 'guest.php';
            exit();
        } else {
            header("Location: ../mdashboard.php");
            //echo 'mdashboard.php';
            exit();
        }
    }
}

require "../ics/create-ics.php";

if (!isset($_SESSION['user_authenticated']) || !$_SESSION['user_authenticated']) {
    // Redirect to the login page if the user is not authenticated
    header("Location: login.php");
    exit();
}

$firstName = $_SESSION['user_fName'];
$lastName = $_SESSION['user_lName'];
$email = $_SESSION['user_email'];
$mobile = $_SESSION['user_mobile'];
$journeyNo = $_SESSION['journeyNo'];
$userId = $_SESSION['user_id'];
$message = $_SESSION['tbvar'];

echo '<pre>';
var_dump($_SESSION);
echo '</pre>';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GDrive Confirm</title>
    <link rel="icon" type="image/x-icon" href="../img/favicon.ico">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,400;0,500;0,700;0,800;0,900;1,100;1,600&display=swap");
    </style>
</head>

<body style="font-family: 'Montserrat', sans-serif; font-weight: 700; font-size: 1em;">

    <div style=" width: 100%;max-width: 390px;min-width: 320px;margin: 0;padding: 10px;color: #314455; background-color: white;box-shadow: 12px 12px 20px rgba(0, 0, 0, 0.5);border-radius: 4px; overflow: hidden;">
        <?php
        echo '<div id="echobeach">';
        $journeyNo = (int) $_SESSION['journeyNo'];
        echo "<p>Journey No.: " . $journeyNo . "</p>";
        echo  "<p>Event Name : " . $_SESSION['event_name'] . "</p>";


        // SET SESSION VARIABLES FOR ICS

        $duration = "83 minutes"; // Assuming the duration is in the format "83 minutes"

        // Extract the numeric value from the duration string using regular expressions
        preg_match('/\d+/', $duration, $matches);
        $duration_minutes = intval($matches[0]); // Convert the matched value to an integer

        // Rest of the code to calculate the end time
        // $start_time = new DateTime("20231230" . "T" . "102200" . ".000+10:00");
        $start_time = new DateTime("16010101T000000");
        $end_time = clone $start_time;
        $end_time->add(new DateInterval('PT' . $duration_minutes . 'M'));

        $formatted_end_time = $end_time->format('Y-m-d\TH:i:s.000P');

        $_SESSION['event_name'] = "GDrive Booking - Journey No. "  . $journeyNo;
        $_SESSION['start_time'] = 25;
        $_SESSION['duration'] = 34;
        $_SESSION['location'] = 'dogfoot';
        $_SESSION['description'] = 'Booking for morons';
        $journeyNo = $_SESSION['journeyNo'];

        echo "</div>";

        create_ics();

        $icsFile = 'icscurrent.ics';
        $icsName = "GDriveT" . $journeyNo . ".ics";

        //$email = $email . ", driver@gdrive.au";
        $subject = "GDrive Trip " . $journeyNo . " Confirmation";

        $sendTo1 = $email;
        $sendTo1n = '';
        $sendTo2 = 'driver@gdrive.au';
        $sendTo2n = 'driver';

        require '../t2.php';
        echo "<br>" . $error1;
        echo "<br>" . $error2;

        if (!$error1 || !$error2) {
            echo "<h5 style='text-align:center;'>Confirmation Email Sent</h5>";
            $_SESSION['confirmed'] = 1;

            $string = $_SESSION['user_fName'];
            $substring = "CASUAL";
            $fsix = substr($string, 0, 6);
            if ($fsix === $substring) {
                $_SESSION['visitor'] = 'guest';
            } else {
                $_SESSION['visitor'] = 'member';
            }
        } else {
            echo "Problem - Not confirmed";
            echo "<br>Email :" . $email;
            echo "<br>Subject :" . $subject;
            echo "<br>Headers :" . $headers;
            echo "<br>Message: " . $message;
            exit();
        }
        ob_end_flush();

        ?>
    </div>
    <div class="container">
        <div class="logobox">
            <div>
                <img class="logo" src="/img/GDrive_logo.png" alt="gdrive logo" />
            </div>
            <div class="logotext">
                <h1 class="upper">Logged in</h1>
                <h1 class="lower">to Gdrive</h1>
            </div>
        </div>
        <div class="blurb">
            <p>
                Your trip has been submitted and you have been sent a confirmation email. To save your
                ride to your calendar click on the link below.<br>Thank you for using GDrive.
            </p>
        </div>

        <div class="buttonBox2">
            <!-- <a class="button color12" href="../ics/download-ics.php">Save to Calendar</a> -->
            <a class="button colorB" href="../plantrip.php">Plan New Journey</a>

            <?php
            if ($userId == 0) {
                $_SESSION['user_authenticated'] = false;
            }
            ?>
            <a class="button color32" href="../mdashboard.php">Back to Menu</a>
        </div>
        <div class="motto">
            <span class="mottotext">GDrive - Online and on Time<span>
        </div>
    </div>



</body>

</html>