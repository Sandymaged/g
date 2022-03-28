<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <style>
    .error {
      color: #FF0000;
    }
  </style>
</head>

<body>
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
  <?php
  $error = json_decode(@$_GET["errors"]);
  // var_dump($error);
  $old = json_decode(@$_GET["old"]);
  ?>
  <h1 class="text-center text-info">
    ADD USER
  </h1>
  <div class="row">
    <div class="col-3"></div>
    <div class="col-6">
      <form method="post" enctype="multipart/form-data" action="valid.php">
        <label class="form-label">Name:</label>
        <input type="text" name="name" class="form-control">
        <br>
        <label class="form-label">Email:</label>
        <input type="email" class="form-control" name="email" value="<?php if (isset($old->email)) {
                                                                        echo $old->email;
                                                                      } ?>">
        <?php if (isset($error->empty_email)) {
          echo "<span style='color:red'> invaild email format </span> ";
        } ?><br>
        <br>
        <label class="form-label">Password:</label>
        <input type="password" class="form-control" name="password" value="<?php if (isset($old->password)) {
                                                                              echo $old->password;
                                                                            } ?>">
        <?php if (isset($error->empty_pass)) {
          echo "<span style='color:red'> invaild password format </span> ";
        } ?><br>
        <br>
        <label class="form-label">Confirm Password:</label>
        <input type="password" class="form-control" name="password2" value="<?php if (isset($old->password2)) {
                                                                              echo $old->password2;
                                                                            } ?>">
        <?php if (isset($error->empty_pass2)) {
          echo "<span style='color:red'> try invaild password format </span> ";
        } ?><br>
        <br>
        <label class="form-label">Room No:</label>
        <input type="number" name="room" class="form-control">
        <br>
        <label class="form-label">Ext:</label>
        <input type="number" name="ext" class="form-control">
        <br>

        <input type="submit" value="submit" class="btn btn-primary" style="float: right">

      </form>
    </div>
    <div class="col-3"></div>
  </div>
</body>

</html>