<?php

require 'vendor/autoload.php';

$generator = new Picqer\Barcode\BarcodeGeneratorHTML();

$username = "root";
$password = "";
$host = "localhost";
$database = "barcodes";

$connection = new PDO("mysql:host=$host;dbname=$database", $username, $password);
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "SELECT * FROM barcodes";

$stmt = $connection->prepare($sql);
$stmt->execute();
$barcodes = $stmt->fetchAll();

// print with barcodes
foreach ($barcodes as $barcode) {
    echo $barcode['name'] . '<br>';
    echo $barcode['uuid'] . '<br>';
    echo $generator->getBarcode($barcode['uuid'], $generator::TYPE_CODE_128);
    echo '<br>';
}