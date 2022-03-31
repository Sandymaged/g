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

<body>
    <h1>Orders</h1>

    <?php
    $dsn = 'mysql:dbname=cafeteria;host=127.0.0.1;port=3306;';
    $user = 'root';
    $password = '';
    $conn = new PDO($dsn, $user, $password);
    $sql_user = 'SELECT o.order_id  , o.date as date,o.tea,o.soft,o.coffe,o.french , u.user_name as name
        , o.room, o.staus, o.total as total
            FROM orders o join users u  on o.user_id= u.user_id
             WHERE o.staus != "Delivered";
             ';
    $stmt_user = $conn->prepare($sql_user);
    $stmt_user->execute();
    $result_user = $stmt_user->fetchAll(PDO::FETCH_ASSOC);
    // var_dump($result_user);
    foreach ($result_user as $row_user) {
        echo '<div class="order">';
        echo '<div class="header">';
        echo '<table class="table table-dark table-bordered text-center">';
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
        <select name="order" id="order">
          <option value="deliver">delivered</option>
        </select>' . '<input type="hidden" value=' . $row_user['order_id'] . '" name="id">'
            . '<input type="submit" value="update">'
            . '</form></td>';
        echo '</tr>';
        echo '</table>';
        echo '</div>';
        echo '<div class="body">';
        $sql_product = "SELECT * from products ";
        $stmt_product = $conn->prepare($sql_product);
        $stmt_product->execute();
        $result_product = $stmt_product->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result_product as $row_product) {
            if ($row_user['tea'] > 0 && $row_product['product_name'] = 'tea') {
                echo "<img style='max-width:100px;max-height: 100px;min-width:100px;min-height: 100px' src='" . $row_product["image"] . "'>";
                echo " number of tea: " . $row_user['tea'] . "<br>" . "  Total: " . $row_user['tea'] * 7 . "<br>";
            }

            if ($row_user['coffe'] > 0 && $row_product['product_name'] = 'coffe') {
                echo "<img style='max-width:100px;max-height: 100px;min-width:100px;min-height: 100px' src='" . $row_product["image"] . "'>";
                echo " number of coffe: " . $row_user['coffe'] . "<br>" . "  Total: " . $row_user['coffe'] * 20 . "<br>";
            }
            if ($row_user['soft'] > 0 && $row_product['product_name'] = 'soft') {

                echo "<img style='max-width:100px;max-height: 100px;min-width:100px;min-height: 100px' src='" . $row_product["image"] . "'>";
                echo " number of soft drink: " . $row_user['soft'] . "<br>" . "  Total: " . $row_user['soft'] * 7 . "<br>";
            }
            if ($row_user['french'] > 0 && $row_product['product_name'] = 'french') {
                echo "<img style='max-width:100px;max-height: 100px;min-width:100px;min-height: 100px' src='" . $row_product["image"] . "'>";
                echo "number of french: " . $row_user['french'] . "<br>" . "  Total: " . $row_user['french'] * 30 . "<br>";
            }
        }
        echo '</div>
                <div class="footer">
                    <span style="font-size:200%  ; color:red">Total Price: EGP ';
        echo $row_user['total'];
        echo '</span>
                </div>';
        echo '</div>';
    }


    ?>


</body>

</html>