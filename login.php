
<?php

session_start();

include "login_db.php";
if (isset($_POST['userName']) && isset($_POST['password'])) {
    //function to check validate data
    function checkValidation($data)
    {

        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);

        return $data;
    }
    $userName = checkValidation($_POST['userName']);
    $password = checkValidation($_POST['password']);

    if (empty($userName)) {
        header("location: indexlogin.php?error=User Name is required");
        exit();
    } elseif (empty($password)) {
        header("location: indexlogin.php?error=Password is required");
        exit();
    } else {
        $sql = "SELECT * FROM users WHERE user_name = '$userName' AND user_password='$password'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            // echo "Hello";
            $row = mysqli_fetch_assoc($result);

            // print_r($row);
            if ($row["user_name"] === $userName && $row["user_password"] === $password) {
                // echo " login !!!!!!!!!";
                $_SESSION['Name'] = $row['user_name'];
                $_SESSION['role'] = $row['role'];
                $_SESSION['id'] = $row['user_id'];
                if ($row["role"] == 'admin') {
                    header("location: index.php");
                } else {
                    header("location: indexuser.php");
                }
                exit();
            } else {
                header("location: indexlogin.php?error=Incorrect User name or password");
                exit();
            }
        } else {
            header("location: indexlogin.php?error=Incorrect User name or password");
            exit();
        }
    }
} else {
    header("location: indexlogin.php");
    exit();
}
