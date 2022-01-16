<?php

include "connection.php";

$Name = $_POST['Name'];
$Surname = $_POST['Surname'];
$Username = $_POST['Username'];
$Mail = $_POST['Mail'];
$Address = $_POST['Address'];
$Biography = $_POST['Biography'];
$Parola = $_POST['Parola'];
$ParolaTekrar = $_POST['ParolaTekrar'];
$userId = $_GET['userId'];

if ($Parola != $ParolaTekrar){
    echo "<script>alert('Parola eşleşmesi hatalı.')</script>";
}
else {
    $update = mysqli_query($connection,"UPDATE users SET Name = \"$Name\", Surname= \"$Surname\",Username = \"$Username\", Mail = \"$Mail\", Address = \"$Address\", 
    Biography = \"$Biography\", Password= \"$Parola\"  WHERE Id= $userId");

    if($update){
        header("location: ../pages/profile.php?userId=$userId");
        exit;
    }
    else{
        echo "<script>alert('Güncelleme gerçekleştirilemedi.')</script>";
    }
}




?>