<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GDrive R-Trip</title>
    <link rel="icon" type="image/x-icon" href="../img/favicon.ico">
    <link rel="stylesheet" href="../css/style.css">
    <script defer src="../js/number.js"></script>
</head>

<body>
    <div class="container">
        <div class="logobox">
            <div><img class="logo" src="../img/GDrive_logo.png" alt="gdrive logo"></div>
            <div class="logotext">
                <h1 class="upper">Enter</h1>
                <h1 class="lower">Details</h1>
            </div>
        </div>

        <form action="unregtrip_process.php" method="post">
            <div class="inLine"><label for="fname">Name:</label>
                <input type="text" name="fname" id="fname" required>
            </div>
            <div class="inLine"><label for="mobile">Mobile:&nbsp;&nbsp;&nbsp;</label>
                <input type="tel" name="mobile" id="mobile" placeholder="Include country code(+xx)" required>
            </div>
            <div class="pStatus">
                <p id="text1">&nbsp;</p>
                <p id="text2"></p>
            </div>
            <div class="inLine"><label for="email">Email:&nbsp;&nbsp;&nbsp;&nbsp;</label>
                <input type="email" name="email" id="email" required>
            </div>

            <div class="buttonBox2">
                <button class="color12" type="submit">Proceed<br>to Map</button>
                <a class="button color32" href="javascript:history.go(-1)">Back</a>
            </div>
        </form>

    </div>

</body>

</html>