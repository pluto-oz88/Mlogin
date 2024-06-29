<?php
ini_set('session.cookie_secure', 1);
session_start();
ini_set('display_errors', 1);
//date_default_timezone_set('Australia/Brisbane');


function createIcsFile()
{
    // Example usage
    // $event_name = "GDrive Booking Journey No. 47";
    // $start_time = "2023-05-10T15:30:00.000+10:00";
    // $end_time = "2023-05-10T16:30:00.000+10:00";
    // $location = "Your Location";
    // $description = "Event details that show exactly what is happening in the world";
    echo  getenv('COMPUTERNAME') . '<br><br>';
    print_r($_SESSION);

    exit();


    $event_name = $_SESSION['event_name'];
    $start_time = $_SESSION['start_time'];
    $end_time =  $_SESSION['end_time'];
    $location =  $_SESSION['location'];
    $description =  $_SESSION['description'];
    $description = escapeString($description);

    $uid = uniqid();
    $now = date('Ymd\THis\Z');
    $start = date('Ymd\THis\Z', strtotime($start_time));
    $end = date('Ymd\THis\Z', strtotime($end_time));

    $icsContent = "BEGIN:VCALENDAR\r\n";
    $icsContent .= "VERSION:2.0\r\n";
    $icsContent .= "PRODID:-//Your Organization//NONSGML Your Application//EN\r\n";
    $icsContent .= "BEGIN:VEVENT\r\n";
    $icsContent .= "UID:{$uid}\r\n";
    $icsContent .= "DTSTAMP:{$now}\r\n";
    $icsContent .= "DTSTART:{$start}\r\n";
    $icsContent .= "DTEND:{$end}\r\n";
    $icsContent .= "LOCATION:{$location}\r\n";
    $icsContent .= "SUMMARY:{$event_name}\r\n";
    $icsContent .= "DESCRIPTION:{$description}\r\n";
    $icsContent .= "END:VEVENT\r\n";
    $icsContent .= "END:VCALENDAR\r\n";

    $fileName = "GDrive" . substr($event_name, strrpos($event_name, ' ') + 1) . ".ics";
    $_SESSION['icsfile'] = $fileName;

    header('Content-Type: text/calendar; charset=utf-8');
    header('Content-Disposition: attachment; filename="' . $fileName . '"');
    echo $icsContent;
}

function escapeString($string)
{
    $escapedString = '';
    $lines = explode("\n", $string);
    foreach ($lines as $line) {
        $line = str_replace(",", "\,", $line);
        $line = str_replace(";", "\;", $line);
        // Divide each line into 75 character long chunks and concatenate them with newline + space
        while (strlen($line) > 0) {
            $addSpace = (strlen($escapedString) > 0 ? ' ' : '');
            $escapedString .= $addSpace . substr($line, 0, 74);
            $line = substr($line, 74);
            if (strlen($line) > 0) {
                $escapedString .= "\n";
            }
        }
        $escapedString .= "\\n";
    }
    return rtrim($escapedString, "\\n"); // Remove trailing new line
}

// echo $_SESSION['event_name'];
// echo $_SESSION['start_time'];
// echo $_SESSION['end_time'];
// echo $_SESSION['location'];
// echo  $_SESSION['description'];
// echo escapeString($description);


createIcsFile();
