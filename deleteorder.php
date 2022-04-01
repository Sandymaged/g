<?php

$id = $_GET['id'];

$hostName = 'localhost';
$userName = 'root';
$dbName = 'ajax';
$password = '';
// $id = $_GET['key'];

$conn = mysqli_connect($hostName, $userName, $password, $dbName);

$result = $conn->query("DELETE FROM orders WHERE order_id=$id");

header('location:user orders.php');
