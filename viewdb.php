<html>

</html>

<body>
    <form action="deneme.php" method="POST">
        <?php
        include "./dao/connection.php";

        //INNER JOIN: sadece eşleşenler
        //LEFT JOIN: sola yazdığın tablodaki her satır basılır 
        //RIGHT JOIN: sağa yazdığın tablodaki her satır basılır
        $sorgu = mysqli_query($connection, "SELECT users.Username, products.Name FROM users INNER JOIN products ON products.UserId = users.Id");
        
        $Mail= "dilarasabanciogl@gmail.com";
        $dbPassword = mysqli_query($connection, "SELECT Password from users where Mail = '$Mail'");
        
        $sorgu = mysqli_query($connection, "SELECT users.Username, products.Name FROM users INNER JOIN products ON products.UserId = users.Id");

        echo "<table>";
        while ($result = mysqli_fetch_array($dbPassword)) {
            echo "<tr> <td>" .
                $result['Password'] . "</td> <td>" ;
        }
        echo "</table>";
        // echo "<a href='baglanti.php?name=dilara'>TIkla gelsin</a>";
        ?>
        <input type="submit" value="tıkla kanka"></input>
    </form>
</body>