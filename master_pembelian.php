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
                    <h1 class="mt-4">Pembelian</h1>
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <!-- menghitung jumlah barang -->
                                <?php
                                $jumlah = mysqli_query($conn, "SELECT * FROM master_pembelian");
                                $data = mysqli_num_rows($jumlah);
                                ?>
                                <div class="card-body">Jumlah Pembelian : <?= $data; ?></div>
                            </div>
                        </div>
                    </div>

                    <!-- Button to Open the Modal -->
                    <button type="button" class="btn btn-info mb-4" data-bs-toggle="modal" data-bs-target="#pembelianModal">
                        <i class="fas fa-shopping-cart"></i> Tambah Pembelian
                    </button>

                    <!-- Button laporan -->
                    <a href="cetak_pembelian.php">
                        <button type="button" class="btn btn-secondary mb-4">Laporan</button>
                    </a>

                    <!-- tabel -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Pembelian
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Kode Pembelian</th>
                                        <th>Barang</th>
                                        <th>Jumlah</th>
                                        <th>Satuan</th>
                                        <th>Supplier</th>
                                        <th>Harga</th>
                                        <th>Tanggal</th>
                                        <th>Sub-total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $kueri = "SELECT master_pembelian.id_pembelian,
                                                        master_pembelian.kode_pembelian,
                                                        master_barang.id_barang,
                                                        master_barang.kode_barang,
                                                        master_barang.nama_barang,
                                                        master_barang.stok,
                                                        master_pembelian.jumlah,
                                                        master_satuan.id_satuan,
                                                        master_satuan.nama_satuan,
                                                        master_supplier.id_supplier,
                                                        master_supplier.nama_supplier,
                                                        master_supplier.kab_kota,
                                                        master_pembelian.harga,
                                                        master_pembelian.tanggal
                                                    FROM master_pembelian INNER JOIN master_barang ON master_pembelian.barang = master_barang.id_barang
                                                                                JOIN master_satuan ON master_pembelian.satuan = master_satuan.id_satuan
                                                                                JOIN master_supplier ON master_pembelian.supplier = master_supplier.id_supplier";


                                    $ambil = mysqli_query($conn, $kueri) or die(mysqli_error($conn));
                                    while ($data = mysqli_fetch_array($ambil)) :
                                        $id = $data["id_pembelian"];
                                        $subtotal = $data["jumlah"] * $data["harga"];
                                    ?>

                                        <tr>
                                            <td><?= $no++; ?>.</td>
                                            <td><?= $data["kode_pembelian"]; ?></td>
                                            <td><?= $data["kode_barang"]; ?> - <?= $data["nama_barang"]; ?></td>
                                            <td><?= $data["jumlah"]; ?></td>
                                            <td><?= $data["nama_satuan"]; ?></td>
                                            <td><?= $data["nama_supplier"]; ?> - <?= $data["kab_kota"]; ?></td>
                                            <td>Rp.<?= number_format($data["harga"]); ?>,-</td>
                                            <td><?= $data["tanggal"]; ?></td>
                                            <td>Rp.<?= number_format($subtotal); ?>,-</td>
                                            <td>
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?= $id; ?>">
                                                    Hapus
                                                </button>
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ubah<?= $id; ?>">
                                                    Ubah
                                                </button>
                                            </td>
                                        </tr>
                                        <!-- The Modal Hapus -->
                                        <div class="modal" id="delete<?= $id; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Yakin ingin menghapus?</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>

                                                    <form method="post">

                                                        <!-- Modal body Hapus-->
                                                        <div class="modal-body">
                                                            <label for="id">ID Pembelian</label>
                                                            <input type="text" id="id" name="id" class="form-control" value="<?= $data["id_pembelian"]; ?>" placeholder="ID Pembelian" readonly>
                                                            <label for="kode_pembelian">Kode Pembelian</label>
                                                            <input type="text" id="kode_pembelian" name="kode_pembelian" value="<?= $data["kode_pembelian"]; ?>" class="form-control" placeholder="Kode Pembelian" readonly>

                                                            <label for="barang">Barang</label>
                                                            <input type="text" id="barang" name="barang" class="form-control mt-2" value="<?= $data["id_barang"]; ?> - <?= $data["kode_barang"]; ?> - <?= $data["nama_barang"]; ?> - <?= $data["stok"]; ?>" placeholder="Kode Barang" readonly>


                                                            <label for="jumlah">Jumlah</label>
                                                            <input type="number" name="jumlah" id="jumlah" class="form-control mt-2" value="<?= $data["jumlah"]; ?>" min="1" value="" placeholder="Jumlah" readonly>

                                                            <label for="satuan">Satuan</label>
                                                            <input type="text" name="satuan" id="satuan" class="form-control mt-2" value="<?= $data["nama_satuan"]; ?>" readonly>

                                                            <label for="supplier">Supplier</label>
                                                            <input type="text" name="supplier" id="supplier" class="form-control mt-2" value="<?= $data["nama_supplier"]; ?> - <?= $data["kab_kota"]; ?>" readonly>

                                                            <label for="harga">Harga</label>
                                                            <input type="num" name="harga" id="harga" class="form-control mt-2" value="<?= $data["harga"]; ?>" placeholder="Harga" readonly>

                                                            <label for="tanggal">Tanggal</label>
                                                            <input type="text" id="tanggal" name="tanggal" class="form-control mt-2" value="<?= $data["tanggal"]; ?>" placeholder="Tanggal" readonly>
                                                            <label for="total">Sub-total</label>
                                                            <input type="text" id="total" name="total" class="form-control mt-2" value="<?= $subtotal; ?>" readonly>
                                                        </div>

                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-success" name="hpspembelian">Hapus</button>
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                                        </div>

                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                        <!-- The Modal Ubah -->
                                        <div class="modal" id="ubah<?= $id; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Ubah Pembelian</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>

                                                    <form method="post">

                                                        <!-- Modal body Ubah-->
                                                        <div class="modal-body">
                                                            <label for="id">ID Pembelian</label>
                                                            <input type="text" id="id" name="id" class="form-control" value="<?= $data["id_pembelian"]; ?>" readonly>
                                                            <label for="kode_pembelian">Kode Pembelian</label>
                                                            <input type="text" id="kode_pembelian" name="kode_pembelian" value="<?= $data["kode_pembelian"]; ?>" class="form-control" placeholder="Kode Pembelian" readonly>

                                                            <label for="barang">Barang</label>
                                                            <select class="form-select mt-2" id="barang" name="barang" required>
                                                                <?php
                                                                $kueri = mysqli_query($conn, "SELECT * FROM master_barang");
                                                                while ($brg = mysqli_fetch_array($kueri)) :
                                                                    $select = ($data["id_barang"] == $brg["id_barang"]) ? "selected" : "";
                                                                ?>
                                                                    <option value="<?= $brg['id_barang']; ?> " <?= $select; ?>>
                                                                        <?= $brg['kode_barang']; ?> - <?= $brg['nama_barang']; ?> - <?= $brg['stok']; ?>
                                                                    </option>
                                                                <?php endwhile; ?>
                                                            </select>


                                                            <label for="jumlah">Jumlah</label>
                                                            <input type="number" name="jumlah" id="jumlah" class="form-control mt-2" value="<?= $data["jumlah"]; ?>" min="1" value="" placeholder="Jumlah" required>

                                                            <label for="satuan">Satuan</label>
                                                            <select class="form-select mt-2" id="satuan" name="satuan" required>
                                                                <?php
                                                                $kueri = mysqli_query($conn, "SELECT * FROM master_satuan");
                                                                while ($satuan = mysqli_fetch_array($kueri)) :
                                                                    $select = ($data["id_satuan"] == $satuan["id_satuan"]) ? "selected" : "";
                                                                ?>
                                                                    <option value="<?= $satuan['id_satuan']; ?> " <?= $select; ?>>
                                                                        <?= $satuan['nama_satuan']; ?>
                                                                    </option>
                                                                <?php endwhile; ?>
                                                            </select>

                                                            <label for="supplier">Supplier</label>
                                                            <select class="form-select mt-2" id="supplier" name="supplier" required>
                                                                <?php
                                                                $kueri = mysqli_query($conn, "SELECT * FROM master_supplier");
                                                                while ($sp = mysqli_fetch_array($kueri)) :
                                                                    $select = ($data["id_supplier"] == $sp["id_supplier"]) ? "selected" : "";
                                                                ?>
                                                                    <option value="<?= $sp['id_supplier']; ?> " <?= $select; ?>>
                                                                        <?= $sp['nama_supplier']; ?> - <?= $sp['kab_kota']; ?>
                                                                    </option>
                                                                <?php endwhile; ?>
                                                            </select>

                                                            <label for="harga">Harga</label>
                                                            <input type="num" name="harga" id="harga" class="form-control mt-2" value="<?= $data["harga"]; ?>" placeholder="Harga" required>

                                                            <label for="tanggal">Tanggal</label>
                                                            <input type="date" id="tanggal" name="tanggal" class="form-control mt-2" value="<?= $data["tanggal"]; ?>" placeholder="Tanggal" readonly>

                                                        </div>

                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-success" name="ubahpembelian">Ubah</button>
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
            <!-- footer index -->
            <!-- <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2022</div>
                    </div>
                </div>
            </footer> -->
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
<div class="modal" id="pembelianModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah Pembelian</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form method="post">

                <!-- Modal body -->
                <div class="modal-body">
                    <label for="kode_pembelian">Kode Pembelian</label>
                    <input type="text" id="kode_pembelian" name="kode_pembelian" class="form-control" placeholder="Kode Pembelian" required>

                    <label for="barang">Barang</label>
                    <select class="form-select mt-2" id="barang" name="id_barang" required>
                        <option selected>Pilih Barang</option>

                        <?php
                        // mengambil data dari database tabel master_barang
                        $ambil = mysqli_query($conn, "SELECT * FROM master_barang");
                        while ($ktg = mysqli_fetch_array($ambil)) : ?>

                            <option value="<?= $ktg["id_barang"]; ?>">
                                <?= $ktg["kode_barang"]; ?> - <?= $ktg["nama_barang"]; ?> - <?= $ktg["stok"]; ?>
                            </option>

                        <?php endwhile; ?>
                    </select>

                    <!-- <label for="barang">Barang</label>
                    <input type="text" id="barang" name="barang" class="form-control mt-2" placeholder="Kode Barang"> -->

                    <!-- <label for="nama_barang">Nama Barang</label>
                    <input type="text" name="nama_barang" id="nama_barang" class="form-control mt-2" placeholder="Nama Barang"> -->

                    <label for="jumlah">Jumlah</label>
                    <input type="number" name="jumlah" id="jumlah" class="form-control mt-2" min="1" value="" placeholder="Jumlah" required>



                    <label for="satuan">Satuan</label>
                    <select class="form-select mt-2" id="satuan" name="satuan" required>
                        <option selected>Pilih Satuan</option>

                        <?php
                        // mengambil data dari database tabel master_kategori
                        $ambil = mysqli_query($conn, "SELECT * FROM master_satuan");
                        while ($ktg = mysqli_fetch_array($ambil)) : ?>

                            <option value="<?= $ktg["id_satuan"]; ?>">
                                <?= $ktg["nama_satuan"]; ?>
                            </option>

                        <?php endwhile; ?>
                    </select>

                    <label for="supplier">Supplier</label>
                    <select class="form-select mt-2" id="supplier" name="supplier" required>
                        <option selected>Pilih Supplier</option>

                        <?php
                        // mengambil data dari database tabel master_kategori
                        $ambil = mysqli_query($conn, "SELECT * FROM master_supplier");
                        while ($ktg = mysqli_fetch_array($ambil)) : ?>

                            <option value="<?= $ktg["id_supplier"]; ?>">
                                <?= $ktg["nama_supplier"]; ?> - <?= $ktg["kab_kota"]; ?>
                            </option>

                        <?php endwhile; ?>
                    </select>

                    <label for="harga">Harga</label>
                    <input type="num" name="harga" id="harga" class="form-control mt-2" placeholder="Harga" required>

                    <label for="tanggal">Tanggal</label>
                    <input type="date" id="tanggal" name="tanggal" class="form-control mt-2" placeholder="Tanggal" required>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" name="btnpembelian">Tambah</button>
                    <button type="reset" class="btn btn-warning">Reset</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                </div>

            </form>

        </div>
    </div>
</div>


</html>