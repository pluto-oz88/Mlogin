<?php
session_start();
date_default_timezone_set('Australia/Brisbane');
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


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

    <script src="../js/modal.js"></script>

</head>

<body>

    <?php

    if (isset($_POST['email'], $_POST['mobile'], $_POST['password'])) {
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $password = trim($_POST['password']);



        if (isset($_POST['password'])) {
            $password = trim($_POST['password']);
        }

        function isValidPassword($pword)
        {
            $hasMinLength = strlen($pword) >= 8;
            $hasLowercase = preg_match('/[a-z]/', $pword);
            $hasUppercase = preg_match('/[A-Z]/', $pword);
            $hasNumber = preg_match('/\d/', $pword);
            $hasPunctuation = preg_match('/[!@#$%^&*(),.?":{}|<>]/', $pword);

            return $hasMinLength && $hasLowercase && $hasUppercase && $hasNumber && $hasPunctuation;
        }

        $sql_check_email = "SELECT * FROM users WHERE (email = ? or mobile = ?) and deleted = 0";
        $stmt_check_email = $conn->prepare($sql_check_email);
        $stmt_check_email->bind_param("ss", $email, $mobile);
        $stmt_check_email->execute();
        $result_check_email = $stmt_check_email->get_result();

        if ($result_check_email->num_rows > 0) {
            echo "This email address or mobile is already registered. Please use another email-mobile or login.";
        } else {

            if (!isValidPassword($password)) {
                echo "Invalid password. 1 Upper case, 1 lower case, 1 number and 1 punctuation character required";
            } else {

                $sql_check_email = "SELECT * FROM users WHERE (email = ? or mobile= ?) and deleted = 1";
                $stmt_check_email = $conn->prepare($sql_check_email);
                $stmt_check_email->bind_param("ss", $email, $mobile);
                $stmt_check_email->execute();
                $result_check_email = $stmt_check_email->get_result();

                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $token = bin2hex(random_bytes(32));
                $firstname = $_POST['firstname'];
                $lastname = $_POST['lastname'];

                $_SESSION['user_mobile'] = $mobile;
                $verified = 0;
                $deleted = 0;

                if ($result_check_email->num_rows == 0) {

                    $sql = "INSERT INTO users (email, firstname, lastname, mobile, verified, token, password, deleted) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                    $stmt = $conn->prepare($sql);

                    if ($stmt === false) {
                        printf("Error preparing statement: %s\n", $conn->error);
                        exit;
                    }

                    $stmt->bind_param("ssssissi", $email, $firstname, $lastname, $mobile, $verified, $token, $password, $deleted);
                    //$stmt->execute();

                    if ($stmt->execute()) {
                        echo "Record inserted successfully.";
                    } else {
                        echo "Error inserting record: " . $stmt->error;
                    }
                } else {
                    $row = $result_check_email->fetch_assoc();
                    $user_id = $row['id'];

                    $sql = "UPDATE users SET email = ?, firstname = ?, lastname = ?, mobile = ?, verified = ?, token = ?, password = ?, deleted = ? WHERE id = ?";

                    $stmt = $conn->prepare($sql);

                    if ($stmt === false) {
                        printf("Error preparing statement: %s\n", $conn->error);
                        exit;
                    }

                    $stmt->bind_param("ssssissii", $email, $firstname, $lastname, $mobile, $verified, $token, $password, $deleted, $user_id);


                    if ($stmt->execute()) {
                        echo "Record inserted successfully.";
                    } else {
                        echo "Error inserting record: " . $stmt->error;
                    }
                }

                // Send verification email
                $verificationLink = "https://" . $_SERVER['SERVER_NAME'] . "/login/verify.php?token=" . $token;
                $subject = "Email Verification";
                $message = "Please click the following link to verify your email address: " . $verificationLink;

                $sendTo1 = $email;
                $sendTo1n = '';
                $sendTo2 = '';
                $sendTo2n = '';

                require '../priv/t1.php';
                echo "<br>" . $error1;
                echo "<br>" . $error2;
                echo "Verification Sent. Please check your email";

                echo "<h5 style='text-align:center;'>Confirmation Email Sent</h5>";
            }
        }
    }
    ?>

</body>

</html>