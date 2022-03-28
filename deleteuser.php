<?php
$dsn = 'mysql:dbname=cafeteria;host=127.0.0.1;port=3306;'; #port number
$user = 'root';
$password = '';
$db = new PDO($dsn, $user, $password);


if ($db) {
        $user_id = $_GET["id"];
        $ins_query = "delete from users where  user_id=?";
        $stmt = $db->prepare($ins_query);
        $res = $stmt->execute([$user_id]);
        //echo $res;    
        header("location:allusers.php");
}
