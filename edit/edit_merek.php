<!-- modal ubah merek -->
<!-- Button to Open the Modal -->
<?php

require "koneksi.php";

?>
<button type="button" class="btn btn-info mb-4" data-bs-toggle="modal" data-bs-target="#barangMerek">
    Ubah Merek
</button>

<!-- The Modal -->
<div class="" id="">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Ubah Merek</h4>

            </div>

            <form method="post">

                <!-- Modal body -->
                <div class="modal-body">
                    <!-- dropdown -->
                    <?php
                    $ambil = mysqli_query($conn, "SELECT * FROM master_merek WHERE id_merek='$_GET[ubah]' ");
                    while ($data = mysqli_fetch_array($ambil)) :
                    ?>
                        <label for="id_merek">ID Merek</label>
                        <input type="text" id="id_merek" name="id_merek" class="form-control mt-2" value="<?= $data['id_merek']; ?>" readonly placeholder="ID Merek">

                        <label for="nama_merek">Nama Merek</label>
                        <input type="text" id="nama_merek" name="nama_merek" class="form-control mt-2" value="<?= $data['nama_merek']; ?>" placeholder="Nama Merek">

                        <label for="ket_merek">Ket. Merek</label>
                        <input type="text" id="ket_merek" name="ket_merek" class="form-control mt-2" value="<?= $data['ket_merek']; ?>" placeholder="Ket. Merek">
                    <?php endwhile; ?>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" name="ubahmrk">Submit</button>
                    <a href="master_merek.php"><button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button></a>
                </div>

            </form>

        </div>
    </div>
</div>