<?php   
 ini_set('display_errors', 1);
      ini_set('display_startup_errors', 1);
      error_reporting(E_ALL);
    //   var_dump($_POST);

  $errors=[];
$dsn = 'mysql:dbname=cafeteria;host=127.0.0.1;port=3306;'; #port number
  $user = 'root';
  $password = '';
  $conn = new PDO($dsn, $user, $password);

try{

if ($_POST["bname"]== "" ){
    $errors["empty_name"]=true;
        }
        // else{
        //     $old["name"]=$_POST["name"];
        // }
        if(count($errors)>0){
            $errors_msg=json_encode($errors);
            $base="?errors={$errors_msg}";


         header("Location:addcategory.php{$base}");
        }
else
{   
    if($conn){
        $ins_query="insert into categories (category_name) values (:category_name);";
        $stmt=$conn->prepare($ins_query);
        $name=$_POST['bname'];
        $stmt->bindParam(":category_name",$name);
        $stmt->execute();
        echo $stmt->rowCount();
        header("location:addproduct.php");
        }}

}
catch(Exception $e){
        echo $e->getMessage();
      }  
  
	
    
