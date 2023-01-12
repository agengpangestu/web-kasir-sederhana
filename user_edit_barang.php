<!-- modal ubah kategori -->
<!-- Button to Open the Modal -->
<?php

require "koneksi.php";

?>
<button type="button" class="btn btn-info mb-4" data-bs-toggle="modal" data-bs-target="#barangBarang">
    Ubah Barang
</button>

<!-- The Modal -->
<div class="" id="">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Ubah Barang</h4>

            </div>

            <form method="post">

                <!-- Modal body -->
                <div class="modal-body">
                    <!-- dropdown -->
                    <?php
                    $ambil = mysqli_query($conn, "SELECT master_barang.id_barang,
                                                           master_barang.kode_barang,

                                                            master_kategori.id_kategori,
                                                            master_kategori.nama_kategori,

                                                            master_merek.id_merek,
                                                            master_merek.nama_merek,

                                                            master_barang.nama_barang,
                                                            master_barang.harga,
                                                            master_barang.harga_jual
                                                    FROM master_barang INNER JOIN master_kategori ON master_barang.kategori = master_kategori.id_kategori
                                                    JOIN master_merek ON master_barang.merek = master_merek.id_merek
                                                    WHERE id_barang='$_GET[ubahbrguser]' ");
                    while ($data = mysqli_fetch_array($ambil)) :
                    ?>
                        <tr>
                            <td>ID Barang</td>
                            <td><input type="text" name="id_barang" class="form-control mt-2" value="<?= $data['id_barang']; ?>" readonly="readonly" placeholder="ID Barang"></td>
                        </tr>
                        <tr>
                            <td>Kode Barang</td>
                            <td><input type="text" name="kode_barang" class="form-control mt-2" value="<?= $data['kode_barang']; ?>" readonly="readonly" placeholder="Kode Barang"></td>
                        </tr>
                        <tr>
                            <td>Kategori</td>
                            <td><select class="form-select mt-2" name="kategori">

                                    <option value="<?= $data["id_kategori"]; ?>"><?= $data["nama_kategori"]; ?></option>

                                    <?php
                                    $kueri = mysqli_query($conn, "SELECT * FROM master_kategori");
                                    while ($tampil = mysqli_fetch_array($kueri)) :
                                    ?>
                                        <option value="<?= $tampil['id_kategori'] ?>"><?= $tampil['nama_kategori'] ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td>Merek</td>
                            <td>
                                <select class="form-select mt-2" name="merek">

                                    <option value="<?= $data["id_merek"]; ?>"><?= $data["nama_merek"]; ?></option>

                                    <?php
                                    $kueri = mysqli_query($conn, "SELECT * FROM master_merek");
                                    while ($tampil = mysqli_fetch_array($kueri)) :
                                    ?>
                                        <option value="<?= $tampil['id_merek'] ?>"><?= $tampil['nama_merek'] ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Nama Barang</td>
                            <td><input type="text" name="nama_barang" class="form-control mt-2" value="<?= $data['nama_barang']; ?>" placeholder="Nama Barang"></td>
                        </tr>
                        <tr>
                            <td>Harga Beli</td>
                            <td><input type="text" name="harga" class="form-control mt-2" value="<?= $data['harga']; ?>" placeholder="Harga Beli"></td>
                        </tr>
                        <tr>
                            <td>Harga Jual</td>
                            <td><input type="text" id="h_jual" name="h_jual" class="form-control mt-2" value="<?= $data['harga_jual']; ?>" placeholder="Harga Jual"></td>
                        </tr>

                    <?php endwhile; ?>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" name="ubahbrguser">Ubah</button>
                    <a href="user.php"><button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button></a>
                </div>

            </form>

        </div>
    </div>
</div>