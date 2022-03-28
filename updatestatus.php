 <?php
    $dsn = 'mysql:dbname=cafeteria;host=127.0.0.1;port=3306;';
    $user = 'root';
    $password = '';
    $conn = new PDO($dsn, $user, $password);
    $status = $_POST["order"];
    $id = $_POST["id"];
    //var_dump($status);
    //    var_dump($id);
    $sql_user = "UPDATE orders SET staus = '{$status}' where order_id='{$id}'";
    $stmt_user = $conn->prepare($sql_user);
    $stmt_user->execute();
    header("location:orders.php");

    ?>