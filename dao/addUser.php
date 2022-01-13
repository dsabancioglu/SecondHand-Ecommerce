<?php

$connection = mysqli_connect("localhost", "root", "", "dolap");

$Name = $_POST['name'];
$Surname = $_POST['surname'];
$Mail = $_POST['e-mail'];
$Password = $_POST['password'];
$Username = $_POST['username'];

echo $Name . "<br>" . $Surname . "<br>" . $Mail. "<br>". $Password. "<br>". $Username . "<br>";

$save = mysqli_query($connection, "INSERT into users (Name, Surname, Mail, Password,Username) values ('$Name', '$Surname','$Mail', '$Password','$Username')") or die("Hata: kayıt işlemi gerçekleşemedi.");

// $sorgu = mysqli_query($connection, "SELECT users.Username, products.Name FROM users INNER JOIN products ON products.UserId = users.Id");

//         //Ürü

//         echo "<table>";
//         while ($str = mysqli_fetch_array($sorgu)) {
//             echo "<tr> <td>" .
//                 $str['Username'] . "</td> <td>" .
//                 $str['Name'] . "</td> </tr>";
//         }
//         echo "</table>";

?>