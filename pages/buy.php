<html>

<head>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
</head>

<body>
    <!------------------HEADER------------------>
    <nav class="navbar navbar-expand-lg navbar-light bg-light p-3">
        <div class="container">
            <a href="./home.php" class="navbar-brand main-color">
                <h3>Sell it</h3>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <div class="w-75 h-100 me-auto">
                    <div class="d-flex align-items-center justify-content-center">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <form class="d-flex align-items-center justify-content-center" action="home.php" method="$_GET">
                                    <div class="input-group">
                                        <input type="search" name="searchKey" class="form-control" placeholder="Aradığınız ürün, kategori veya markayı yazın" />
                                        <button class="btn btn-outline-secondary" type="submit">
                                            <span>
                                                <svg xmlns="http://www.w3.org/   2000/svg" width="16" height="16" class="bi bi-search" viewBox="0 0 16 16">
                                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                                </svg>
                                            </span>
                                        </button>
                                    </div>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>

                <?php
                include "../dao/connection.php";

                if (empty($_COOKIE['username'])) {
                    $username = "null";
                } else {
                    $username = htmlspecialchars($_COOKIE['username']);
                }

                if (!empty($username) && $username != "null") {

                    $select = mysqli_query($connection, "SELECT * from users where username='$username'");

                    while ($result = mysqli_fetch_array($select)) {
                        echo '
                        <div class="d-flex">
                            <div class="dropdown btn-account">
                                <button class="btn  dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                                    </svg>
                                   <span class="text-uppercase"> ' . $username . '</span>
                                </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="profile.php?userId=' . $result['Id'] . '">Profil</a>
                            <a class="dropdown-item" href="settings.php?userId=' . $result['Id'] . '">Ayarlar</a>
                            <a class="dropdown-item" href="home.php?logout=true">Çıkış Yap</a>
                            </div>
                      </div>
                     ';
                    }
                } else {
                    echo
                    '<div class="d-flex">
                            <a class="text-decoration-none main-color" href="login.php">
                                <h6>Giriş Yap | </h6>
                            </a>
                            <a class="text-decoration-none main-color" href="register.php" style="margin-left: 5px;">
                                <h6> ÜYE OL </h6>
                            </a>
                        </div>';
                }

                function removeSession()
                {
                    setcookie('username', "null", time() + (60 * 10), '/');
                    header("Location: http://localhost:81/sellit/pages/home.php");
                    exit;
                }

                if (isset($_GET['logout'])) {
                    removeSession();
                }



                ?>

            </div>
        </div>
    </nav>

    <!------------------HEADER------------------>
    <div class="container mt-5 mb-5">
        <div class="d-flex justify-content-center mt-4">
            <div class="w-40 row no-gutters">
                <div class="col">
                    <div class="d-flex justify-content-center align-items-center p-2 active-link">
                        Siparişi Tamamla!
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <div class="w-40 row no-gutters box p-5">
               

                    <?php
                    include "../dao/connection.php";

                    if (isset($_GET['productId'])) {
                        $productId = $_GET['productId'];
                        $select = mysqli_query($connection, "SELECT categories.Name as categoryName, products.Id, products.Image, brands.Name, products.Size, products.Text, products.Price FROM products LEFT JOIN brands ON brands.Id = products.BrandId LEFT JOIN categories ON categories.Id = products.CategoriesId where products.id=$productId");
                    }

                    if (isset($_GET['userId'])) {
                        $userId = $_GET['userId'];
                    }

                    echo ' <form action="../dao/addToOrder.php?userId='.$userId.'" method="POST">';

                    while ($result = mysqli_fetch_array($select)) {
                        echo '
                                    <div class="card p-3 mt-2 mb-5">
                                      <div class="row d-flex">
                                        <div class="col-3">
                                            <img src=' . $result['Image'] . 'class="img-fluid" alt="product-img" />
                                        </div>
                                        <div class="col-9 p-3">
                                            <h6>' . $result['Name'] . ' - ' . $result['Size'] . ' Beden' . ' </h6>
                                            <div class="card-body text-end">
                                                <h6 class="card-title main-color">Toplam: ' . $result['Price'] . ' TL' . '</h6>
                                            </div>
                                      </div>
                                    </div>

                                ';
                    }

                    ?>
                    </p>
                    <div class="form-group d-flex flex-column align-items-start mb-2">
                        <h6 for="exampleInputEmail1">Kart Numarası</h6>
                        <input type="text" name="CardNo" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" />
                    </div>
                    <div class="form-group d-flex flex-column align-items-start mb-3">
                        <h6 for="exampleInputPassword1">Kart Sahibinin Adı</h6>
                        <input type="text" name="CardName" class="form-control" id="exampleInputPassword1" />
                    </div>
                    <div class="form-group d-flex flex-column align-items-start mb-2">
                        <h6 for="exampleInputEmail1">CVC</h6>
                        <input type="text" name="Cvc" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" />
                    </div>
                    <div class="form-group d-flex flex-column align-items-start mb-2">
                        <h6 for="exampleInputEmail1">Son Kullanma Tarihi</h6>
                        <input type="text" name="ExpirationDate" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" />
                    </div>
                    <button type="submit" class="w-100 btn btn-orange mt-4" name="buyButton">Satın Al</button>
                </form>
            </div>
        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>