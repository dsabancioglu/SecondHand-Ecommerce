<?php

    include "../dao/connection.php";

    $productId = $_GET['productId'];

    $query = mysqli_query($connection, "DELETE FROM products WHERE Id = $productId") or die("hata");
    $userId = $_GET['userId'];

    if($query){
        header("location: ../pages/profile.php?userId=$userId");
        exit;
    }




?>