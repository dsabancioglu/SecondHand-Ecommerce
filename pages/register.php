<?php ob_start(); ?>
<html>

<head>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
</head>

<body>
    <!-- header -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light p-3">
        <div class="container">
            <a class="navbar-brand main-color" href="./home.php">
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
                                <form class="d-flex align-items-center justify-content-center">
                                    <div class="input-group">
                                        <input type="search" class="form-control" placeholder="Aradığınız ürün, kategori veya markayı yazın" />
                                        <button class="btn btn-outline-secondary" type="button">
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
                <div class="d-flex">
                            <a class="text-decoration-none main-color" href="login.php">
                                <h6>Giriş Yap | </h6>
                            </a>
                            <a class="text-decoration-none main-color" href="register.php" style="margin-left: 5px;">
                                <h6> ÜYE OL </h6>
                            </a>
                </div>
            </div>
        </div>
    </nav>
    <!-- header -->

    <div class="container mt-5 mb-5">
        <div class="row d-flex align-items-center justify-content-center text-center">
            <div class="welcome-text">
                <h4>Merhaba,</h4>
                <p>Dolap’a giriş yap veya hesap oluştur, fırsatları kaçırma!</p>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-4">
            <div class="w-40 row no-gutters">
                <div class="col">
                    <div class="d-flex justify-content-center align-items-center p-2">
                        <a href="login.php" class="text-decoration-none text-dark">
                            <h5>Giriş</h5>
                        </a>
                    </div>
                </div>
                <div class="col">
                    <div class="d-flex justify-content-center align-items-center p-2 active-link">
                        <a href="register.php" class="text-decoration-none main-color">
                            <h5>Üye Ol</h5>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <div class="w-40 row no-gutters box p-5">
                <form method="POST" action="register.php">
                    <div class="form-group d-flex flex-column align-items-start mb-2">

                        <?php

                        include "../dao/connection.php";

                        if (isset($_POST['submitButton'])) {
                            $Name = $_POST['name'];
                            $Surname = $_POST['surname'];
                            $Mail = $_POST['e-mail'];
                            $Password = $_POST['password'];
                            $Username = $_POST['username'];

                            $validation = mysqli_query($connection, "SELECT Username, Mail from users");

                            $check = true;
                            while ($str = mysqli_fetch_array($validation)) {
                                if ($str['Username'] == $Username) {
                                    echo '<p class="alert alert-danger w-100">Bu kullanıcı adı alınamıyor. Lütfen başka bir kullanıcı adı deneyiniz.</p>';
                                    $check = false;
                                    break;
                                }
                                if ($str['Mail'] == $Mail) {
                                    echo '<p class="alert alert-danger w-100">Bu mail adresine ait mevcut hesap bulunmaktadır.</p>';
                                    $check = false;
                                    break;
                                }
                            }

                            if ($check) {
                                $save = mysqli_query($connection, "INSERT into users (Name, Surname, Mail, Password,Username) values ('$Name', '$Surname','$Mail', '$Password','$Username')") or die("Hata: kayıt işlemi gerçekleşemedi.");
                                setcookie('username', $Username, time() + (60 * 5), '/');
                                header("Location: http://localhost:81/dolap/pages/home.php");
                                exit;
                            }
                        }

                        ?>
                        </p>
                        <h6 for="exampleInputEmail1">Kullanıcı Adı</h6>
                        <input type="text" name="username" class="form-control" aria-describedby="emailHelp" />
                    </div>
                    <div class="form-group d-flex flex-column align-items-start mb-2">
                        <h6 for="exampleInputEmail1">E-mail</h6>
                        <input type="email" name="e-mail" class="form-control" aria-describedby="emailHelp" />
                    </div>
                    <div class="form-group d-flex flex-column align-items-start mb-2">
                        <h6 for="exampleInputEmail1">Ad</h6>
                        <input type="text" name="name" class="form-control" aria-describedby="emailHelp" />
                    </div>
                    <div class="form-group d-flex flex-column align-items-start mb-2">
                        <h6 for="exampleInputEmail1">Soyad</h6>
                        <input type="text" name="surname" class="form-control" aria-describedby="emailHelp" />
                    </div>
                    <div class="form-group d-flex flex-column align-items-start mb-3">
                        <h6 for="exampleInputPassword1">Parola</h6>
                        <input type="password" name="password" class="form-control" />
                    </div>

                    <button type="submit" name="submitButton" class="w-100 btn btn-orange mt-4">Kaydol</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>
<?php ob_flush(); ?>