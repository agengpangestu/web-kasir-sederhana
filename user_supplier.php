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
                        <a class="nav-link" href="user.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                            Barang
                        </a>
                        <a class="nav-link" href="user_kategori.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-archive"></i></div>
                            Kategori
                        </a>
                        <a class="nav-link" href="user_merek.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tags"></i></div>
                            Merek
                        </a>
                        <a class="nav-link" href="user_satuan.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-pie"></i></div>
                            Satuan
                        </a>
                        <a class="nav-link" href="user_supplier.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-dolly"></i></div>
                            Supplier
                        </a>

                        <!-- jarak -->
                        <br><br>

                        <a class="nav-link" href="user_pembelian.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>
                            Pembelian
                        </a>

                        <!-- jarak -->
                        <br>

                        <a class="nav-link" href="user_penjualan.php">
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
                    <h5>User</h5>
                </div>
            </nav>
        </div>

        <!-- halaman konten -->
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Supplier</h1>
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <!-- menghitung jumlah supplier -->
                                <?php
                                $jumlah_sp = mysqli_query($conn, "SELECT * FROM master_supplier");
                                $data = mysqli_num_rows($jumlah_sp);
                                ?>
                                <div class="card-body">Jumlah Supplier : <?= $data; ?></div>
                            </div>
                        </div>
                    </div>



                    <!-- Button to Open the Modal tambah barang -->
                    <button type="button" class="btn btn-info mb-4" data-bs-toggle="modal" data-bs-target="#supplierModal">
                        Tambah Supplier
                    </button>

                    <!-- tabel -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Daftar Supplier
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Kode Supplier</th>
                                        <th>Nama Supplier</th>
                                        <th>Kabupaten/Kota</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $ambil = mysqli_query($conn, "SELECT * FROM master_supplier");
                                    $i = 1;


                                    while ($data = mysqli_fetch_array($ambil)) :
                                        $idsp = $data["id_supplier"];
                                        $kode_sp = $data["kode_supplier"];
                                        $nama_sp = $data["nama_supplier"];
                                        $kab = $data["kab_kota"];
                                    ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $kode_sp; ?></td>
                                            <td><?= $nama_sp; ?></td>
                                            <td><?= $kab; ?></td>
                                            <td>
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?= $idsp; ?>">
                                                    Hapus
                                                </button>
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ubah<?= $idsp; ?>">
                                                    Ubah
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- The Modal hapus -->
                                        <div class="modal" id="delete<?= $idsp; ?>">
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
                                                            <label for="id_supplier">ID Supplier</label>
                                                            <input type="text" name="id_supplier" id="id_supplier" value="<?= $data['id_supplier']; ?>" class="form-control mt-2" placeholder="Kode Supplier" readonly required>
                                                            <label for="kode_supplier">Kode Supplier</label>
                                                            <input type="text" name="kode_supplier" id="kode_supplier" value="<?= $data['kode_supplier']; ?>" class="form-control mt-2" placeholder="Kode Supplier" readonly required>
                                                            <label for="nama_supplier">Nama Supplier</label>
                                                            <input type="text" name="nama_supplier" id="nama_supplier" value="<?= $data['nama_supplier']; ?>" class="form-control mt-2" placeholder="Nama Supplier" readonly required>
                                                            <label for="kab">Kab/Kota</label>
                                                            <input type="text" name="kab_kota" id="kab" value="<?= $data['kab_kota']; ?>" class="form-control mt-2" placeholder="Kab/Kota" readonly required>
                                                        </div>
                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-success" name="hapusspuser">Hapus</button>
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- The Modal Ubah -->
                                        <div class="modal" id="ubah<?= $idsp; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Ubah Supplier</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <form method="post">
                                                        <!-- Modal body -->
                                                        <div class="modal-body">
                                                            <label for="id_supplier">ID Supplier</label>
                                                            <input type="text" name="id_supplier" id="id_supplier" value="<?= $data['id_supplier']; ?>" class="form-control mt-2" placeholder="Kode Supplier" readonly required>
                                                            <label for="kode_supplier">Kode Supplier</label>
                                                            <input type="text" name="kode_supplier" id="kode_supplier" value="<?= $data['kode_supplier']; ?>" class="form-control mt-2" placeholder="Kode Supplier" readonly required>
                                                            <label for="nama_supplier">Nama Supplier</label>
                                                            <input type="text" name="nama_supplier" id="nama_supplier" value="<?= $data['nama_supplier']; ?>" class="form-control mt-2" placeholder="Nama Supplier" required>
                                                            <label for="kab">Kab/Kota</label>
                                                            <input type="text" name="kab_kota" id="kab" value="<?= $data['kab_kota']; ?>" class="form-control mt-2" placeholder="Kab/Kota" required>
                                                        </div>
                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-success" name="ubahspuser">Ubah</button>
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
<div class="modal" id="supplierModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah Supplier Baru</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="post">
                <!-- Modal body -->
                <div class="modal-body">
                    <label for="kode_supplier">Kode Supplier</label>
                    <input type="text" name="kode_supplier" id="kode_supplier" class="form-control mt-2" placeholder="Kode Supplier" required>
                    <label for="nama_supplier">Nama Supplier</label>
                    <input type="text" name="nama_supplier" id="nama_supplier" class="form-control mt-2" placeholder="Nama Supplier" required>
                    <label for="kab">Kab/Kota</label>
                    <input type="text" name="kab_kota" id="kab" class="form-control mt-2" placeholder="Kab/Kota" required>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" name="tambahspuser">Tambah</button>
                    <button type="reset" class="btn btn-warning">Reset</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>

</html>