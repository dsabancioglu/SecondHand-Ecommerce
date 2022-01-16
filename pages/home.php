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
        <div class="row">
            <div class="filter-context col col-lg-2 col-md-2 col-sm-12">
                <h6 class="text-start">Kategoriler</h6>
                <ul class="list-group text-start">
                    <?php
                    include "../dao/connection.php";

                    $select = mysqli_query($connection, "SELECT Name, Id from categories");

                    while ($result = mysqli_fetch_array($select)) {
                        echo
                        '<li class="list-group-item text-muted">
                            <a class="filter-link" href="home.php?categoryId=' . $result['Id'] . '">' . $result['Name'] . '</a>
                        </li>';
                    }

                    ?>
                </ul>
                <h6 class="text-start mt-2">Markalar</h6>
                <ul class="list-group text-start">
                    <?php
                    include "../dao/connection.php";

                    $select = mysqli_query($connection, "SELECT Name,Id from brands");

                    while ($result = mysqli_fetch_array($select)) {
                        echo
                        '<li class="list-group-item text-muted">
                            <a class="filter-link" href="home.php?brandId=' . $result['Id'] . '">' . $result['Name'] . '</a>
                        </li>';
                    }


                    ?>
                </ul>
                <h6 class="text-start mt-2">Fiyat Aralığı</h6>
                <ul class="list-group text-start">

                    <?php
                    echo
                    '<li class="list-group-item text-muted">
                                <a class="filter-link" href="home.php?down=0&up=49">0 - 49 TL</a>
                            </li>
                            <li class="list-group-item text-muted">
                                <a class="filter-link" href="home.php?down=50&up=99">50 - 99 TL</a>
                            </li>
                            <li class="list-group-item text-muted">
                                <a class="filter-link" href="home.php?down=100&up=149">100 - 149 TL</a>
                            </li>
                            <li class="list-group-item text-muted">
                                <a class="filter-link" href="home.php?down150&up=199">150 - 199 TL</a>
                            </li>
                            <li class="list-group-item text-muted">
                                <a class="filter-link" href="home.php?down=200">200 TL ve üzeri</a>
                            </li>';
                    ?>

                </ul>
            </div>

            <div class="col col-lg-10 col-md-10 col-sm-12">
                <h6 class="text-start">Öne Çıkan Ürünler</h6>
                <div class="row mt-2 ">
                    <?php
                    include "../dao/connection.php";

                    $select = mysqli_query($connection, "SELECT categories.Name as categoryName, products.Id, products.Image, brands.Name, products.Size, products.Text, products.Price FROM products LEFT JOIN brands ON brands.Id = products.BrandId LEFT JOIN categories ON categories.Id = products.CategoriesId");

                    if (isset($_GET['categoryId'])) {
                        $categoryId = $_GET['categoryId'];
                        $select = mysqli_query($connection, "SELECT categories.Name as categoryName, products.Id, products.Image, brands.Name, products.Size, products.Text, products.Price FROM products LEFT JOIN brands ON brands.Id = products.BrandId LEFT JOIN categories ON categories.Id = products.CategoriesId WHERE products.CategoriesId = '$categoryId'");
                    }

                    if (isset($_GET['brandId'])) {
                        $brandId = $_GET['brandId'];
                        $select = mysqli_query($connection, "SELECT categories.Name as categoryName, products.Id, products.Image, brands.Name, products.Size, products.Text, products.Price FROM products LEFT JOIN brands ON brands.Id = products.BrandId LEFT JOIN categories ON categories.Id = products.CategoriesId WHERE products.BrandId = '$brandId'");
                    }

                    if (isset($_GET['down'])) {
                        $down = $_GET['down'];
                        if (isset($_GET['up'])) {
                            $up = $_GET['up'];
                            $select = mysqli_query($connection, "SELECT categories.Name as categoryName, products.Id, products.Image, brands.Name, products.Size, products.Text, products.Price FROM products LEFT JOIN brands ON brands.Id = products.BrandId LEFT JOIN categories ON categories.Id = products.CategoriesId WHERE products.price >= '$down' AND products.price <= '$up' ");
                        } else {
                            $select = mysqli_query($connection, "SELECT categories.Name as categoryName, products.Id, products.Image, brands.Name, products.Size, products.Text, products.Price FROM products LEFT JOIN brands ON brands.Id = products.BrandId LEFT JOIN categories ON categories.Id = products.CategoriesId WHERE products.price >= '$down'");
                        }
                    }

                    if (isset($_GET['searchKey'])) {
                        //searchKey -> kategori veya marka
                        $searchKey = ucfirst($_GET['searchKey']);
                        $category_query = mysqli_query($connection, "SELECT Name FROM categories");
                        $brand_query = mysqli_query($connection, "SELECT Name FROM brands");

                        $check_brand = false;
                        $check_category = false;
                        while ($category = mysqli_fetch_array($category_query)) {
                            if (str_contains($category['Name'], $searchKey)) {
                                $check_category = true;
                            }
                        }

                        while ($brand = mysqli_fetch_array($brand_query)) {
                            if (str_contains($brand['Name'], $searchKey)) {
                                $check_brand = true;
                            }
                        }

                        if($check_category || $check_brand){
                            $select = mysqli_query($connection, "SELECT categories.Name as categoryName, products.Id, products.Image, brands.Name, products.Size, products.Text, products.Price FROM products LEFT JOIN brands ON brands.Id = products.BrandId LEFT JOIN categories ON categories.Id = products.CategoriesId WHERE categories.Name LIKE '$searchKey%' OR brands.Name LIKE '$searchKey%'");
                        }
                    }


                    while ($result = mysqli_fetch_array($select)) {
                        echo
                        '<a href="productDetail.php?productId=' . $result['Id'] . '" class="col col-md-3 mt-2 mb-2 text-decoration-none text-dark">
                                <div class="card  card-custom">
                                    <img src=' . $result['Image'] . 'class="img-fluid" alt="product-img" />
                                    <div class="card-body text-start">
                                        <h6 class="card-title">' . $result['categoryName'] . '</h6> <br>
                                        <h6 class="card-title">' . $result['Name'] . ' - ' . $result['Size'] . ' Beden' . ' </h6>
                                        <p class="card-text">' . $result['Text'] . '</p>
                                    </div>
                                    <div class="card-body text-end">
                                        <h6 class="card-title">' . $result['Price'] . ' TL' . '</h6>
                                    </div>
                                </div>
                        </a>';
                    }

                    ?>

                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>

</html>