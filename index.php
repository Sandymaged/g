<?php
session_start();
if (isset($_POST['addtocard'])) {
    if (isset($_SESSION['c'])) {
        $array_id = array_column($_SESSION['c'], "id");

        if (!in_array($_GET['id'], $array_id)) {
            $session_array = array(
                'id' => $_GET['id'],
                'name' => $_POST['product_name'],
                'price' => $_POST['product_price'],
                'amount' => $_POST['count'],
            );
            $_SESSION['c'][] = $session_array;
        }
    } else {
        $session_array = array(
            'id' => $_GET['id'],
            'name' => $_POST['product_name'],
            'price' => $_POST['product_price'],
            'amount' => $_POST['count'],
        );
        $_SESSION['c'][] = $session_array;
    }
}
//session_destroy();
if ($_SESSION['role'] == "user") {
    header("location: forbidden.html");
} else {
    ?>
    <html>

    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <style>
            body {
                background: linear-gradient(to bottom, #996633 0%, #ffffff 100%);
                height: auto;
                color: white;
            }

            .sp {
                margin-left: 40px;
            }
        </style>
    </head>

    <body class="row">

        <header>
            <nav class="navbar navbar-expand-lg navbar-light" style="font-size: 20px;font-weight: bold;">
                <!-- container -->
                <a class="navbar-brand" href="#" style="margin-left: 30px; font-size: 25px;">ITI Cafeteria</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">

                        <li class="nav-item">
                            <a class="nav-link" href="allproducts.php">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="allusers.php">Users</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Manual Orders</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="check Admin page.php">Checks</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="orders.php">Orders</a>
                        </li>

                    </ul>
                    <div style="display:inline; margin-left:700px">

                        <div class="dropdown">
                            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                Admin </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="logout.php">Logout</a></li>

                            </ul>
                        </div>
                    </div>
                </div>
                <!-- ./container -->
            </nav>
        </header>
        <?php if (isset($_GET['error'])) { ?>
            <p class="error" style="color:white;margin-top:20px; font-size:20px; margin-left:30px;"><?php echo $_GET['error']; ?></p>
            <h3 style="color:white;margin-left:30px;"> LET'S MAKE ANOTHER ORDER TO ANOTHER PERSON!</h3>
        <?php } ?>
        <?php
            $dsn = 'mysql:dbname=cafeteria;host=127.0.0.1;port=3306;';
            $user = 'root';
            $password = '';
            $db = new PDO($dsn, $user, $password);
            echo "<div class='container p-5'>
    <form method='post' action='addorder.php' class='row'>";
            echo "<h2 style='margin-top:-20px;'>Select User:</h2>";
            $q = "select * from users";
            $s = $db->prepare($q);
            $resobj = $s->execute();
            echo "<div class='row' style='margin-bottom:10px;'>
            <select name='s' class='form-select' aria-label='Default select example'  style='width:auto;margin-left:10px;'>
    <option selected>Choose user name..</option>
    ";
            while ($row = $s->fetch(PDO::FETCH_ASSOC)) {
                echo " <option value='{$row['user_id']}'>{$row["user_name"]}</option>
        ";
            }
            echo "</select></div>
            <div class='row'>
            ";

            $select_query = "select * from products";
            $stmt = $db->prepare($select_query);
            $resobj = $stmt->execute();
            echo "<div class='col-9'><div class='row row-cols-3 row-cols-md-3 g-4'>";
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                echo "<form method='post' action='index.php?id=" . $row['product_id'] . "'>
                <div class='col'><div class='card' style='background-color:'>
        <img class=card-img-top' style='width:330px; height:280px;' src='" . $row["image"] . "'>
        <div class='card-body text-center' style='color:black;'>
                <h4 class='card-title'>{$row["product_name"]}</h4>
                <h6 class='card-text'>Price: {$row["product_price"]}L.E</h6>
                <input type='hidden' name='product_name' value='" . $row["product_name"] . "'>
                <input type='hidden' name='product_price' value='" . $row["product_price"] . "'>
                <input type='hidden' name='product_id' value='" . $row["product_id"] . "'>
                <input class='control-form' type='number' name='count'>
                <input type='submit' class='btn btn-dark' value='ADD TO CARD' name='addtocard' style='margin-top:10px'>
                </form>
            </div>
        </div></div>";
            }
            echo "</div></div>";
            ?>

        <div class="col-3" style="border:1px solid grey; height:600px; border-radius: 5px;">
            <div style="margin-top:20px ; font-size:20px;">
                <?php
                    if (!empty($_SESSION['c'])) {
                        $total = 0;
                        foreach ($_SESSION['c'] as $key => $value) {
                            echo "<br>
                            <span> " . $value['name'] . "</span><span>     " . $value['price'] . "</span>L.E<br>
                            <span class='text-dark'>Amount: " . $value['amount'] . "</span><span class='text-dark'>      Total:     " . number_format($value['price'] * $value['amount'], 2) . "L.E</span>";
                            $total = $total + ($value["amount"] * $value['price']);
                        }
                        echo '<br>
                        <h3 style="font-size:25px; font-weight: bold; display:inline;">
                        <span id="tp">TOTAL: ' . $total . '</span><span> EGP</span>
                        <input type="hidden" value="' . $total . '" name="total" id="tpp">
                        </h3>';
                    } ?>
                <br><br>
                <br>

                <h5>Notes:</h5>
                <textarea name="note" class="form-control"></textarea><br>
                <h5>Room:</h5>
                <input name="room" type="number" class="form-control"><br>
                <hr>

                <input type="submit" value="CheckOut" class="btn btn-dark" style="float:right;">

            </div>

        </div>
        </div>
        </form>



    </body>

    </html>

<?php
}


?>