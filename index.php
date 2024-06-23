<?php
require 'vendor/autoload.php';

// connect to the database
    $username = "root";
    $password = "";
    $host = "localhost";
    $database = "barcodes";

    $connection = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $uuid = uniqid();
    // This will output the barcode as HTML output to display in the browser
    $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
    echo $generator->getBarcode($uuid, $generator::TYPE_CODE_128);

    // insert into the database
    $sql = "INSERT INTO barcodes (uuid, name) VALUES (:uuid, :name)";
    $stmt = $connection->prepare($sql);
    $stmt->execute(['uuid' => $uuid, 'name' => $name]);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test BarCode</title>
</head>
<body>
    <form action="" method="POST">
        <div>
            <label for="">Name</label>
            <input type="text" name="name">
        </div>
        <button type="submit">Send</button>
    </form>
</body>
</html>