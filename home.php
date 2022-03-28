<?php

session_start();

if (isset($_SESSION['id']) && isset($_SESSION['Name'])) {


?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>Home</title>
        <link rel="stylesheet" href="style.css">

    </head>

    <body>
        <h1>Hello , <?php echo $_SESSION['Name']; ?></h1><br>
        <a href="logout.php" class="logout">logout</a>
    </body>

    </html>

<?php
} else {
    header("location: index.php");
    exit();
}

?>