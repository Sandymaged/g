<?php
$dsn = 'mysql:dbname=cafeteria;host=127.0.0.1;port=3306;';
$user = 'root';
$password = '';
$db = new PDO($dsn, $user, $password);
$x = (int) $_POST['total'];
$z = (int) $_POST['room'];
$y = $_POST['note'];
$n = $_POST['s'];
$d = date("Y/m/d");
$in = "insert into orders(total,note,room,user_id,date,staus)values({$x},'{$y}','{$z}','{$n}','{$d}','processing')";
$stmt = $db->prepare($in);
$stmt->execute();
$last_id = $db->lastInsertId();

session_start();
var_dump($_SESSION['c']);
if (!empty($_SESSION['c'])) {
    foreach ($_SESSION['c'] as $key => $value) {
        $ins = "insert into oproduct(product_id,order_id,amount)values({$value['id']},{$last_id},{$value['amount']})";
        $up = "update products p set p.amount=p.amount-{$value['amount']} where p.product_id={$value['id']}";

        $stmt = $db->prepare($ins);
        $stmt->execute();
        $stm = $db->prepare($up);
        $stm->execute();
    }
}
//session_destroy();
unset($_SESSION['c']);
header("location:index.php?error=HI, ORDER ADDED PLEASE WAIT, WILL RESEVE IN 10MIN");
