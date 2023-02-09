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
                    <h1 class="mt-4">Penjualan</h1>
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <!-- menghitung jumlah barang -->
                                <?php
                                $jumlah = mysqli_query($conn, "SELECT * FROM master_penjualan");
                                $data = mysqli_num_rows($jumlah);
                                ?>
                                <div class="card-body">Jumlah Penjualan : <?= $data; ?></div>
                            </div>
                        </div>
                    </div>


                    <!-- Button to Open the Modal -->
                    <button type="button" class="btn btn-info mb-4" data-bs-toggle="modal" data-bs-target="#penjualanModal">
                        <i class="fas fa-cash-register"></i> Tambah Penjualan
                    </button>
                    <!-- Button laporan -->
                    <a href="cetak_penjualan.php" onclick="return confirm('Ingin mencetak laporan?');">
                        <button type="button" class="btn btn-secondary mb-4">Laporan</button>
                    </a>

                    <!-- tabel -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Penjualan
                        </div>
                        <!-- <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Kode Penjualan</th>
                                        <th>Barang</th>
                                        <th>Jumlah</th>
                                        <th>Satuan</th>
                                        <th>Harga</th>
                                        <th>User</th>
                                        <th>Tanggal</th>
                                        <th>Sub-total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $kueri = "SELECT master_penjualan.id_penjualan,
                                                        master_penjualan.kode_penjualan,
                                                        
                                                        master_barang.id_barang,
                                                        master_barang.kode_barang,
                                                        master_barang.nama_barang,
                                                        master_barang.stok,
                                                        
                                                        master_penjualan.jumlah,
                                                        
                                                        master_satuan.id_satuan,
                                                        master_satuan.nama_satuan,
                                                        
                                                        master_penjualan.harga,
                                                        
                                                        master_user.id_user,
                                                        master_user.full_name,
                                                        
                                                        master_penjualan.tanggal
                                                    FROM master_penjualan INNER JOIN master_barang ON master_penjualan.barang = master_barang.id_barang
                                                                                JOIN master_satuan ON master_penjualan.satuan = master_satuan.id_satuan
                                                                                JOIN master_user ON master_penjualan.user = master_user.id_user";

                                    $ambil = mysqli_query($conn, $kueri) or die(mysqli_error($conn));
                                    while ($data = mysqli_fetch_array($ambil)) :
                                        $id_pj = $data["id_penjualan"];
                                        $subtotal = $data["jumlah"] * $data["harga"];
                                    ?>

                                        <tr>
                                            <td><?= $no++; ?>.</td>
                                            <td><?= $data["kode_penjualan"]; ?></td>
                                            <td><?= $data["kode_barang"]; ?> - <?= $data["nama_barang"]; ?></td>
                                            <td><?= $data["jumlah"]; ?></td>
                                            <td><?= $data["nama_satuan"]; ?></td>
                                            <td><?= number_format($data["harga"]); ?></td>
                                            <td><?= $data["full_name"]; ?></td>
                                            <td><?= $data["tanggal"]; ?></td>
                                            <td>Rp.<?= number_format($subtotal); ?>,-</td>
                                            <td>

                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?= $id_pj; ?>">
                                                    Hapus
                                                </button>
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ubah<?= $id_pj ?>">
                                                    Ubah
                                                </button>
                                            </td>
                                        </tr>



                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div> -->

                        <!-- new tables -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Kode Penjualan</th>
                                        <th>Barang</th>
                                        <th>Jumlah</th>
                                        <th>Satuan</th>
                                        <th>Harga</th>
                                        <th>User</th>
                                        <th>Tanggal</th>
                                        <th>Sub-total</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $kueri = "SELECT master_penjualan.id_penjualan,
                                                        master_penjualan.kode_penjualan,
                                                        
                                                        master_barang.id_barang,
                                                        master_barang.kode_barang,
                                                        master_barang.nama_barang,
                                                        master_barang.stok,
                                                        
                                                        master_penjualan.jumlah,
                                                        
                                                        master_satuan.id_satuan,
                                                        master_satuan.nama_satuan,
                                                        
                                                        master_penjualan.harga,
                                                        
                                                        master_user.id_user,
                                                        master_user.full_name,
                                                        
                                                        master_penjualan.tanggal
                                                    FROM master_penjualan INNER JOIN master_barang ON master_penjualan.barang = master_barang.id_barang
                                                                                JOIN master_satuan ON master_penjualan.satuan = master_satuan.id_satuan
                                                                                JOIN master_user ON master_penjualan.user = master_user.id_user";

                                    $ambil = mysqli_query($conn, $kueri) or die(mysqli_error($conn));
                                    while ($data = mysqli_fetch_array($ambil)) :
                                        $id_pj = $data["id_penjualan"];
                                        $subtotal = $data["jumlah"] * $data["harga"];
                                    ?>
                                        <tr>
                                            <td><?= $no++; ?>.</td>
                                            <td><?= $data["kode_penjualan"]; ?></td>
                                            <td><?= $data["kode_barang"]; ?> - <?= $data["nama_barang"]; ?></td>
                                            <td><?= $data["jumlah"]; ?></td>
                                            <td><?= $data["nama_satuan"]; ?></td>
                                            <td>Rp.<?= number_format($data["harga"]); ?>,-</td>
                                            <td><?= $data["full_name"]; ?></td>
                                            <td><?= $data["tanggal"]; ?></td>
                                            <td>Rp.<?= number_format($subtotal); ?>,-</td>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete<?= $id_pj; ?>">
                                                    Hapus
                                                </button>
                                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#ubah<?= $id_pj; ?>">
                                                    Ubah
                                                </button>
                                            </td>
                                        </tr>
                                        <!-- modal hapus -->
                                        <div class="modal" id="delete<?= $id_pj ?>">
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
                                                            <label for="id">ID Penjualan</label>
                                                            <input type="text" id="id" name="id" class="form-control" value="<?= $data['id_penjualan']; ?>" readonly required>
                                                            <label for="kode_penjualan">Kode Penjualan</label>
                                                            <input type="text" id="kode_penjualan" name="kode_penjualan" class="form-control" value="<?= $data['kode_penjualan']; ?>" placeholder="Kode Penjualan" readonly required>

                                                            <label for="barang">Barang</label>
                                                            <input type="text" id="barang" name="barang" class="form-control" value="<?= $data['id_barang']; ?> - <?= $data['nama_barang']; ?>" placeholder="Barang" readonly required>

                                                            <label for="jumlah">Jumlah</label>
                                                            <input type="number" name="jumlah" id="jumlah" class="form-control mt-2" min="1" value="<?= $data['jumlah']; ?>" placeholder="Jumlah" readonly required>

                                                            <label for="satuan">Satuan</label>
                                                            <input type="text" name="satuan" id="satuan" class="form-control mt-2" min="1" value="<?= $data['nama_satuan']; ?>" placeholder="Jumlah" readonly required>

                                                            <label for="harga">Harga</label>
                                                            <input type="number" name="harga" id="harga" class="form-control mt-2" value="<?= $data['harga']; ?>" placeholder="Harga" readonly required>

                                                            <label for="user">User</label>
                                                            <input type="text" id="user" name="user" class="form-control" value="<?= $data['full_name']; ?>" placeholder="User" readonly required>

                                                            <label for="tanggal">Tanggal</label>
                                                            <input type="date" id="tanggal" name="tanggal" class="form-control mt-2" placeholder="Tanggal" readonly required>

                                                        </div>

                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-success" name="hapuspenjualan">Hapus</button>
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                                                        </div>

                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                        <!-- modal ubah -->
                                        <div class="modal" id="ubah<?= $id_pj ?>">z
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Ubah Penjualan</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>

                                                    <form method="post">


                                                        <!-- Modal body -->
                                                        <div class="modal-body">

                                                            <label for="id">ID Penjualan</label>
                                                            <input type="text" id="id" name="id" class="form-control" value="<?= $data['id_penjualan']; ?>" placeholder="ID Penjualan" readonly required>
                                                            <label for="kode_penjualan">Kode Penjualan</label>
                                                            <input type="text" id="kode_penjualan" name="kode_penjualan" class="form-control" value="<?= $data['kode_penjualan']; ?>" placeholder="Kode Penjualan" readonly required>

                                                            <label for="barang">Barang</label>
                                                            <select class="form-select mt-2" id="barang" name="barang">
                                                                <?php
                                                                $kueri = mysqli_query($conn, "SELECT * FROM master_barang");
                                                                while ($barang = mysqli_fetch_assoc($kueri)) :
                                                                    $select = ($data["id_barang"] == $barang["id_barang"]) ? "selected" : "";
                                                                ?>
                                                                    <option value="<?= $barang["id_barang"]; ?>" <?= $select; ?>>
                                                                        <?= $barang['kode_barang']; ?> - <?= $barang["nama_barang"]; ?> - <?= $barang["stok"]; ?>
                                                                    </option>
                                                                <?php endwhile; ?>
                                                            </select>

                                                            <label for="jumlah">Jumlah</label>
                                                            <input type="number" name="jumlah" id="jumlah" class="form-control mt-2" min="1" value="<?= $data['jumlah']; ?>" placeholder="Jumlah" required>

                                                            <label for="satuan">Satuan</label>
                                                            <select class="form-select mt-2" id="satuan" name="satuan">
                                                                <?php
                                                                $kueri = mysqli_query($conn, "SELECT * FROM master_satuan");
                                                                while ($satuan = mysqli_fetch_assoc($kueri)) :
                                                                    $select = ($data["id_satuan"] == $satuan["id_satuan"]) ? "selected" : "";
                                                                ?>
                                                                    <option value="<?= $satuan["id_satuan"]; ?>" <?= $select; ?>>
                                                                        <?= $satuan["nama_satuan"]; ?>
                                                                    </option>
                                                                <?php endwhile; ?>
                                                            </select>

                                                            <label for="harga">Harga</label>
                                                            <input type="num" name="harga" id="harga" class="form-control mt-2" value="<?= $data['harga']; ?>" placeholder="Harga" required>

                                                            <label for="user">User</label>
                                                            <select class="form-select mt-2" id="user" name="user">
                                                                <?php
                                                                $kueri = mysqli_query($conn, "SELECT * FROM master_user");
                                                                while ($user = mysqli_fetch_assoc($kueri)) :
                                                                    $select = ($data["id_user"] == $user["id_user"]) ? "selected" : "";
                                                                ?>
                                                                    <option value="<?= $user["id_user"]; ?>" <?= $select; ?>>
                                                                        <?= $user["username"]; ?> - <?= $user["level"]; ?>
                                                                    </option>
                                                                <?php endwhile; ?>
                                                            </select>

                                                            <label for="tanggal">Tanggal</label>
                                                            <input type="date" id="tanggal" name="tanggal" class="form-control mt-2" placeholder="Tanggal" readonly>

                                                        </div>

                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-success" name="btnubahpenjualan">Ubah</button>
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
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


