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
    <title>GDrive ChangePW</title>
    <link rel="icon" type="image/x-icon" href="../img/favicon.ico">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/modal.js"></script>
</head>

<body>
    <div class="container">
        <?php
        $email = $_POST['email'];
        $current_password = $_POST['current_password'];

        if (isset($_POST['new_password'])) {
            $new_password = trim($_POST['new_password']);
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

        if (!isValidPassword($_POST['new_password'])) {
            echo '<script>
            messageModal("change_password.php", "Invalid password. 1 Upper case, 1 lower case, 1 number and 1 punctuation character required");
            </script>';
        } else {

            $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

            $sql = "SELECT * FROM users WHERE email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if (password_verify($current_password, $row['password'])) {
                    $sql_update = "UPDATE users SET password = ? WHERE email = ?";
                    $stmt_update = $conn->prepare($sql_update);
                    $stmt_update->bind_param("ss", $new_password, $email);
                    $stmt_update->execute();

                    echo "Password successfully changed...";
                } else {
                    echo "Incorrect password. Try again...";
                }
            } else {
                echo "Email address not found. Try again...";
            }
        }
        ?>

    </div>
</body>

</html>