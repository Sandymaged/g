<?php


$dsn = 'mysql:dbname=cafeteria;host=127.0.0.1;port=3306;';
$user = 'root';
$password = '';
$db = new PDO($dsn, $user, $password);
$id = $_GET['id'];
$result = "DELETE FROM orders WHERE order_id=$id";
$result1 = "DELETE FROM oproduct WHERE order_id=$id";
$stmt = $db->prepare($result);
$stmt->execute();
$stmt = $db->prepare($result1);
$stmt->execute();
header('location:user orders.php');
