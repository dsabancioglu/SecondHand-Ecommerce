<?php
include "../dao/connection.php";

$productId = $_GET['productId'];
$username = $_COOKIE['username'];
if (!empty($username) && $username != "null") { //kullanıcı oturumu açık
    header("Location: http://localhost:81/dolap/pages/buy.php");
    // $delete = mysqli_query($connection, "DELETE FROM products WHERE Id = $productId");
    
}
else { //username = null
    header("Location: http://localhost:81/dolap/pages/login.php");
}

?>