<?php
require 'vendor/autoload.php';

$generator = new Picqer\Barcode\BarcodeGeneratorHTML();

$username = "root";
$password = "";
$host = "localhost";
$database = "barcodes";

$connection = new PDO("mysql:host=$host;dbname=$database", $username, $password);
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "SELECT * FROM barcodes WHERE uuid = ?";

    if (isset($_GET['uuid']) && $_GET['uuid'] != '') {
        $uuid = $_GET['uuid'];
        $stmt = $connection->prepare($sql);
        $stmt->execute([$uuid]);
        $barcode = $stmt->fetch();
        if ($barcode) {
            echo $barcode['name'] . '<br>';
            echo $barcode['uuid'] . '<br>';
            echo $generator->getBarcode($barcode['uuid'], $generator::TYPE_CODE_128);
            echo '<br>';
        } else {
            echo 'Barcode not found';
        }
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- <form action="" method="get">
        <div>
            <label for="">UUID</label>
            <input type="text" name="uuid">
        </div>
        <button type="submit">Send</button>
    </form> -->
</body>
</html>