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
        .error {
            color: #FF0000;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <!-- container -->
            <a class="navbar-brand" href="#" style="margin-left: 30px;">ITI Cafeteria</a>
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
                        <a class="nav-link" href="#">Checks</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="orders.php">Orders</a>
                    </li>

                </ul>
                <div style="display:inline; margin-left:700px">

                    <div class="dropdown">
                        <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            Admin </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="#">Logout</a></li>

                        </ul>
                    </div>
                </div>
            </div>
            <!-- ./container -->
        </nav>
    </header>
    <div class="container">
        <h2 style="margin-top: 20px;">All Products</h2>
        <a href="addproduct.php" style="float: right;">Add product</a>
        <?php

        $dsn = 'mysql:dbname=cafeteria;host=127.0.0.1;port=3306;'; #port number
        $user = 'root';
        $password = '';
        $db = new PDO($dsn, $user, $password);

        if ($db) {
            $select_query = 'select * from products';

            $stmt = $db->prepare($select_query);
            $resobj = $stmt->execute();

            echo "<table class='table'> 
            <tr>
            <th scope='col'>product</th>
             <th scope='col'>price</th>
             <th scope='col'>Action</th>
             <th scope='col'>available or not</th>
             </tr> ";
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if ($row["amount"] > 0) {
                    $rowaction = "available";
                } else {
                    $rowaction = "unavilable";
                }
                echo "<tr>
                        <td>{$row["product_name"]}</td> 
                        <td>{$row["product_price"]}</td>
                       
                        <td><a href='edit.php?id={$row["product_id"]}'>edit </a>,
                        <a href='delete.php?id={$row["product_id"]}'>delete </a>
                        <td > {$rowaction}</td>
                        </td></tr>";
            }
            echo "</table>";
        }
        ?>
    </div>