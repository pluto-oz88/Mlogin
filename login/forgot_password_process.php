<?php
session_start();

require "db.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>GDrive Forget</title>
    <link rel="icon" type="image/x-icon" href="../img/favicon.ico">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="container">
        <?php

        $email = $_POST['email'];

        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $user_id = $row['id'];
            $token = bin2hex(random_bytes(32));
            $expires_at = date("Y-m-d H:i:s", strtotime("+1 hour"));

            $sql_insert = "INSERT INTO password_reset_tokens (user_id, token, expires_at) VALUES (?, ?, ?)";
            $stmt_insert = $conn->prepare($sql_insert);
            $stmt_insert->bind_param("iss", $user_id, $token, $expires_at);
            $stmt_insert->execute();

            // Send password reset email
            $resetLink = "http://" . $_SERVER['SERVER_NAME'] . "/login/reset_password.php?token=" . $token;
            $subject = "Password Reset";
            $message = "Please click the following link to reset your password: " . $resetLink;

            $sendTo1 = $email;
            $sendTo1n = '';
            $sendTo2 = '';
            $sendTo2n = '';

            require '../priv/t1.php';
            echo "<br>" . $error1;
            echo "<br>" . $error2;

            if (!$error1 || !$error2) {

                if (mail($email, $subject, $message, $headers)) {
                    echo "A password reset link has been sent to your email address. Please check your inbox and click the link to reset your password.";
                } else {
                    echo "Error sending email. Please try again later.";
                }
            }
        } else {
            echo "Email address not found. Try again...";
        }
        ?>



    </div>
</body>

</html>