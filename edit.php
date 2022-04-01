
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <style>
            body {
                background: linear-gradient(to bottom, #996633 0%, #ffffff 100%);
                height: auto;
                /* color: white; */
                font-size:150%;
                        }

            .sp {
                margin-left: 40px;
            }
        </style>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$id=(int)$_GET["id"];


$dsn = 'mysql:dbname=cafeteria;host=127.0.0.1;port=3306;'; #port number
        $user = 'root';
        $password = '';
try{ 
        $db = new PDO($dsn, $user, $password);
        if($db){
$select_query="select * from products where product_id=:sid";
    $stmt=$db->prepare($select_query);
    $stmt->bindParam("sid",$id);
   $stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	// var_dump($row);
 }
        }catch(Exception $e)
        {
            echo $e->getMessage();
        }?>
<h1  style=" size: 50px; margin-left: 300px; "> Edit product Data</h1>
<div class="container w-50 mt-5 border rounded-3">
      <div class="row mt-4">
<form method="Post" action ='<?php echo "update.php?id={$id}";?>' enctype="multipart/form-data">
       <label>name of product</label>
	<input name="name" class="form-control" value="<?php echo $row["product_name"]; ?>" ><br>
    <label class="form-label">   product price</label>
	<input name="price" class="form-control" value="<?php echo $row["product_price"]; ?>"><br>
    <label  class="form-label">  mount of product</label>
	<input name="amount"   class="form-control" value="<?php echo $row["amount"]; ?>"><br>
	<label  class="form-label">Please choose your file</label>
    <input type="text" name="photo"   value="<?php echo $row["image"];?>" class="form-control">
    <input type="file" multiple name="photo2" class="form-control">
    <input  class="btn btn-outline-primary btn1" type="submit">

    
</form>
      </div>
</div>
