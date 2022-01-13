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
                        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                            <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                        </svg> 
                    </div>

                    <div class="col-9">
                        <h5 class="mb-4">Kullanıcı Ayarları</h5>

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
                                   <div class="row">
                                        <div class="col-6">
                                            <h6 for="name">Adı:</h6>
                                            <div class="input-group">   
                                                <input type="text" class="form-control" placeholder="' . $result['Name'] . '" aria-label="name" aria-describedby="addon-wrapping"/>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <h6 for="surname">Soyadı:</h6>
                                            <div class="input-group">   
                                                <input type="text" class="form-control" placeholder="' . $result['Surname'] . '" aria-label="surname" aria-describedby="addon-wrapping"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-6">
                                            <h6 for="name">Kullanıcı Adı:</h6>
                                                <div class="input-group">   
                                                    <input type="text" class="form-control" placeholder="' . $result['Username'] . '" aria-label="username" aria-describedby="addon-wrapping"/>
                                                </div>
                                        </div>
                                        <div class="col-6">
                                            <h6 for="name">E-mail:</h6>
                                                <div class="input-group">   
                                                    <input type="e-mail" class="form-control" placeholder="' . $result['Mail'] . '" aria-label="e-mail" aria-describedby="addon-wrapping"/>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-6">
                                        <h6 for="name">Adres:</h6>
                                            <div class="input-group" >   
                                                <input type="text"  class="form-control" placeholder="' . $result['Address'] . '" aria-label="username" aria-describedby="addon-wrapping"/>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                        <h6 for="name">Biyografi:</h6>
                                            <div class="input-group" >   
                                                <input type="text"  class="form-control" placeholder="' . $result['Biography'] . '" aria-label="username" aria-describedby="addon-wrapping"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-6">
                                            <h6 for="name">Parola:</h6>
                                                <div class="input-group">   
                                                    <input type="password" class="form-control" placeholder="Yeni bir parola giriniz" aria-label="username" aria-describedby="addon-wrapping"/>
                                                </div>
                                        </div>
                                        <div class="col-6">
                                            <h6 for="name">Parola Tekrarı:</h6>
                                                <div class="input-group">   
                                                    <input type="password" class="form-control" placeholder="Parolayı tekrar giriniz" aria-label="e-mail" aria-describedby="addon-wrapping"/>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3 justify-content-end">
                                    <div class="col-5 ">
                                            <input type="submit" class="w-100 btn btn-success mt-4" value="Güncelle"/>
                                    </div>
                                    </div>';
                                }



                            
                            ?>
                            </form>
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