<?php
session_start();

require "db.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GDrive Reset</title>
    <link rel="icon" type="image/x-icon" href="/img/favicon.ico">
    <link rel="stylesheet" href="../css/login.css">
</head>

<body>
    <div class="container">
        <?php

        function isValidPassword($pword)
        {
            $hasMinLength = strlen($pword) >= 8;
            $hasLowercase = preg_match('/[a-z]/', $pword);
            $hasUppercase = preg_match('/[A-Z]/', $pword);
            $hasNumber = preg_match('/\d/', $pword);
            $hasPunctuation = preg_match('/[!@#$%^&*(),.?":{}|<>]/', $pword);

            return $hasMinLength && $hasLowercase && $hasUppercase && $hasNumber && $hasPunctuation;
        }

        $token = $_POST['token'];

        $_SESSION['token'] = $token;

        $new_password = trim($_POST['password']);

        if (!isValidPassword($new_password)) {

            header("Location: reset_password.php");
            $_SESSION["message"] = "Invalid password. 1 Upper case, 1 lower case, 1 number and 1 punctuation character required";
            exit();
        } else {

            $new_password = password_hash($new_password, PASSWORD_DEFAULT);

            $sql = "SELECT * FROM password_reset_tokens WHERE token = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $token);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $user_id = $row['user_id'];
                $expires_at = $row['expires_at'];

                if (strtotime($expires_at) > time()) {
                    $sql_update = "UPDATE users SET password = ? WHERE id = ?";
                    $stmt_update = $conn->prepare($sql_update);
                    $stmt_update->bind_param("si", $new_password, $user_id);
                    $stmt_update->execute();

                    $sql_delete = "DELETE FROM password_reset_tokens WHERE token = ?";
                    $stmt_delete = $conn->prepare($sql_delete);
                    $stmt_delete->bind_param("s", $token);
                    $stmt_delete->execute();

                    header("Location: ../index.php");
                    unset($_SESSION['token']);
                    $_SESSION["message"] = "Your password has been successfully reset.";

                    exit();
                } else {
                    header("Location: ../index.php");
                    $_SESSION["message"] = "This password reset link has expired. Please redo";
                    exit();
                }
            } else {
                header("Location: ../index.php");
                $_SESSION["message"] = "Invalid password reset token. Please redo";
                exit();
            }
        }
        ?>
    </div>
</body>

</html>