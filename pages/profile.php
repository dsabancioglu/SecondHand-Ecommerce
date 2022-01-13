<html>

<head>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
</head>

<body>
    <!------------------  HEADER  ------------------>
    <nav class="navbar navbar-expand-lg navbar-light bg-light p-3">
        <div class="container">
            <a href="./home.php" class="navbar-brand main-color">
                <h3>Dolap</h3>
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
                    header("Location: http://localhost:81/dolap/pages/home.php");
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
            <div class="card p-3 mb-3" witdh="100%">

                <div class="row">
                    <div class="col-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="70%" height="70%" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                            <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                        </svg> 
                    </div>

                    <div class="col-9">

                        <div class="row">
                            <form>
                            <?php
                                include "../dao/connection.php";

                                if (isset($_GET['userId'])) {
                                    $userId = $_GET['userId'];
                                    $select = mysqli_query($connection, "SELECT * from users where id=$userId");
                                }

                                while ($result = mysqli_fetch_array($select)) {
                                   echo '
                                   <div class="row mt-5 pt-2">
                                        <div class="col-6">
                                            <h5 for="name">' . $result['Name'] . " ". $result['Surname'].  '</h5>
                                        </div>
                                    </div>
                                    <div class="row mt-5">
                                    <div class="col-6">
                                        <p for="name">' . $result['Biography'] . '</p>
                                        </div>
                                    </div>
                                    
                                    ';
                                }
                            ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card p-3">
                <div class="row">
                    <div class="col-6 d-flex align-items-center">
                        <h5>Ürünler</h5>
                    </div>

                    <?php
                        include "../dao/connection.php";

                        $userId = $_GET['userId'];
                        
                        $username = htmlspecialchars($_COOKIE['username']);

                        $select = mysqli_query($connection, "SELECT * from users where username='$username'");

                        while ($result = mysqli_fetch_array($select)) {      
                            if ( $userId == $result['Id']) {
                                echo '
                                    <div class="col-6 d-flex justify-content-end">
                                        <button type="submit" class="w-25 btn btn-orange" data-bs-toggle="modal" data-bs-target="#exampleModal">Ürün Ekle</button>
                                    </div>'; 
                            }
                        }
                       
                    ?>
                    </div>
                <div class="row p-2">
                    <?php
                        include "../dao/connection.php";

                        if (isset($_GET['userId'])) {
                            $userId = $_GET['userId'];
                            $select = mysqli_query($connection, "SELECT categories.Name as categoryName, products.Id, products.Image, brands.Name, products.Size, products.Text, products.Price FROM products LEFT JOIN brands ON brands.Id = products.BrandId LEFT JOIN categories ON categories.Id = products.CategoriesId WHERE UserId=$userId");
                        }
                        
                        if (empty($_COOKIE['username'])) {
                            $username = "null";
                        } else {
                            $username = htmlspecialchars($_COOKIE['username']);
                        }
        
                            
                        $getUserId = mysqli_query($connection, "SELECT * from users where username='$username'");

                        $result2 = mysqli_fetch_array($getUserId);

                        while ($result = mysqli_fetch_array($select)) {
                            echo
                            '<div class="col col-md-3 mt-2 mb-2 ">
                                    <div class="card  card-custom">
                                        <img src=' . $result['Image'] . 'class="img-fluid" alt="product-img" />
                                        <a href="productDetail.php?productId=' . $result['Id'] . '"  class="card-body text-start text-decoration-none text-dark">
                                            <h6 class="card-title">' . $result['categoryName'] . '</h6> <br>
                                            <h6 class="card-title">' . $result['Name'] . ' - ' . $result['Size'] . ' Beden' . ' </h6>
                                            <p class="card-text">' . $result['Text'] . '</p>
                                        </a>
                                        <div class="card-body text-end">
                                            <h6 class="card-title">' . $result['Price'] . ' TL' . '</h6>
                                        </div>
                                        <div class="card-footer d-flex justify-content-end">
                                        ' . (($result2['Id']==$userId) ? '<input type="submit" class="w-25 btn btn-danger" value="Sil"/>' : '<a href="buy.php?productId='. $result['Id'] .'" "type="button" class="w-100 btn btn-outline-warning mt-4">Satın Al</a> '). ' 
                                        </div>
                                    </div>      
                            </div>';
                        }

                    ?>
                </div>

                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ürün Ekle</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <form>
                        <div class="form-group d-flex flex-column align-items-start mb-2">
                            <h6 for="exampleInputEmail1">Kullanıcı Adı</h6>
                            <input type="text" class="form-control"  aria-describedby="emailHelp"/>
                        </div>
                        <div class="form-group d-flex flex-column align-items-start mb-2">
                            <h6 for="exampleInputEmail1">E-mail</h6>
                            <input type="email" class="form-control" aria-describedby="emailHelp"/>
                        </div>
                        <div class="form-group d-flex flex-column align-items-start mb-2">
                            <h6 for="exampleInputEmail1">Ad</h6>
                            <input type="text" class="form-control"  aria-describedby="emailHelp"/>
                        </div>
                        <div class="form-group d-flex flex-column align-items-start mb-2">
                            <h6 for="exampleInputEmail1">Soyad</h6>
                            <input type="text" class="form-control"  aria-describedby="emailHelp"/>
                        </div>
                        <div class="form-group d-flex flex-column align-items-start mb-3">
                            <h6 for="exampleInputPassword1">Parola</h6>
                            <input type="password" class="form-control" />
                        </div>
                    </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                        <button type="button" class="btn btn-success">Ekle</button>
                    </div>
                    </div>
                </div>
                </div>



            </div>
        </div>

    
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>