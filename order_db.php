<?php

$hostName = 'localhost';
$userName = 'root';
$dbName = 'cafeteria';
$password = '';
$id = $_GET['key'];

$conn = mysqli_connect($hostName, $userName, $password, $dbName);

$result = $conn->query("SELECT op.product_id,op.amount,p.image,p.product_name,p.product_price FROM oproduct op join products p WHERE op.order_id=$id and op.product_id=p.product_id ");

// var_dump($result);
?>

<?php while ($data = $result->fetch_assoc()) : ?>
    <tr>
        <td><?php echo $data['product_name']; ?> </td>
        <td><?php echo $data['amount']; ?> </td>
        <td><?php echo $data['product_price']; ?></td>
        <td><?php echo $data['amount'] * $data['product_price']; ?></td>
        <td><img src='<?php echo $data['image']; ?>'></td>

    </tr>
<?php endwhile; ?>