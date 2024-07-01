<?php
session_start();

require "db.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>GDrive Login</title>
    <link rel="icon" type="image/x-icon" href="../img/favicon.ico">
    <link rel="stylesheet" href="../../css/style.css">
</head>

<body>
    <div class="container">

        <?php

        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE email = ? AND verified > 0 AND deleted = 0";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                $_SESSION['user_authenticated'] = true;
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user_email'] = $row['email'];
                $_SESSION['user_fName'] = $row['firstname'];
                $_SESSION['user_lName'] = $row['lastname'];
                $_SESSION['user_mobile'] = $row['mobile'];

                // Update the last_login timestamp
                $sql_update = "UPDATE users SET last_login = NOW() WHERE email = ?";
                $stmt_update = $conn->prepare($sql_update);
                $stmt_update->bind_param("s", $email);
                $stmt_update->execute();

                header("Location: ../index.php");
                $_SESSION["message"] = "Successfully logged in";
                exit();
            } else {
                header("Location: login.php");
                $_SESSION["message"] = "Email/Password not found. Try again";
                exit();
            }
        } else {
            header("Location: login.php");
            $_SESSION["message"] = "Email/Password not found. Try again";
            exit();
        }
        ?>

    </div>

</body>

</html>