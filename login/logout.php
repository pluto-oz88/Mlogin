<?php
session_start();

if (!isset($_SESSION['user_authenticated']) || !$_SESSION['user_authenticated']) {
    // Redirect to the login page if the user is not authenticated
    header("Location: login.php");
    exit();
}

$firstName = $_SESSION['user_fName'];
$lastName = $_SESSION['user_lName'];

// remove all session variables
session_unset();

// destroy the session
session_destroy();

// Redirect to the login page or another desired location
header("Location: ../index.php");
exit();
