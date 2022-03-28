<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$id = (int) $_GET["id"];


$dsn = 'mysql:dbname=cafeteria;host=127.0.0.1;port=3306;'; #port number
$user = 'root';
$password = '';



try {


    $db = new PDO($dsn, $user, $password);
    if ($db) {
        $select_query = "select * from products where product_id=:sid";
        $stmt = $db->prepare($select_query);
        $stmt->bindParam("sid", $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // var_dump($row);
    }
} catch (Exception $e) {
    echo $e->getMessage();
}

?>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <!-- container -->
        <a class="navbar-brand" href="#" style="margin-left: 30px;">ITI Cafeteria</a>
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
                    <a class="nav-link" href="#">Checks</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="orders.php">Orders</a>
                </li>

            </ul>
            <div style="display:inline; margin-left:700px">

                <div class="dropdown">
                    <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        Admin </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="#">Logout</a></li>

                    </ul>
                </div>
            </div>
        </div>
        <!-- ./container -->
    </nav>
</header>

<h1 style="color: rebeccapurple; size: 50px; margin-left: 300px; "> Edit product Data</h1>
<div class="container w-50 mt-5 border rounded-3">
    <div class="row mt-4">
        <form method="Post" action='<?php echo "update.php?id={$id}"; ?>' enctype="multipart/form-data">
            <label>name of product</label>
            <input name="name" class="form-control" value="<?php echo $row["product_name"]; ?>"><br>
            <label class="form-label"> product price</label>
            <input name="price" class="form-control" value="<?php echo $row["product_price"]; ?>"><br>
            <label class="form-label"> mount of product</label>
            <input name="amount" class="form-control" value="<?php echo $row["amount"]; ?>"><br>
            <input class="btn btn-outline-primary btn1" type="submit">


        </form>
    </div>
</div>