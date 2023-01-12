<!-- modal ubah Satuan -->
<!-- Button to Open the Modal -->
<?php

require "koneksi.php";

?>
<button type="button" class="btn btn-info mb-4" data-bs-toggle="modal" data-bs-target="#barangSatuan">
    Ubah Satuan
</button>

<!-- The Modal -->
<div class="" id="">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Ubah Satuan</h4>

            </div>

            <form method="post">

                <!-- Modal body -->
                <div class="modal-body">
                    <!-- dropdown -->
                    <?php
                    $ambil = mysqli_query($conn, "SELECT * FROM master_satuan WHERE id_satuan='$_GET[ubah]' ");
                    while ($data = mysqli_fetch_array($ambil)) :
                    ?>
                        <label for="id_satuan">ID Satuan</label>
                        <input type="text" id="id_satuan" name="id_satuan" class="form-control mt-2" value="<?= $data['id_satuan']; ?>" readonly="readonly" placeholder="ID satuan">

                        <label for="nama_satuan">Nama Satuan</label>
                        <input type="text" id="nama_satuan" name="nama_satuan" class="form-control mt-2" value="<?= $data['nama_satuan']; ?>" placeholder="Nama satuan">

                        <label for="ket_satuan">Ket. Satuan</label>
                        <input type="text" id="ket_satuan" name="ket_satuan" class="form-control mt-2" value="<?= $data['ket_satuan']; ?>" placeholder="Ket. satuan">
                    <?php endwhile; ?>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" name="ubahstn">Submit</button>
                    <a href="master_satuan.php"><button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button></a>
                </div>

            </form>

        </div>
    </div>
</div>