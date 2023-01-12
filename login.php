<?php
session_start();
require "function.php";

if (!isset($_SESSION["login"]))

    // if (isset($_POST["login"])) {
    //     $username = $_POST['username'];
    //     $pw = $_POST['pw'];


    //     $ambil = mysqli_query($conn, "SELECT * FROM master_user WHERE username='$username' AND pw='$pw'");
    //     $hitung = mysqli_num_rows($ambil);

    //     if ($hitung) {
    //         //jika data ditemukan
    //         $ambilDataRole = mysqli_fetch_array($ambil);
    //         $level = $ambilDataRole['level'];

    //         if ($level == "admin") {
    //             //kalau di admin
    //             $_SESSION["log"] = "Logged";
    //             $_SESSION["level"] = "admin";
    //             echo "
    // 			<script>
    // 				alert('Login berhasil!');
    //                 window.location.href='index.php'
    // 			</script>
    // 			";
    //             // header("location:index.php");
    //         } else {
    //             //kalau bukan admin
    //             $_SESSION["log"] = "Logged";
    //             $_SESSION["level"] = "user";
    //             echo "
    // 			<script>
    // 				alert('Login berhasil!');
    //                 window.location.href='user.php'
    // 			</script>
    // 			";
    //             // header("location:user.php");
    //         }
    //     } else {
    //         //kalau tidak ditemukan
    //         echo "
    // 			<script>
    // 				alert('Data tidak ditemukan');
    //                 alert('Silahkan login kembali!');
    //                 window.location.href='login.php'
    // 			</script>
    // 			";
    //     }

    // }

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login</title>
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
                                    <h3 class="text-center font-weight-light my-4">Login</h3>
                                </div>
                                <div class="card-body">


                                    <!-- form login -->
                                    <form method="post" action="">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="username" id="username" type="text" placeholder="enter username" required />
                                            <label for="username">Username</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="pw" id="pw" type="password" placeholder="Password" required />
                                            <label for="pw">Password</label>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <button type="submit" name="login" class="btn btn-primary">Login</button>
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