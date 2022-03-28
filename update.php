<?php
$id = (int) $_GET["id"];
$dsn = 'mysql:dbname=cafeteria;host=127.0.0.1;port=3306;';
$user = 'root';
$password = '';
$db = new PDO($dsn, $user, $password);

var_dump($_GET);
var_dump($_POST);
//   $name_up=$_REQUEST["name"];
// $email_up=$_REQUEST["email"];
//  $password_up=$_REQUEST["password"];
// $filename_up=$_REQUEST["photo"];
if ($db) {

  $update_query = "update products set product_name=:name,product_price=:price,amount=:amount where product_id=:id";
  $stmt = $db->prepare($update_query);
  $name = $_REQUEST["name"];
  $price = $_REQUEST["price"];
  $id = $_REQUEST["id"];
  $amount = $_REQUEST["amount"];

  $stmt->bindParam(":name", $name);
  $stmt->bindParam(":price", $price);
  $stmt->bindParam(":id", $id);
  $stmt->bindParam(":amount", $amount);

  $res = $stmt->execute();
  move_uploaded_file($file_tmp, $file_name);

  header("location:allproducts.php");
}
