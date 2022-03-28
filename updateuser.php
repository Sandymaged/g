<?php
$id = (int) $_GET["id"];
$dsn = 'mysql:dbname=cafeteria;host=127.0.0.1;port=3306;';
$user = 'root';
$password = '';
$db = new PDO($dsn, $user, $password);

if ($db) {

  $update_query = "update users set user_name=:name,user_room=:room,user_ext=:ext where user_id=:id";
  $stmt = $db->prepare($update_query);
  $name = $_REQUEST["name"];
  $room = $_REQUEST["room"];
  $id = $_REQUEST["id"];
  $ext = $_REQUEST["ext"];

  $stmt->bindParam(":name", $name);
  $stmt->bindParam(":room", $room);
  $stmt->bindParam(":id", $id);
  $stmt->bindParam(":ext", $ext);

  $res = $stmt->execute();

  header("location:allusers.php");
}
