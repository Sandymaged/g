<?php
$errors = [];
$old = [];

$dsn = 'mysql:dbname=cafeteria;host=127.0.0.1;port=3306;'; #port number
$user = 'root';
$password = '';
$db = new PDO($dsn, $user, $password);

if ($_POST["email"] == "" && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors["empty_email"] = true;
} else {
    $old["email"] = $_POST["email"];
}
if ($_POST["password"] !== $_POST["password2"]) {
    $errors["empty_pass"] = true;
} else {
    $old["password"] = $_POST["password"];
}
if ($_POST["password2"] == "") {
    $errors["empty_pass2"] = true;
} else {
    $old["password2"] = $_POST["password2"];
}
if ($_POST["password"] == "") {
    $errors["empty_pass"] = true;
} else {
    $old["password"] = $_POST["password"];
}
if (count($errors) > 0) {

    $errors_msg = json_encode($errors);
    $base = "?errors={$errors_msg}";
    if (count($old) > 0) {
        $old_val = json_encode($old);
        $base .= "&old={$old_val}";
    }

    header("Location:users.php{$base}");
} else {
    if ($db) {
        $ins_query = "insert into users(user_name, user_email,user_password,user_room,user_ext) values (?,?,?,?,?);";
        $stmt = $db->prepare($ins_query);
        $name = $_REQUEST["name"];
        $email = $_REQUEST["email"];
        $passwrd = $_REQUEST["password"];
        $room = $_REQUEST["room"];
        $ext = $_REQUEST["ext"];
        $res = $stmt->execute([$name, $email, $passwrd, $room, $ext]);
        header("location:allusers.php");
    }
}
