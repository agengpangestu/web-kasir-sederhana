<?php
require "function.php";

// ==registrasi
if (isset($_POST["register"])) {
    $username = $_POST['username'];
    $pw = $_POST['pw'];
    $re_pass = $_POST['re_pass'];
    $full_name = $_POST['full_name'];

    $cek_user = mysqli_query($conn, "SELECT * FROM master_user WHERE username = '$username'");
    $cek_login = mysqli_num_rows($cek_user);

    if ($cek_login > 0) {
        echo "
            <script>
                alert('Username telah terdaftar!');
                window.location.href='registrasi.php'
            </script>
            ";
    } else {
        if ($pw != $re_pass) {
            echo "
            <script>
                alert('Konfirmasi password tidak sesuai!');
                window.location.href='registrasi.php'
            </script>
            ";
        } else {
            $pass = password_hash($pw, PASSWORD_DEFAULT);
            mysqli_query($conn, "INSERT INTO master_user VALUES ('', '$username', '$pass', '$full_name')");
            echo "
            <script>
                alert('Username berhasil terdaftar');
                window.location.href='login.php' 
            </script>
            ";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Registrasi</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="bg-secondary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Registrasi</h3>
                                </div>
                                <div class="card-body">


                                    <!-- form registrasi -->
                                    <form method="post" action="">

                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="username" id="username" type="text" placeholder="Masukan Username" required />
                                            <label for="username">Username</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="pw" id="pw" type="password" placeholder="Password" required />
                                            <label for="pw">Password</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="re_pass" id="re_pass" type="password" placeholder=" Konfirmasi Password" required />
                                            <label for="re_pass">Konfirmasi Password</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="full_name" id="full_name" type="text" placeholder="Masukan Nama" required />
                                            <label for="full_name">Nama</label>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <button type="submit" name="register" class="btn btn-primary">Register</button>
                                        </div>
                                    </form>



                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>

        <!-- footer login -->
        <!-- <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2022</div>
                    </div>
                </div>
            </footer>
        </div> -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>

</html>