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
            Aplikasi Kasir
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
                    <h1 class="mt-4">Barang</h1>
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <!-- menghitung jumlah barang -->
                                <?php
                                $jumlah_brg = mysqli_query($conn, "SELECT * FROM master_barang");
                                $data = mysqli_num_rows($jumlah_brg);
                                ?>
                                <div class="card-body">Jumlah Barang : <?= $data; ?></div>
                            </div>
                        </div>
                    </div>

                    <!-- Button to Open the Modal -->
                    <button type="button" class="btn btn-info mb-4" data-bs-toggle="modal" data-bs-target="#barangModal">
                        Tambah Barang
                    </button>



                    <!-- tabel -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Daftar Barang
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Kode Barang</th>
                                        <th>Kategori</th>
                                        <th>Merek</th>
                                        <th>Nama Barang</th>
                                        <th>Stok</th>
                                        <th>Harga Beli</th>
                                        <th>Harga Jual</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $ambil = "SELECT master_barang.id_barang,
                                             master_barang.kode_barang,

                                             master_kategori.id_kategori,
                                             master_kategori.nama_kategori,
                                             
                                             master_merek.id_merek,
                                             master_merek.nama_merek,

                                             master_barang.nama_barang,
                                             master_barang.harga,
                                             master_barang.harga_jual,
                                             master_barang.stok
                                             FROM master_barang INNER JOIN master_kategori ON master_barang.kategori = master_kategori.id_kategori
                                             JOIN master_merek ON master_barang.merek = master_merek.id_merek";

                                    $barang = mysqli_query($conn, $ambil);
                                    while ($data = mysqli_fetch_array($barang)) :
                                        $id_brg = $data["id_barang"];

                                    ?>
                                        <tr>
                                            <td><?= $no++; ?>.</td>
                                            <td><?= $data["kode_barang"]; ?></td>
                                            <td><?= $data["nama_kategori"]; ?></td>
                                            <td><?= $data["nama_merek"]; ?></td>
                                            <td><?= $data["nama_barang"]; ?></td>
                                            <td><?= $data["stok"]; ?></td>
                                            <td>Rp.<?= number_format($data["harga"]); ?>,-</td>
                                            <td>Rp.<?= number_format($data["harga_jual"]); ?>,-</td>
                                            <td>
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?= $id_brg; ?>">
                                                    Hapus
                                                </button>
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ubah<?= $id_brg; ?>">
                                                    Ubah
                                                </button>
                                            </td>
                                        </tr>
                                        <!-- The Modal Hapus-->
                                        <div class="modal" id="delete<?= $id_brg; ?>">
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
                                                            <label for="id">ID Barang</label>
                                                            <input type="text" id="id" name="id" value="<?= $data['id_barang']; ?>" class="form-control" readonly>
                                                            <label for="kode_barang">Kode Barang</label>
                                                            <input type="text" id="kode_barang" name="kode_barang" value="<?= $data['kode_barang']; ?>" class="form-control" readonly>
                                                            <!-- dropdown -->
                                                            <label for="kategori">Kategori</label>
                                                            <input type="text" id="kategori" name="kategori" value="<?= $data['nama_kategori']; ?>" class="form-control" readonly>

                                                            <label for="merek">Merek</label>
                                                            <input type="text" id="merek" name="merek" value="<?= $data['nama_merek']; ?>" class="form-control" readonly>
                                                            <!-- dropdown -->
                                                            <label for="nama_barang">Nama Barang</label>
                                                            <input type="text" id="nama_barang" name="nama_barang" value="<?= $data['nama_barang']; ?>" class="form-control mt-2" readonly>

                                                            <label for="stok">Stok</label>
                                                            <input type="number" id="stok" name="stok" value="<?= $data['stok']; ?>" class="form-control mt-2" min="1" readonly>

                                                            <label for="harga">Harga Beli</label>
                                                            <input type="number" name="harga" id="harga" value="<?= $data['harga']; ?>" class="form-control mt-2" readonly>

                                                            <label for="harga_jual">Harga Jual</label>
                                                            <input type="number" name="h_jual" id="harga_jual" value="<?= $data['harga_jual']; ?>" class="form-control mt-2" readonly>
                                                        </div>

                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-success" name="hapusbrg">Hapus</button>
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                                        </div>

                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                        <!-- The Modal Ubah-->
                                        <div class="modal" id="ubah<?= $id_brg; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Ubah Barang</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>

                                                    <form method="post">

                                                        <!-- Modal body -->
                                                        <div class="modal-body">
                                                            <label for="id">ID Barang</label>
                                                            <input type="text" id="id" name="id" value="<?= $data['id_barang']; ?>" class="form-control" readonly>
                                                            <label for="kode_barang">Kode Barang</label>
                                                            <input type="text" id="kode_barang" name="kode_barang" value="<?= $data['kode_barang']; ?>" class="form-control" readonly>
                                                            <!-- dropdown -->
                                                            <label for="kategori">Kategori</label>
                                                            <select class="form-select mt-2" id="kategori" name="kategori" required>
                                                                <?php
                                                                // mengambil data dari database tabel master_kategori
                                                                $ambil = mysqli_query($conn, "SELECT * FROM master_kategori");
                                                                while ($ktg = mysqli_fetch_array($ambil)) :
                                                                    //cara 1
                                                                    // kategori yang di pakai
                                                                    $select = ($data["id_kategori"] == $ktg["id_kategori"]) ? "selected"  : ""; ?>
                                                                    <!-- $select dipakai diluar value -->
                                                                    <option value="<?= $ktg["id_kategori"]; ?>" <?= $select; ?>>
                                                                        <?= $ktg["nama_kategori"]; ?>
                                                                    </option>
                                                                <?php endwhile; ?>
                                                            </select>
                                                            <!-- dropdown -->
                                                            <label for="merek">Merek</label>
                                                            <select class="form-select mt-2" id="merek" name="merek">
                                                                <!-- cara 2 -->
                                                                <?php
                                                                // mengambil data dari database tabel master_merek
                                                                $ambil = mysqli_query($conn, "SELECT * FROM master_merek");
                                                                while ($mrk = mysqli_fetch_array($ambil)) :
                                                                    $select = ($data["id_merek"] == $mrk["id_merek"]) ? "selected" : ""; ?>

                                                                    <option value="<?= $mrk["id_merek"]; ?>" <?= $select; ?>>
                                                                        <?= $mrk["nama_merek"]; ?>
                                                                    </option>

                                                                <?php endwhile; ?>
                                                            </select>

                                                            <label for="nama_barang">Nama Barang</label>
                                                            <input type="text" id="nama_barang" name="nama_barang" value="<?= $data['nama_barang']; ?>" class="form-control mt-2" required>

                                                            <label for="stok">Stok</label>
                                                            <input type="number" id="stok" name="stok" value="<?= $data['stok']; ?>" class="form-control mt-2" min="1" readonly>

                                                            <label for="harga">Harga Beli</label>
                                                            <input type="number" name="harga" id="harga" value="<?= $data['harga']; ?>" class="form-control mt-2" required>

                                                            <label for="harga_jual">Harga Jual</label>
                                                            <input type="number" name="h_jual" id="harga_jual" value="<?= $data['harga_jual']; ?>" class="form-control mt-2" required>
                                                        </div>

                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-success" name="ubahbrg">Ubah</button>
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
<!-- The Modal Tambah aman-->
<div class="modal" id="barangModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah Barang Baru</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form method="post">

                <!-- Modal body -->
                <div class="modal-body">
                    <label for="kode_barang">Kode Barang</label>
                    <input type="text" id="kode_barang" name="kode_barang" class="form-control" placeholder="Kode Barang">
                    <!-- dropdown -->
                    <label for="kategori">Kategori</label>
                    <select class="form-select mt-2" id="kategori" name="kategori" required>
                        <option selected>Pilih Kategori</option>

                        <?php
                        // mengambil data dari database tabel master_kategori
                        $ambil = mysqli_query($conn, "SELECT * FROM master_kategori");
                        while ($ktg = mysqli_fetch_array($ambil)) : ?>

                            <option value="<?= $ktg["id_kategori"]; ?>" required>
                                <?= $ktg["nama_kategori"]; ?>
                            </option>

                        <?php endwhile; ?>
                    </select>
                    <label for="merek">Merek</label>
                    <select class="form-select mt-2" id="merek" name="merek">
                        <option selected>Pilih Merek</option>

                        <?php
                        // mengambil data dari database tabel master_merek
                        $kueri = mysqli_query($conn, "SELECT * FROM master_merek");
                        while ($mrk = mysqli_fetch_array($kueri)) : ?>

                            <option value="<?= $mrk["id_merek"]; ?>">
                                <?= $mrk["nama_merek"]; ?>
                            </option>

                        <?php endwhile; ?>
                    </select>
                    <!-- dropdown -->
                    <label for="nama_barang">Nama Barang</label>
                    <input type="text" id="nama_barang" name="nama_barang" class="form-control mt-2" placeholder="Nama Barang">

                    <label for="stok">Stok</label>
                    <input type="number" id="stok" name="stok" class="form-control mt-2" min="1" placeholder="Stok">

                    <label for="harga">Harga Beli</label>
                    <input type="number" name="harga" id="harga" class="form-control mt-2" placeholder="Harga Beli">

                    <label for="harga_jual">Harga Jual</label>
                    <input type="number" name="h_jual" id="harga_jual" class="form-control mt-2" placeholder="Harga Jual">
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" name="buttontambah">Tambah</button>
                    <button type="reset" class="btn btn-warning">Reset</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                </div>

            </form>

        </div>
    </div>
</div>

</html>