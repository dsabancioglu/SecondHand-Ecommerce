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
                <h3>Sell It</h3>
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

             <?php

                $productId = $_GET['productId'];

                include "../dao/connection.php";

                $select = mysqli_query($connection, "SELECT products.Price, brands.Name as BrandName, products.Size, products.Image, users.Username as UserName, users.Id as UserId, products.price, products.Text from products LEFT JOIN brands ON BrandId = brands.Id LEFT JOIN users ON UserId = users.Id WHERE products.Id = $productId");
                $row = mysqli_fetch_array($select);

                    echo
                    '
                    <div class="row">
                        <h6> '  . $row['BrandName'] . ' - ' . $row['Size'] . ' Beden' .  '</h6>
                    </div>
                    <div class="card mt-4">
                        <div class="row">    
                            <div class="col col-lg-5 col-md-5 col-sm-12">
                                <img src=' . $row['Image'] . ' class="img-fluid" alt="product-img"/>
                            </div>

                            <div class="col col-lg-7 col-md-7 col-sm-12 p-5">
                                <div class="row mb-5">
                                    <div class="col-8">
                                    <h4>'  . $row['BrandName'] . ' - ' . $row['Size'] . ' Beden' .  '</h4>
                                        <div class="product-detail d-flex flex-column">
                                                <div class="seller-box d-inline-block">
                                                <span class="text-muted mr-5">Satıcı: </span>  
                                                <a href="profile.php?userId='. $row["UserId"] . '" class="text-decoration-none">'. $row["UserName"] . '</a>
                                                </div> 
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <h4 class="text-end main-color">
                                            '. $row['Price'] . ' TL' . '
                                        </h4>
                                    </div>
                                </div>    
                                <div  class="row d-flex flex-column">
                                    <hr/>
                                    <p class="p-3">'. $row['Text'] . '</p>
                                    <div class="row p-3">
                                        <div class="col-3">
                                            <span class="card w-75 text-center text-decoration-none '.(($row['Size']=='S') ? 'main-color' : "text-muted"). '">
                                                S
                                            </span>
                                        </div>
                                        <div class="col-3">
                                            <span class="card w-75 text-center text-decoration-none '.(($row['Size']=='M') ? 'main-color' : "text-muted"). '">
                                                M
                                            </span>
                                        </div>
                                        <div class="col-3">
                                            <span class="card w-75 text-center text-decoration-none '.(($row['Size']=='L') ? 'main-color' : "text-muted"). '">
                                                L
                                            </span>
                                        </div>
                                        <div class="col-3">
                                            <span class="card w-75 text-center text-decoration-none '.(($row['Size']=='XL') ? 'main-color' : "text-muted"). '">
                                                XL
                                            </span>
                                        </div>
                                    </div>
                                    <div class="row p-3">
                                        <div class="alert alert-orange" role="alert">
                                        <span class="m-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-truck" viewBox="0 0 16 16">
                                                <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                                            </svg>
                                        </span>
                                        Kargo Bedava
                                        </div>
                                    </div>

                                    <div class="buy">
                                        <a href="buy.php?userId='. $row["UserId"] . '&productId='.$productId.'" "type="button" class="w-100 btn btn-outline-warning mt-4">Satın Al</a>
                                    </div>
                                </div>
                            </div>                  
                            
                        </div>
                    </div>';
             ?>
                
               
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>