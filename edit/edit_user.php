<!-- modal ubah User -->
<!-- Button to Open the Modal -->
<?php

require "koneksi.php";

?>
<button type="button" class="btn btn-info mb-4" data-bs-toggle="modal" data-bs-target="#barangUser">
    Ubah User
</button>

<!-- The Modal -->
<div class="" id="">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Ubah User</h4>

            </div>

            <form method="post">

                <!-- Modal body -->
                <div class="modal-body">
                    <!-- dropdown -->
                    <?php
                    $ambil = mysqli_query($conn, "SELECT * FROM master_user WHERE id_user='$_GET[ubah]' ");
                    while ($data = mysqli_fetch_array($ambil)) :
                    ?>
                        <label for="id_user">Username</label>
                        <input type="text" id="id_user" name="id_user" class="form-control mt-2" value="<?= $data['id_user']; ?>" readonly="readonly" placeholder="ID User">

                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" class="form-control mt-2" value="<?= $data['username']; ?>" placeholder="Username">

                        <label for="pw">Password</label>
                        <input type="password" id="pw" name="password" class="form-control mt-2" value="<?= $data['pw']; ?>" placeholder="Password">

                        <label for="full_name">Nama</label>
                        <input type="text" id="full_name" name="nama" class="form-control mt-2" value="<?= $data['full_name']; ?>" placeholder="Nama">

                        <label for="level">Level</label>
                        <input type="text" id="level" name="level" class="form-control mt-2" value="<?= $data['level']; ?>" placeholder="Level">

                    <?php endwhile; ?>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" name="ubahuser">Submit</button>
                    <a href="master_user.php"><button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button></a>
                </div>

            </form>

        </div>
    </div>
</div>