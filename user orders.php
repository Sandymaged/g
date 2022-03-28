<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <title>user orders page</title>
</head>

<body>
    <!-- <h1>User Orders page</h1> -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <!-- container -->
            <a class="navbar-brand" href="#">ITI Cafeteria</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="indexuser.php">
                            Home
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="user orders.php">Orders</a>
                    </li>

                </ul>

            </div>
            <!-- ./container -->
        </nav>
    </header>
    <div class="container bg-info">
        <div class="row">
            <div class="col-12 mt-3">
                <h1>******---> Your Orders <---***** </h1> <br>
                        <hr>
            </div>
        </div><br>

        <!--  Header Part -->
        <form action="" method="GET">
            <div class="row">
                <div class="col-4">
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="inputGroupSelect01">Start Date</label>
                        <input type="date" name="start_date" value="<?php if (isset($_GET['start_date'])) {
                                                                        echo $_GET['start_date'];
                                                                    } ?>">
                    </div>
                </div>

                <div class="col-4">
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="inputGroupSelect01">End Date</label>
                        <input type="date" name="end_date" value="<?php if (isset($_GET['start_date'])) {
                                                                        echo $_GET['start_date'];
                                                                    } ?>">
                    </div>


                </div>
                <div class="col-2">
                    <button class="btn btn-success"> Filter</button>

                </div>
                <!-- <div class="col-2">
                    <button class="btn btn-danger"> Reset</button>
                </div> -->


            </div>
        </form>
        <hr>

        <!--  ********************TAble PArr *********************** -->
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th>Order Date</th>
                                <th>Status</th>
                                <th>Total Amout</th>
                                <th>Action</th>

                            </tr>
                        </thead>

                        <tbody>

                            <?php

                            $conn = mysqli_connect("localhost", "root", "", "cafeteria");
                            if (isset($_GET['start_date']) && isset($_GET['end_date'])) {
                                $start_date = $_GET['start_date'];
                                $end_date = $_GET['end_date'];

                                $query = "SELECT * FROM orders WHERE date BETWEEN '$start_date' AND '$end_date' ";
                                $query_run = mysqli_query($conn, $query);

                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $row) {
                                        // echo $row['date'];
                                        ?>

                                        <tr>
                                            <td><input type="button" name='orderDetails' value="+" class="btn btn-success" onclick="details()"> &nbsp;&nbsp; <?php echo $row['date'] ?></td>
                                            <td><?php echo $row['staus'] ?></td>
                                            <td><?php echo $row['total'] ?></td>
                                            <td>
                                                <?php
                                                            if ($row['staus'] == 'processing') {
                                                                ?>
                                                    <!-- <a href="update.php"  class="btn btn-danger">Cancel</a> -->

                                                    <input type="button" class="btn btn-danger" value="Cancel">
                                                <?php
                                                            }

                                                            ?>
                                            </td>
                                        </tr>

                            <?php
                                    }
                                } else {
                                    echo "NO Record Found";
                                }
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!--       Orders Details     -->

        <table class="table">
            <thead>
                <th>tea</th>
                <th>coffe</th>
                <th>soft</th>
                <th>french</th>
            </thead>
            <tbody id="data_retrive">

            </tbody>
        </table>

        <!-- <span>ahmmed</span>
        <span>ahmmed</span> -->

    </div>


    <script>
        function details() {
            // alert('HElooooooooooooooooooooooooo');
            $.ajax({

                type: "GET",
                url: "order_db.php",
                dataType: 'html',
                success: function(data) {

                    $('#data_retrive').html(data);
                }
            });


        };
    </script>
















    <!-- Optional JavaScript; choose one of the two! -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>