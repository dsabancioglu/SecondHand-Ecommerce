<?php
include "../dao/connection.php";

$productId = $_GET['productId'];
$username = $_COOKIE['username'];
if (!empty($username) && $username != "null") { //kullanıcı oturumu açık
    header("Location: http://localhost:81/sellit/pages/buy.php");
    // $delete = mysqli_query($connection, "DELETE FROM products WHERE Id = $productId");
    
}
else { //kullanıcı oturumu açık değilse
    header("Location: http://localhost:81/sellit/pages/login.php");
}

?>