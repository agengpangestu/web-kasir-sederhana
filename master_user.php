<?php
session_start();

require "function.php";

if (!isset($_SESSION["login"])) {
    header("location:login.php");
    exit;
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
    <title>Kasir Toko</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <!-- kasih logo disini -->
        <a class="navbar-brand ps-3" href="index.php">
            <img src="">Aplikasi Kasir
        </a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>

    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <!-- bagian menu -->
                        <div class="sb-sidenav-menu-heading">Menu</div>
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                            Barang
                        </a>
                        <a class="nav-link" href="master_kategori.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-archive"></i></div>
                            Kategori
                        </a>
                        <a class="nav-link" href="master_merek.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tags"></i></div>
                            Merek
                        </a>
                        <a class="nav-link" href="master_satuan.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-pie"></i></div>
                            Satuan
                        </a>
                        <a class="nav-link" href="master_supplier.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-dolly"></i></div>
                            Supplier
                        </a>
                        <a class="nav-link" href="master_user.php">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i></div>
                            User
                        </a>

                        <!-- jarak -->
                        <br><br>

                        <a class="nav-link" href="master_pembelian.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>
                            Pembelian
                        </a>

                        <!-- jarak -->
                        <br>

                        <a class="nav-link" href="master_penjualan.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-cash-register"></i></div>
                            Penjualan
                        </a>

                        <!-- jarak -->
                        <br><br>

                        <a class="nav-link" href="logout.php">
                            Logout
                        </a>


                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <!-- buat koneksi ke user -->
                    <div class="small">Logged in as:</div>
                    <h5>Admin</h5>
                </div>
            </nav>
        </div>

        <!-- halaman konten -->
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">User</h1>
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <!-- menghitung jumlah user -->
                                <?php
                                $jumlah_user = mysqli_query($conn, "SELECT * FROM master_user");
                                $data = mysqli_num_rows($jumlah_user);
                                ?>
                                <div class="card-body">Jumlah User : <?= $data; ?></div>
                            </div>
                        </div>
                    </div>

                    <!-- Button to Open the Modal tambah user -->
                    <button type="button" class="btn btn-info mb-4" data-bs-toggle="modal" data-bs-target="#userModal">
                        Tambah User
                    </button>

                    <!-- tabel -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            User
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Username</th>
                                        <th>Password</th>
                                        <th>Fullname</th>
                                        <th>Level</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    //menampilkan data
                                    $no = 1;
                                    $tampil = mysqli_query($conn, "SELECT * FROM master_user");
                                    while ($data = mysqli_fetch_array($tampil)) :
                                        $id = $data["id_user"];
                                    ?>
                                        <tr>
                                            <td><?= $no++; ?>.</td>
                                            <td><?= $data["username"]; ?></td>
                                            <td><?= $data["pw"]; ?></td>
                                            <td><?= $data["full_name"]; ?></td>
                                            <td><?= $data["level"]; ?></td>
                                            <td>
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?= $data["id_user"]; ?>">
                                                    Hapus
                                                </button>
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ubah<?= $data["id_user"]; ?>">
                                                    Ubah
                                                </button>
                                            </td>
                                        </tr>
                                        <!-- The Modal hapus -->
                                        <div class="modal" id="delete<?= $data["id_user"]; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Yakin ingin menghapus?</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <form method="post">
                                                        <!-- Modal body -->
                                                        <div class="modal-body">
                                                            <label for="id">ID Username</label>
                                                            <input type="text" name="id" id="id" class="form-control mt-2" value="<?= $data["id_user"]; ?>" placeholder="ID Username" readonly>

                                                            <label for="username">Username</label>
                                                            <input type="text" name="username" id="username" class="form-control mt-2" value="<?= $data["username"]; ?>" placeholder="Username" readonly>

                                                            <label for="pw">Password</label>
                                                            <input type="text" name="pw" id="pw" class="form-control mt-2" value="<?= $data["pw"]; ?>" placeholder="Password" readonly>

                                                            <label for="re_pw">Konfirmasi Password</label>
                                                            <input type="text" name="re_pw" id="re_pw" class="form-control mt-2" value="<?= $data["pw"]; ?>" placeholder="Konfirmasi Password" readonly>

                                                            <label for="full_name">Nama</label>
                                                            <input type="text" name="full_name" id="full_name" class="form-control mt-2" value="<?= $data["full_name"]; ?>" placeholder="Nama" readonly>

                                                            <label for="level">Level</label>
                                                            <input type="text" name="level" id="level" class="form-control mt-2" value="<?= $data["level"]; ?>" placeholder="Level" readonly>


                                                        </div>
                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-success" name="hapususer">Hapus</button>
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- The Modal Ubah -->
                                        <div class="modal" id="ubah<?= $data["id_user"]; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Ubah User</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <form method="post">
                                                        <!-- Modal body -->
                                                        <div class="modal-body">
                                                            <label for="id">ID Username</label>
                                                            <input type="text" name="id" id="id" class="form-control mt-2" value="<?= $data["id_user"]; ?>" placeholder="ID Username" readonly>

                                                            <label for="username">Username</label>
                                                            <input type="text" name="username" id="username" class="form-control mt-2" value="<?= $data["username"]; ?>" placeholder="Username" required>

                                                            <label for="pw">Password</label>
                                                            <input type="text" name="pw" id="pw" class="form-control mt-2" value="<?= $data["pw"]; ?>" placeholder="Password" required>

                                                            <label for="re_pw">Konfirmasi Password</label>
                                                            <input type="text" name="re_pw" id="re_pw" class="form-control mt-2" value="<?= $data["pw"]; ?>" placeholder="Konfirmasi Password" required>

                                                            <label for="full_name">Nama</label>
                                                            <input type="text" name="full_name" id="full_name" class="form-control mt-2" value="<?= $data["full_name"]; ?>" placeholder="Nama" required>

                                                            <label for="level">Level</label>
                                                            <input type="text" name="level" id="level" class="form-control mt-2" value="<?= $data["level"]; ?>" placeholder="Level" required>


                                                        </div>
                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-success" name="ubahuser">Ubah</button>
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

<!-- The Modal tambah -->
<div class="modal" id="userModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah User Baru</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="post">
                <!-- Modal body -->
                <div class="modal-body">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" class="form-control mt-2" placeholder="Username" required>

                    <label for="pw">Password</label>
                    <input type="password" name="pw" id="pw" class="form-control mt-2" placeholder="Password" required>

                    <label for="re_pw">Konfirmasi Password</label>
                    <input type="password" name="re_pw" id="re_pw" class="form-control mt-2" placeholder="Konfirmasi Password" required>

                    <label for="full_name">Nama</label>
                    <input type="text" name="full_name" id="full_name" class="form-control mt-2" placeholder="Nama" required>

                    <label for="level">Level</label>
                    <input type="text" name="level" id="level" class="form-control mt-2" placeholder="Level" required>


                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" name="tambahuser">Tambah</button>
                    <button type="reset" class="btn btn-warning">Reset</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>

</html>