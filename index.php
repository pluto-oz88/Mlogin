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

  <div class="container">

    <?php if (isset($_SESSION['user_authenticated'])) { ?>

      <div class="logobox">
        <div><img class="logo" src="../img/tth-logo-nb.png" alt="gdrive logo"></div>
        <div class="logotext">
          <h2>TreeTopHeights</h2>
          <h2>Logged In</h2>
        </div>

      </div>



      <div class="users">
        <p class="user"><?php echo $_SESSION['user_fName'] . " " . $_SESSION['user_lName']; ?></p>
        <p class="user"><?php echo $_SESSION['user_email']; ?></p>
        <p class="user"><?php echo $_SESSION['user_mobile']; ?></p>
      </div>

      <div class="buttonBox4">
        <a class="button color1" href="login/change_password.php">Change password</a>
        <a class="button color4" href="login/delete_account.php">Delete account</a>
        <a class="button color3" href="page1.php">Continue to site</a>
        <a class="button color2" href="login/logout.php">Logout</a>

      </div>
    <?php   } else {

      // session_unset();
    ?>
      <div class="logobox">
        <div><img class="logo" src="../img/tth-logo-nb.png" alt="gdrive logo"></div>
        <div class="logotext">
          <h2>TreeTopHeights</h2>
          <h2>Members</h2>
        </div>
      </div>
      <hr>
      <p>You will need to register if you want to take advantage of special offers available on the island including motor bike rentals, diving and snorkelling offers, restaurant deals and beach club access</p>
      <hr>
      <div class="buttonBox3">
        <a class="button color1" href="login/login.php">Login</a>
        <a class="button color4" href="login/register.php">Register</a>
        <a class="button color3" href="../page1.php">Continue to site</a>
      </div>
    <?php
    }
    ?>

    <div class="sessionv">
      <?php
      print_r($_SESSION);
      ?>
    </div>

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

  </div>


</body>

</html>