<?php
session_start();
if ($_SESSION['role'] == "user") {
    header("location: forbidden.html");
} else {
    ?>
    <html>

    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <style>
            body {
                background: linear-gradient(to bottom, #996633 0%, #ffffff 100%);
                height: auto;
            }

            .sp {
                margin-left: 40px;
            }
        </style>
    </head>

    <body>
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
        <?php
            $dsn = 'mysql:dbname=cafeteria;host=127.0.0.1;port=3306;'; #port number
            $user = 'root';
            $password = '';
            $db = new PDO($dsn, $user, $password);


            echo "<div class='container'><h1 class='text-center text-dark'>ALL PRODUCTS</h1>
 <h6 style='float:right;font-size: 30px;  background-color: lightgrey;
 '><a href='addproduct.php?id}' >addproduct </a> </h6>
";
            if ($db) {

                $select_query = 'select * from products';
                $stmt = $db->prepare($select_query);
                $resobj = $stmt->execute();


                echo "<table class='table table-light table-striped text-center table-bordered' style='font-size: 20px;'> 
            <tr> 
            <th>product</th>
             <th>price</th>
             <th>image</th>
             <th>Action</th>
             <th>available or not</th></tr>
             ";
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    if ($row["amount"] > 0) {
                        $rowaction = "available";
                    } else {
                        $rowaction = "unavilable";
                    }
                    echo "<tr> 
                        <td>{$row["product_name"]}</td> 
                        <td>{$row["product_price"]}</td>
                        <td>
                        <img src=' {$row["image"]}' width=100px height=100px  >
                        </td>
                        <td><a href='edit.php?id={$row["product_id"]}'>edit </a>,
                        <a href='delete.php?id={$row["product_id"]}'>delete </a>
                        <td > {$rowaction}</td>
                        </td></tr>";
                }
                echo "</table>";
            }

            ?>
        </div>
    </body>
<?php
}
?>