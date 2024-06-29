<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0" />
  <title>Mlogin</title>
  <link rel="stylesheet" href="css/style.css" />
</head>

<body>

  <h1>TreeTopHeights Dashboard</h1>

  <?php if (isset($_SESSION['message'])) { ?>
    <div>
      <p class="sessmess1"><?php echo $_SESSION['message']; ?></p>
      <?php unset($_SESSION['message']); ?>
    </div>

  <?php } else { ?>
    <div>
      <p class="sessmess">No Messages</p>
    </div>
  <?php } ?>

  <div class="sessionv">
    <?php
    print_r($_SESSION);
    ?>
  </div>

  <?php if (isset($_SESSION['user_authenticated'])) { ?>

    <h1>logged in</h1>

    <p><a href="login/change_password.php">Change password</a></p>
    <p><a href="login/delete_account.php">Delete account</a></p>
    <p><a href="login/logout.php">Logout</a></p>
  <?php   } else {

  ?>
    <p><a href="login/login.php">Login</a></p>
    <p><a href="login/register.php">Register</a></p>

  <?php

  }
  ?>




</body>

</html>