<?php
session_start();
if ($_SESSION['role'] == "user") {
    header("location: forbidden.html");
} else {
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


        <style>
            body {
                background: linear-gradient(to bottom, #996633 0%, #ffffff 100%);
                height: 750px;
                font-size: 150%;
            }

            .sp {
                margin-left: 40px;
            }
        </style>
    </head>

    <body>
        <header>
            <nav class="navbar navbar-expand-lg navbar-light" style="font-size: 20px;font-weight: bold;">
                <!-- container -->
                <a class="navbar-brand" href="#" style="margin-left: 30px; font-size: 25px;">ITI Cafeteria</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">

                        <li class="nav-item">
                            <a class="nav-link" href="allproducts.php">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="allusers.php">Users</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Manual Orders</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="check Admin page.php">Checks</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="orders.php">Orders</a>
                        </li>

                    </ul>
                    <div style="display:inline; margin-left:700px">

                        <div class="dropdown">
                            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                Admin </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="logout.php">Logout</a></li>

                            </ul>
                        </div>
                    </div>
                </div>
                <!-- ./container -->
            </nav>
        </header>
        <div class="container" style="font-size: 20px;">
            <h2 style="margin-top: 20px;" class="text-center">All Users</h2>
            <a href="users.php" style="float: right;background-color: lightgrey;font-size: 30px;">Add User</a>
            <?php

                $dsn = 'mysql:dbname=cafeteria;host=127.0.0.1;port=3306;'; #port number
                $user = 'root';
                $password = '';
                $db = new PDO($dsn, $user, $password);

                if ($db) {
                    $select_query = 'select * from users';

                    $stmt = $db->prepare($select_query);
                    $resobj = $stmt->execute();

                    echo "<table class='table table-light table-striped text-center'>
            <tr>
            <th scope='col'>Name</th>
             <th scope='col'>room</th>
             <th scope='col'>ext</th>
             <th scope='col'>Action</th>
             </tr> ";
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>
                        <td>{$row["user_name"]}</td> 
                         <td>{$row["user_room"]}</td>
                         <td>{$row["user_ext"]}</td>
                         <td><a href='edituser.php?id={$row["user_id"]}'>edit </a>,
                         <a href='deleteuser.php?id={$row["user_id"]}'>delete </a></td>      
                         </tr>";
                    }
                    echo "</table>";
                }
                ?>
        </div>

    <?php
    }
    ?>