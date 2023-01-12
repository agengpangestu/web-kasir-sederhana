<!-- modal ubah kategori -->
<!-- Button to Open the Modal -->
<?php

require "koneksi.php";

?>

<button type="button" class="btn btn-info mb-4" data-bs-toggle="modal" data-bs-target="#barangSupplier">
    Ubah Supplier
</button>

<!-- The Modal -->
<div class="" id="">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Ubah Supplier</h4>

            </div>

            <form method="post">

                <!-- Modal body -->
                <div class="modal-body">
                    <!-- dropdown -->
                    <?php
                    $ambil = mysqli_query($conn, "SELECT * FROM master_supplier WHERE id_supplier='$_GET[ubah]' ");
                    while ($data = mysqli_fetch_array($ambil)) :
                    ?>
                        <label for="id_supplier">ID Supplier</label>
                        <input type="text" id="id_supplier" name="id_supplier" class="form-control mt-2" value="<?= $data['id_supplier']; ?>" readonly placeholder="ID Supplier">

                        <label for="kode_supplier">Kode Supplier</label>
                        <input type="text" id="kode_supplier" name="kode_supplier" class="form-control mt-2" value="<?= $data['kode_supplier']; ?>" readonly placeholder="Kode Supplier">

                        <label for="nama_supplier">Nama Supplier</label>
                        <input type="text" id="nama_supplier" name="nama_supplier" class="form-control mt-2" value="<?= $data['nama_supplier']; ?>" placeholder="Nama Supplier">

                        <label for="kab">Kab/Kota</label>
                        <input type="text" id="kab" name="kab_kota" class="form-control mt-2" value="<?= $data['kab_kota']; ?>" placeholder="Kab/Kota">
                    <?php endwhile; ?>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" name="ubahsp">Submit</button>
                    <a href="master_supplier.php"><button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button></a>
                </div>

            </form>

        </div>
    </div>
</div>