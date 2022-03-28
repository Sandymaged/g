<?php
$dsn = 'mysql:dbname=cafeteria;host=127.0.0.1;port=3306;'; #port number
$user = 'root';
$password = '';
$db = new PDO($dsn, $user, $password);


if ($db) {
        $product_id = $_GET["id"];
        $ins_query = "delete from products where  product_id=?";
        $stmt = $db->prepare($ins_query);
        $res = $stmt->execute([$product_id]);
        //echo $res;    
        header("location:allproducts.php");
}
