<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link rel="stylesheet" href="adminorders.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</head>

<body style=" background: linear-gradient(to bottom, #996633 0%, #ffffff 100%);
  height: auto;">

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
    <h2 class="text-center my-4">Orders</h2>

    <?php
    $dsn = 'mysql:dbname=cafeteria;host=127.0.0.1;port=3306;';
    $user = 'root';
    $password = '';
    $conn = new PDO($dsn, $user, $password);
    $sql_user = 'SELECT o.order_id  , o.date as date, u.user_name as name
        , o.room, o.staus, o.total as total
            FROM orders o join users u  on o.user_id= u.user_id
             WHERE o.staus != "Delivered";
             ';
    $stmt_user = $conn->prepare($sql_user);
    $stmt_user->execute();
    $result_user = $stmt_user->fetchAll(PDO::FETCH_ASSOC);
    //var_dump($result_user);
    foreach ($result_user as $row_user) {
        echo '<div class="order" style="margin-left:280px; background-color:white;">';
        echo '<table class="table table-light table-bordered text-center">';
        echo '<tr>
                <th>Order Date</th>
                <th>Name</th>
                <th>Room</th>
                <th>Status</th>
                </tr>';
        echo '<tr>';
        echo '<td>' . $row_user['date'] . '</td>';
        echo '<td>' . $row_user['name'] . '</td>';
        echo '<td>' . $row_user['room'] . '</td>';
        echo '<td>' . $row_user['staus'] . '
              <form action="updatestatus.php" method="post">
              <select name="order" id="order" class="form-select" style="width:150px; margin-left:30px; margin-bottom:10px">
                  <option value="deliver">delivered</option>
              </select>' . '<input type="hidden" value=' . $row_user['order_id'] . '" name="id">'
            . '<input type="submit" class="btn btn-dark" value="update">'
            . '</form></td>';

        echo '</tr>';
        echo '</table>';

        $id = $row_user['order_id'];
        $sql_product = "SELECT p.product_name,op.amount,p.product_price,p.image
            from oproduct op join products p
                where op.order_id = $id
                and p.product_id=op.product_id
                ";
        $stmt_product = $conn->prepare($sql_product);
        $stmt_product->execute();
        $result_product = $stmt_product->fetchAll(PDO::FETCH_ASSOC);
        echo "<div class='row'>";
        foreach ($result_product as $row_product) {
            echo "<div class='col-3 text-center' style='font-size:20px'>" . "<p>" . $row_product['product_name'] . "</p>";
            echo "<img src='" . $row_product['image'] . "' style='height:180px; width:200px;'>";
            echo "AMOUNT: " . $row_product['amount'] . "<br>";
            echo "TOTAL PRICE: " . $row_product['amount'] * $row_product['product_price'];
            echo "</div>";
        }
        echo '</div>';
        echo '
            <div class="footer">
            <br>
                <span style="font-size:200%;">Total Price: EGP ';
        echo $row_user['total'];
        echo '</span>
            </div>';
        echo '</div>';
    }




    ?>
</body>

</html>