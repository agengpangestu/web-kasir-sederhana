<!-- modal ubah kategori -->
<!-- Button to Open the Modal -->
<?php

require "koneksi.php";

?>
<button type="button" class="btn btn-info mb-4" data-bs-toggle="modal" data-bs-target="#barangKategori">
  Ubah Kategori
</button>

<!-- The Modal -->
<div class="" id="">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Ubah Kategori</h4>

      </div>

      <form method="post">

        <!-- Modal body -->
        <div class="modal-body">
          <!-- dropdown -->
          <?php
          $ambil = mysqli_query($conn, "SELECT * FROM master_kategori WHERE id_kategori='$_GET[ubahktguser]' ");
          while ($data = mysqli_fetch_array($ambil)) :
          ?>
            <input type="text" name="id_kategori" class="form-control mt-2" value="<?= $data['id_kategori']; ?>" readonly placeholder="ID Kategori">
            <input type="text" name="nama_kategori" class="form-control mt-2" value="<?= $data['nama_kategori']; ?>" placeholder="Nama Kategori">
            <input type="text" name="ket_kategori" class="form-control mt-2" value="<?= $data['ket_kategori']; ?>" placeholder="Ket. Kategori">
          <?php endwhile; ?>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" name="ubahktguser">Submit</button>
          <a href="user_kategori.php"><button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button></a>
        </div>

      </form>

    </div>
  </div>
</div>