<?php
$dsn = 'mysql:dbname=cafeteria;host=127.0.0.1;port=3306;';
$user = 'root';
$password = '';
$db = new PDO($dsn, $user, $password);

$x = (int) $_POST['total'];
$z = (int) $_POST['room'];
$y = $_POST['note'];
$d = date("Y/m/d");
$id = $_POST['id'];
$in = "insert into orders(total,note,room,user_id,date,staus)values({$x},'{$y}','{$z}',{$id},'{$d}','processing')";
$stmt = $db->prepare($in);
$stmt->execute();
$last_id = $db->lastInsertId();
session_start();

//var_dump($_SESSION['ca']);
if (!empty($_SESSION['ca'])) {
    foreach ($_SESSION['ca'] as $key => $value) {
        $ins = "insert into oproduct(product_id,order_id,amount)values({$value['id']},{$last_id},{$value['amount']})";
        $up = "update products p set p.amount=p.amount-{$value['amount']} where p.product_id={$value['id']}";

        $stmt = $db->prepare($ins);
        $stmt->execute();
        $stm = $db->prepare($up);
        $stm->execute();
    }
}




//session_destroy();
unset($_SESSION['ca']);
header("location:indexuser.php?error=HI, ORDER ADDED PLEASE WAIT, WILL RESEVE IN 10MIN");


/*$up1 = "update products set amount=amount-{$t} where {$t}>0 && product_name='tea'";
$up2 = "update products set amount=amount-{$c} where {$c}>0 && product_name='coffe'";
$up3 = "update products set amount=amount-{$soft} where {$soft}>0 && product_name='soft drink'";
$up4 = "update products set amount=amount-{$f} where {$f}>0 && product_name='french coffe'";

$stmt = $db->prepare($up1);
$stmt->execute();

$stmt = $db->prepare($up2);
$stmt->execute();

$stmt = $db->prepare($up3);
$stmt->execute();

$stmt = $db->prepare($up4);
$stmt->execute();
header("location:indexuser.php");
*/
