<?php

$hostName = 'localhost';
$userName = 'root';
$dbName = 'cafeteria';
$password = '';

$conn = mysqli_connect($hostName, $userName, $password, $dbName);

$result = $conn->query("SELECT * FROM `orders` ");

// var_dump($result);
?>

<?php while ($data = $result->fetch_assoc()) : ?>
    <tr>
        <td><?php echo $data['tea']; ?> </td>
        <td><?php echo $data['coffe']; ?></td>
        <td><?php echo $data['soft']; ?></td>
        <td><?php echo $data['french']; ?></td>
    </tr>
<?php endwhile; ?>