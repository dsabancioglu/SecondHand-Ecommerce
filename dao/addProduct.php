<?php
include "connection.php";

$userId = $_GET['userId'];
$productName = $_POST['productName'];
$productBrand = $_POST['productBrand'];
$productCategory = $_POST['productCategory'];
$productExplain = $_POST['productExplain'];
$productSize = $_POST['productSize'];
$productImage = $_POST['productImage'];
$productPrice = $_POST['productPrice'];

$saveQuery = mysqli_query($connection,"INSERT into products (CategoriesId, Price, BrandId, Text, Image, Size, Stock, UserId) values ($userId, $productPrice, $productBrand, $productExplain, $productImage, $productSize,1, $userId )");

if($saveQuery){
    echo "<script>alert('Ürün Başarıyla Eklendi.')</script>";
    header("location: ../pages/home.php");
    exit;
}
else {
    echo "<script>alert('Ürün Eklenemedi.')</script>";
    header("location: ../pages/profile.php?userId=$userId");
    exit;
    
}
    




?>