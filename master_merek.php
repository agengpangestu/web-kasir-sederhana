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
                    <h1 class="mt-4">Merek</h1>
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <!-- menghitung jumlah merek -->
                                <?php
                                $jumlah_mrk = mysqli_query($conn, "SELECT * FROM master_merek");
                                $data = mysqli_num_rows($jumlah_mrk);
                                ?>
                                <div class="card-body">Jumlah Merek : <?= $data; ?></div>
                            </div>
                        </div>
                    </div>

                    <!-- Button to Open the Modal tambah barang -->
                    <button type="button" class="btn btn-info mb-4" data-bs-toggle="modal" data-bs-target="#merekModal">
                        Tambah Merek
                    </button>

                    <!-- tabel -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Daftar Merek
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Merek</th>
                                        <th>Ket. Merek</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $ambil = mysqli_query($conn, "SELECT * FROM master_merek");
                                    $no = 1;


                                    while ($data = mysqli_fetch_array($ambil)) :
                                        $nama_merek = $data["nama_merek"];
                                    ?>
                                        <tr>
                                            <td><?= $no++; ?>.</td>
                                            <td><?= $data["nama_merek"]; ?></td>
                                            <td><?= $data["ket_merek"]; ?></td>
                                            <td>
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?= $nama_merek; ?>">
                                                    Hapus
                                                </button>
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ubah<?= $nama_merek; ?>">
                                                    Ubah
                                                </button>

                                            </td>
                                        </tr>
                                        <!-- The Modal hapus -->
                                        <div class="modal" id="delete<?= $nama_merek; ?>">
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
                                                            <label for="id">ID Merek</label>
                                                            <input type="text" id="id" name="id" class="form-control mt-2" value="<?= $data["id_merek"]; ?>" placeholder="ID Merek" readonly>
                                                            <label for="nama_merek">Nama Merek</label>
                                                            <input type="text" id="nama_merek" name="nama_merek" class="form-control mt-2" value="<?= $data["nama_merek"]; ?>" placeholder="Nama Merek" readonly>

                                                            <label for="ket_merek">Ket. Merek</label>
                                                            <input type="text" id="ket_merek" name="ket_merek" class="form-control mt-2" value="<?= $data["ket_merek"]; ?>" placeholder="Ket. Merek" readonly>
                                                        </div>
                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-success" name="hapusmrk">Hapus</button>
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- The Modal ubah -->
                                        <div class="modal" id="ubah<?= $nama_merek; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Ubah Merek</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <form method="post">
                                                        <!-- Modal body -->
                                                        <div class="modal-body">
                                                            <label for="id">ID Merek</label>
                                                            <input type="text" id="id" name="id" class="form-control mt-2" value="<?= $data["id_merek"]; ?>" placeholder="ID Merek" readonly>
                                                            <label for="nama_merek">Nama Merek</label>
                                                            <input type="text" id="nama_merek" name="nama_merek" class="form-control mt-2" value="<?= $data["nama_merek"]; ?>" placeholder="Nama Merek">

                                                            <label for="ket_merek">Ket. Merek</label>
                                                            <input type="text" id="ket_merek" name="ket_merek" class="form-control mt-2" value="<?= $data["ket_merek"]; ?>" placeholder="Ket. Merek">
                                                        </div>
                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-success" name="ubahmrk">Ubah</button>
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
<div class="modal" id="merekModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah Merek Baru</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="post">
                <!-- Modal body -->
                <div class="modal-body">

                    <label for="nama_merek">Nama Merek</label>
                    <input type="text" id="nama_merek" name="nama_merek" class="form-control mt-2" placeholder="Nama Merek" required>

                    <label for="ket_merek">Ket. Merek</label>
                    <input type="text" id="ket_merek" name="ket_merek" class="form-control mt-2" placeholder="Ket. Merek">
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" name="tambahmrk">Tambah</button>
                    <button type="reset" class="btn btn-warning">Reset</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>

</html>