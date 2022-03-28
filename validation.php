<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
var_dump($_POST);
$errors = [];
$old = [];
$dsn = 'mysql:dbname=cafeteria;host=127.0.0.1;port=3306;'; #port number
$user = 'root';
$password = '';
$conn = new PDO($dsn, $user, $password);

if ($_POST["name"] == "") {
    $errors["empty_name"] = true;
} else {
    $old["name"] = $_POST["name"];
}
if ($_POST["price"] == "") {
    $errors["empty_price"] = true;
} else {
    $old["price"] = $_POST["price"];
}

if ($_POST["amount"] == "") {
    $errors["empty_amount"] = true;
} else {
    $old["amount"] = $_POST["amount"];
}
if (count($errors) > 0) {

    $errors_msg = json_encode($errors);
    $base = "?errors={$errors_msg}";
    if (count($old) > 0) {
        $old_val = json_encode($old);
        $base .= "&old={$old_val}";
    }

    header("Location:addproduct.php{$base}");
} else {

    $select_query = "select * from categories where category_name=? ";
    $stm = $conn->prepare($select_query);
    $cat = $_REQUEST["select"];
    $resobj = $stm->execute([$cat]);
    while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
        $catid1 = $row["id"];   //id llcat
    }
    // echo $file_name;
    try {
        if ($conn) {
            $ins_query = "insert into products(product_name, product_price,amount,category_id) values (:name, :price,:amount,:catid);";
            // $ins_query="insert into product(name, price,photo,categoryid) values ('uihui',778, 'hjjk',1);";

            $stmt = $conn->prepare($ins_query);
            $name = $_POST['name'];
            $price = $_POST['price'];
            $amount = $_POST['amount'];

            $catid = $catid1;

            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":price", $price);
            $stmt->bindParam(":amount", $amount);

            $stmt->bindParam(":catid", $catid);

            $stmt->execute();
            header("location:allproducts.php");
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