<!-- The Modal Tambah -->
<div class="modal" id="penjualanModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah Penjualan</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form method="post">

                <!-- Modal body -->
                <div class="modal-body">
                    <label for="kode_penjualan">Kode Penjualan</label>
                    <input type="text" id="kode_penjualan" name="kode_penjualan" class="form-control" placeholder="Kode Penjualan" required>

                    <label for="barang">Barang</label>
                    <select class="form-select mt-2" id="barang" name="id_barang" required>
                        <option selected>Barang</option>

                        <?php
                        // mengambil data dari database tabel master_barang
                        $ambil = mysqli_query($conn, "SELECT * FROM master_barang");
                        while ($barang = mysqli_fetch_array($ambil)) : ?>

                            <option value="<?= $barang["id_barang"]; ?>">
                                <?= $barang["kode_barang"]; ?> - <?= $barang["nama_barang"]; ?> - <?= $barang["stok"]; ?> - <?= $barang["harga_jual"]; ?>
                            </option>

                        <?php endwhile; ?>
                    </select>


                    <label for="jumlah">Jumlah</label>
                    <input type="number" name="jumlah" id="jumlah" class="form-control mt-2" min="1" placeholder="Jumlah" required>

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

                    <label for="harga">Harga</label>
                    <input type="num" name="harga" id="harga" class="form-control mt-2" placeholder="Harga" required>

                    <label for="user">User</label>
                    <select class="form-select mt-2" id="user" name="user" required>
                        <option selected>Pilih User</option>

                        <?php
                        // mengambil data dari database tabel master_user
                        $ambil = mysqli_query($conn, "SELECT * FROM master_user");
                        while ($ktg = mysqli_fetch_array($ambil)) : ?>

                            <option value="<?= $ktg["id_user"]; ?>">
                                <?= $ktg["username"]; ?> - <?= $ktg["level"]; ?>
                            </option>

                        <?php endwhile; ?>
                    </select>

                    <label for="tanggal">Tanggal</label>
                    <input type="date" id="tanggal" name="tanggal" class="form-control mt-2" placeholder="Tanggal" required>

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" name="btnpenjualan">Tambah</button>
                    <button type="reset" class="btn btn-warning">Reset</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                </div>

            </form>

        </div>
    </div>
</div>

</html>