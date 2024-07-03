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
    <title>GDrive Verify</title>
    <link rel="icon" type="image/x-icon" href="../img/favicon.ico">
    <link rel="stylesheet" href="../css/login.css">
</head>

<body>
    <div class="container">
        <?php
        if (isset($_GET['token'])) {
            $token = $_GET['token'];

            $sql = "SELECT * FROM users WHERE token = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $token);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if ($row['verified'] == 0) {
                    $sql_update = "UPDATE users SET verified = 1, token = '' WHERE token = ?";
                    $stmt_update = $conn->prepare($sql_update);
                    $stmt_update->bind_param("s", $token);
                    $stmt_update->execute();
                    // echo "Your email address has been verified. <a class="button" href='login.php'>Login</a>.";

                    header("Location: ../logreg.php");
                    $_SESSION["message"] = "Your email has been verified...";
                    exit();
                } else {
                    header("Location: ../logreg.php");
                    $_SESSION["message"] = "Your email is already verified...";
                    exit();
                }
            } else {
                header("Location: ../logreg.php");
                $_SESSION["message"] = "Invalid token. Your email cannot be verified.";
                exit();
            }
        } else {
            header("Location: ../logreg.php");
            $_SESSION["message"] = "Token not found. Your email cannot be verified.";
            exit();
        }
        ?>
    </div>

</body>

</html>