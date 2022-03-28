<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style2.css">
</head>

<body>
    <form action="login.php" method="post">
        <h2>LOGIN</h2>
        <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>

        <?php } ?>
        <label for="userName">User Name</label>
        <input type="text" name="userName" placeholder="User Name">

        <label for="password">Password</label>
        <input type="Password" name="password" placeholder="Password">


        <button type="submit">Login</button><br><br>


    </form>

</body>

</html>