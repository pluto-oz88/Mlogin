<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GDrive Del</title>
    <link rel="icon" type="image/x-icon" href="../img/favicon.ico">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="container">
        <?php

        require "db.php";

        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE email = ? AND deleted = 0";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                //$sql_delete = "UPDATE users SET deleted = 1 WHERE email = ?";
                $sql_delete = "UPDATE users SET deleted = 1, verified = 0, token = '', password = '' WHERE email = ?";
                $stmt_delete = $conn->prepare($sql_delete);
                $stmt_delete->bind_param("s", $email);
                $stmt_delete->execute();

                echo "Account closed...";
                header("Location: ../index.php");
                session_unset();
                $_SESSION["message"] = "Account deleted";
                exit();
            } else {
                header("Location: delete_account.php");
                $_SESSION["message"] = "Wrong password. Try again...";
                exit();
            }
        } else {
            header("Location: delete_account.php");
            $_SESSION["message"] = "Wrong password. Try again...";
            exit();
        }
        ?>

    </div>
</body>

</html>