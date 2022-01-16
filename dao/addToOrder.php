<?php

include "connection.php";

$CardNo = $_POST['CardNo'];
$CardName = $_POST['CardName'];
$Cvc = $_POST['Cvc'];
$ExpirationDate = $_POST['ExpirationDate'];
$userId = $_GET['userId'];

$saveQuery = mysqli_query($connection,"INSERT into orders (UserId, CardNo, CardName, Cvc, ExpirationDate) values ($userId, $CardNo, $CardName, $Cvc, $ExpirationDate)");

if($saveQuery){
    echo "<script>alert('Ürün Başarıyla Satın Alındı.')</script>";
    header("location: ../pages/home.php");
    exit;
}
else {
    echo "<script>alert('Ürün Satın Alınamadı.')</script>";
}
    



?>