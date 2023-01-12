<?php


require "koneksi.php";


// login
if (isset($_POST["login"])) {
	$username = $_POST['username'];
	$pw = $_POST['pw'];


	$ambil = mysqli_query($conn, "SELECT * FROM master_user WHERE username='$username' AND pw='$pw'");
	$hitung = mysqli_num_rows($ambil);

	if ($hitung) {
		//jika data ditemukan

		$ambilDataRole = mysqli_fetch_array($ambil);
		$level = $ambilDataRole['level'];

		if ($level == "admin") {
			//kalau di admin
			$_SESSION["login"] = "true";
			$_SESSION["level"] = "admin";

			header("location:index.php");
		} else {
			//kalau bukan admin
			$_SESSION["login"] = "true";
			$_SESSION["level"] = "user";

			header("location:user.php");
		}
	} else {
		//kalau tidak ditemukan

		echo "
			<script>
				alert('Data tidak ditemukan');
                alert('Silahkan login kembali!');
                window.location.href='login.php'
			</script>
			";
	}
}

// ==login
// if (isset($_POST['login'])) {

// 	$username = $_POST["username"];
// 	$password = md5($_POST["pw"]);

// 	$check = mysqli_query($conn, "SELECT * FROM master_user WHERE username ='$username' AND pw ='$password' ");
// 	$hitung = mysqli_num_rows($check);

// 	if ($hitung > 0) {
// 		//jika data ditemukan
// 		//berhasil login
// 		$_SESSION["login"] = "true";
// 		header("location:index.php");
// 	} else {
// 		//data tidak ditemukan
// 		//gagal login
// 		echo "
// 			<script>
// 				alert('username atau password salah');
// 				window.location.href='login.php'
// 			</script>
// 			";
// 	}
// }

// ==ADMIN==
// ==Barang /aman
// tambah
if (isset($_POST["buttontambah"])) {
	$kode_barang = htmlspecialchars(strtoupper($_POST["kode_barang"]));
	$kategori = htmlspecialchars($_POST["kategori"]);
	$merek = htmlspecialchars($_POST["merek"]);
	$nama_barang = htmlspecialchars(ucwords($_POST["nama_barang"]));
	$stok = htmlspecialchars($_POST["stok"]);
	$harga = htmlspecialchars($_POST["harga"]);
	$h_jual = htmlspecialchars($_POST["h_jual"]);

	$kueri = "INSERT INTO master_barang (kode_barang, kategori, merek, nama_barang, stok, harga, harga_jual) 
								VALUES ('$kode_barang', '$kategori', '$merek', '$nama_barang', '$stok', '$harga', '$h_jual') ";
	$tambah = mysqli_query($conn, $kueri);

	//jika berhasil, maka akan diredirect
	if ($tambah == 0) {
		echo "
			<script>
				alert('Gagal ditambah!');
				window.location.href='index.php'
			</script>
			";
	} else {
		echo "
			<script>
				alert('Berhasil ditambah');
				window.location.href='index.php'
			</script>
			";
	}
}
//ubah
if (isset($_POST["ubahbrg"])) {
	$id = htmlspecialchars($_POST["id"]);
	$kode_brg = htmlspecialchars($_POST["kode_barang"]);
	$ktg = htmlspecialchars($_POST["kategori"]);
	$merek = htmlspecialchars($_POST["merek"]);
	$nama_brg = htmlspecialchars(ucwords($_POST["nama_barang"]));
	$harga = htmlspecialchars($_POST["harga"]);
	$h_jual = htmlspecialchars($_POST["h_jual"]);

	$ubah = mysqli_query($conn, "UPDATE master_barang SET kode_barang='$kode_brg',
																		kategori='$ktg',
																		merek='$merek',
																		nama_barang='$nama_brg',
																		harga='$harga',
																		harga_jual='$h_jual'
														WHERE id_barang='$id' ");
	// var_dump($id);
	// var_dump($kode_brg);
	// var_dump($ktg);
	// var_dump($merek);
	// var_dump($nama_brg);
	// var_dump($harga);
	// var_dump($h_jual);

	//jika berhasil
	if ($ubah == 0) {
		echo "
		<script>
			alert('Gagal diubah!');
			window.location.href='index.php'
		</script>
		";
	} else {
		echo "
		<script>
			alert('Berhasil diubah!');
			window.location.href='index.php'
		</script>
		";
	}
}
// //hapus
if (isset($_POST["hapusbrg"])) {
	$id = $_POST["id"];

	$kueri = "DELETE FROM master_barang WHERE id_barang='$id' ";
	$hapus = mysqli_query($conn, $kueri);

	if ($hapus == 0) {
		echo "
			<script>
				alert('Gagal dihapus!');
				window.location.href='index.php'
			</script>
			";
	} else {
		echo "
		<script>
			alert('Berhasil dihapus!');
			window.location.href='index.php'
		</script>
		";
	}
}

//	==Kategori
// tambah
if (isset($_POST["tambahktg"])) {
	$nama_kategori = htmlspecialchars(ucwords($_POST["nama_kategori"]));
	$ket_kategori = htmlspecialchars($_POST["ket_kategori"]);

	$tambah = mysqli_query($conn, "INSERT INTO master_kategori (nama_kategori, ket_kategori) 
										VALUES ('$nama_kategori', '$ket_kategori')");
	//jika berhasil, maka akan diredirect
	if ($tambah) {
		echo "
			<script>
				alert('Kategori baru berhasil ditambahkan!');
				window.location.href='master_kategori.php'
			</script>
			";
	} else {
		echo "
			<script>
				alert('Gagal menambah kategori baru!');
				window.location.href='master_kategori.php'
			</script>
			";
	}
}
//ubah
if (isset($_POST["ubahktg"])) {
	$id = htmlspecialchars($_POST["id"]);
	$nama_ktg = htmlspecialchars(ucwords($_POST["nama_kategori"]));
	$ket_ktg = htmlspecialchars($_POST["ket_kategori"]);

	$kueri = "UPDATE master_kategori SET nama_kategori='$nama_ktg',
										 ket_kategori='$ket_ktg'
									WHERE id_kategori='$id' ";
	$update = mysqli_query($conn, $kueri);

	//jika berhasil, maka akan diredirect
	if ($update == 0) {
		echo "
			<script>
				alert('Gagal diubah!');
				window.location.href='master_kategori.php'
			</script>
			";
	} else {
		echo "
			<script>
				alert('Berhasil diubah!');
				window.location.href='master_kategori.php'
			</script>
			";
	}
}
//hapus 
if (isset($_POST["hapusktg"])) {
	$id = $_POST["id"];

	$kueri = "DELETE FROM master_kategori WHERE id_kategori='$id'";
	$delete1 = mysqli_query($conn, $kueri);

	if ($delete1 == 0) {
		echo "
			<script>
				alert('Gagal menghapus!');
				window.location.href='master_kategori.php'
			</script>
		";
	} else {
		echo "
			<script>
				alert('Berhasil menghapus!');
				window.location.href='master_kategori.php'
			</script>
		" . mysqli_error($conn);
	}



	// try {
	// 	$conn->query("DELETE FROM master_kategori WHERE id=$id");
	// 	echo "<script>
	// 			alert('Berhasil menghapus!');
	// 			window.location.href='master_kategori.php'
	// 		</script> . Record deleted successfully";
	// } catch (Exception $e) {
	// 	//uh-oh, maybe a foreign key restraint failed?!
	// 	if ($e->getCode() == "MySQL foreign key error code") {
	// 		// yepp, it failed. Do some stuff.
	// 		echo "
	// 		<script>
	// 			alert('Gagal menghapus!');
	// 			window.location.href='master_kategori.php'
	// 		</script>
	// 	. Error deleting record:" . $conn->error;
	// 	}
	// }
}
// ==Supplier
// tambah
if (isset($_POST["tambahsp"])) {
	$kode_sp = htmlspecialchars(strtoupper($_POST["kode_supplier"]));
	$nama_sp = htmlspecialchars(ucwords($_POST["nama_supplier"]));
	$kab = htmlspecialchars(ucwords($_POST["kab_kota"]));

	$tambah = mysqli_query($conn, "INSERT INTO master_supplier (kode_supplier, nama_supplier, kab_kota)
										VALUES ('$kode_sp','$nama_sp', '$kab')");
	//jika berhasil, maka akan diredirect
	if ($tambah) {
		echo "
			<script>
				alert('Supplier berhasil ditambahkan!');
				window.location.href='master_supplier.php'
			</script>
			";
	} else {
		echo "
			<script>
				alert('Gagal menambah Supplier!');
				window.location.href='master_supplier.php'
			</script>
			";
	}
}
// hapus
if (isset($_POST["hapussp"])) {
	$id = $_POST["id"];

	$delete = "DELETE FROM master_supplier WHERE id_supplier = '$id' ";
	$hapus = mysqli_query($conn, $delete);

	if ($hapus == 0) {
		echo "
			<script>
				alert('Gagal dihapus!');
				window.location.href='master_supplier.php'
			</script>
			";
	} else {
		echo "
			<script>
				alert('Berhasil dihapus!');
				window.location.href='master_supplier.php'
			</script>
			";
	}
}
// ubah
if (isset($_POST["ubahsp"])) {
	$id = htmlspecialchars($_POST["id"]);
	$kode_sp = htmlspecialchars(strtoupper($_POST["kode_supplier"]));
	$nama = htmlspecialchars(ucwords($_POST["nama_supplier"]));
	$kab = htmlspecialchars(ucwords($_POST["kab_kota"]));

	$kueri = "UPDATE master_supplier SET kode_supplier='$kode_sp',
											nama_supplier='$nama', 
											kab_kota='$kab' 
										WHERE id_supplier='$id' ";
	$update = mysqli_query($conn, $kueri);

	//jika berhasil, maka akan diredirect
	if ($update == 0) {
		echo "
			<script>
				alert('Gagal diubah!');
				window.location.href='masrter_supplier.php'
			</script>
			";
	} else {
		echo "
			<script>
				alert('Berhasil diubah!');
				window.location.href='master_supplier.php'
			</script>
			";
	}
}

// ==User
//tambah user
if (isset($_POST["tambahuser"])) {
	$username = htmlspecialchars(strtolower($_POST['username']));
	$pw = htmlspecialchars($_POST['pw']);
	$re_pw = htmlspecialchars($_POST['re_pw']);
	$full_name = htmlspecialchars(ucwords($_POST['full_name']));
	$level = htmlspecialchars($_POST['level']);

	$cek_user = mysqli_query($conn, "SELECT * FROM master_user WHERE username = '$username'");
	$cek_login = mysqli_num_rows($cek_user);

	if ($cek_login > 0) {
		echo "
            <script>
                alert('Username telah ada!');
                window.location.href='master_user.php'
            </script>
            ";
	} else {
		if ($pw != $re_pw) {
			echo "
            <script>
                alert('Konfirmasi password tidak sesuai!');
                window.location.href='master_user.php'
            </script>
            ";
		} else {
			// $password = password_hash($pw, PASSWORD_DEFAULT);
			mysqli_query($conn, "INSERT INTO master_user VALUES ('', '$username', '$pw', '$full_name', '$level')");
			echo "
            <script>
                alert('Berhasil menambah user baru!');
                window.location.href='master_user.php' 
            </script>
            ";
		}
	}
}
//hapus
if (isset($_POST["hapususer"])) {
	$id = $_POST["id"];
	$kueri = "DELETE FROM master_user WHERE id_user='$id'";
	$hapus = mysqli_query($conn, $kueri);

	if ($hapus == 0) {
		echo "
		<script>
			alert('Gagal dihapus!');
			window.location.href='master_user.php'
		</script>
		";
	} else {
		echo "
			<script>
				alert('Berhasil dihapus!');
				window.location.href='master_user.php'
			</script>
			";
	}
}
//ubah
if (isset($_POST["ubahuser"])) {
	$id = htmlspecialchars($_POST["id"]);
	$username = htmlspecialchars(strtolower($_POST["username"]));
	$password = htmlspecialchars($_POST["pw"]);
	$re_pass = htmlspecialchars($_POST["re_pw"]);
	$nama = htmlspecialchars(ucwords($_POST["full_name"]));
	$level = htmlspecialchars($_POST["level"]);

	// $update = mysqli_query($conn, "UPDATE master_user SET username='$username',
	// 														pw='$password',
	// 														full_name='$nama',
	// 														level='$level'
	// 													WHERE id_user='$id' ");

	$cek = mysqli_query($conn, "SELECT * FROM master_user WHERE username='$username' ");
	$cek_lagi = mysqli_num_rows($cek);

	//jika berhasil, maka akan diredirect
	if ($cek_lagi == 0) {
		echo "
		<script>
			alert('Gagal diubah!');
			window.location.href='master_user.php' 
		</script>
		";
	} else {
		if ($password != $re_pass) {
			echo "
            <script>
                alert('Konfirmasi password tidak sesuai!');
				window.location.href='master_user.php'
            </script>
            ";
		} else {
			// $password = password_hash($pw, PASSWORD_DEFAULT);
			mysqli_query($conn, "UPDATE master_user SET username='$username',
																pw='$password',
																full_name='$nama',
																level='$level'
													WHERE id_user='$id' ");
			// var_dump($id);
			// var_dump($username);
			// var_dump($password);
			// var_dump($nama);
			// var_dump($level);
			echo "
            <script>
                alert('Berhasil diubah!');
				window.location.href='master_user.php' 
            </script>
            ";
		}
	}
}


// ==Merek
//tambah
if (isset($_POST["tambahmrk"])) {
	$nama_merek = htmlspecialchars(ucwords($_POST["nama_merek"]));
	$ket_merek = htmlspecialchars($_POST["ket_merek"]);

	$tambah = mysqli_query($conn, "INSERT INTO master_merek (nama_merek, ket_merek)
								VALUES ('$nama_merek', '$ket_merek') ");
	//jika berhasil ditambah, maka akan ke redirect
	if ($tambah) {
		echo "
			<script>
				alert('Merek baru berhasil ditambahkan!');
				window.location.href='master_merek.php'
			</script>
			";
	} else {
		echo "
			<script>
				alert('Gagal menambah merek baru!');
				window.location.href='master_merek.php'
			</script>
			";
	}
}
//hapus
if (isset($_POST["hapusmrk"])) {
	$id = $_POST["id"];
	$nama = $_POST["nama_merek"];
	$kueri = "DELETE FROM master_merek WHERE id_merek='$id' ";
	$hapus = mysqli_query($conn, $kueri);
	if ($hapus == 0) {
		echo "
		<script>
			alert('Gagal menghapus!');
			window.location.href='master_merek.php'
		</script>
		";
	} else {
		echo "
			<script>
				alert('Berhasil dihapus!');
				window.location.href='master_merek.php'
			</script>
			";
	}
}
//ubah
if (isset($_POST["ubahmrk"])) {
	$id = htmlspecialchars($_POST["id"]);
	$nama_mrk = htmlspecialchars(ucwords($_POST["nama_merek"]));
	$ket_mrk = htmlspecialchars($_POST["ket_merek"]);

	$ubah = mysqli_query($conn, "UPDATE master_merek SET nama_merek = '$nama_mrk', ket_merek = '$ket_mrk' WHERE id_merek = '$id' ");
	//jika berhasil, maka akan diredirect
	if ($ubah) {
		echo "
			<script>
				alert('Merek berhasil diubah!');
				window.location.href='master_merek.php'
			</script>
			";
	} else {
		echo "
			<script>
				alert('Gagal mengubah Merek!');
				window.location.href='master_merek.php'
			</script>
			";
	}
}

// ==Satuan
// tambah /aman
if (isset($_POST["tambahstn"])) {
	$nama_satuan = htmlspecialchars(ucwords($_POST["nama_satuan"]));
	$ket_satuan = htmlspecialchars($_POST["ket_satuan"]);

	$kueri = "INSERT INTO master_satuan (nama_satuan, ket_satuan) VALUES ('$nama_satuan','$ket_satuan') ";
	$tambah = mysqli_query($conn, $kueri);

	//jika berhasil ditambah, maka akan ke redirect
	if ($tambah == 0) {
		echo "
			<script>
				alert('Gagal ditambah!');
				window.location.href='master_satuan.php'
			</script>
			";
	} else {
		echo "
			<script>
				alert('Berhasil ditambah!');
				window.location.href='master_satuan.php'
			</script>
			";
	}
}
// hapus
if (isset($_POST["hapusstn"])) {
	$id = $_POST["id"];

	$kueri = "DELETE FROM master_satuan WHERE id_satuan='$id' ";
	$hapus = mysqli_query($conn, $kueri);
	if ($hapus == 0) {
		echo "
		<script>
			alert('Gagal dihapus!');
			window.location.href='master_satuan.php'
		</script>
		";
	} else {
		echo "
		<script>
			alert('Berhasil dihapus!');
			window.location.href='master_satuan.php'
		</script>
		";
	}
}
// ubah
if (isset($_POST["ubahstn"])) {
	$id = htmlspecialchars($_POST["id"]);
	$nama_stn = htmlspecialchars(strtoupper($_POST["nama_satuan"]));
	$ket_stn = htmlspecialchars($_POST["ket_satuan"]);

	$ubah = mysqli_query($conn, "UPDATE master_satuan SET nama_satuan = '$nama_stn', ket_satuan = '$ket_stn' WHERE id_satuan = '$id' ");
	//jika berhasil, maka akan diredirect
	if ($ubah) {
		echo "
			<script>
				alert('Satuan berhasil diubah!');
				window.location.href='master_satuan.php'
			</script>
			";
	} else {
		echo "
			<script>
				alert('Gagal mengubah satuan!');
				window.location.href='master_satuan.php'
			</script>
			";
	}
}

// ==Pembelian



// ==USER==
// ==Barang
// tambah
if (isset($_POST["tambahbrguser"])) {

	$kode_barang = htmlspecialchars(strtoupper($_POST["kode_barang"]));
	$kategori = htmlspecialchars($_POST["kategori"]);
	$merek = htmlspecialchars($_POST["merek"]);
	$nama_barang = htmlspecialchars(ucwords($_POST["nama_barang"]));
	$stok = htmlspecialchars($_POST["stok"]);
	$harga = htmlspecialchars($_POST["harga"]);
	$h_jual = htmlspecialchars($_POST["h_jual"]);

	$kueri = "INSERT INTO master_barang (kode_barang, kategori, merek, nama_barang, stok, harga, harga_jual) 
	VALUES ('$kode_barang', '$kategori', '$merek', '$nama_barang', '$stok', '$harga', '$h_jual') ";
	$tambah = mysqli_query($conn, $kueri);

	//jika berhasil, maka akan diredirect
	if ($tambah == 0) {
		echo "
			<script>
				alert('Gagal menambah barang baru!');
				window.location.href='user.php'
			</script>
			";
	} else {
		echo "
			<script>
				alert('Berhasil menambah barang baru!');
				window.location.href='user.php'
			</script>
			";
	}
}
//ubah, belum jadi
if (isset($_POST["ubahbrguser"])) {
	$id = htmlspecialchars(strtoupper($_POST["id"]));
	$kode_brg = htmlspecialchars(strtoupper($_POST["kode_barang"]));
	$ktg = htmlspecialchars($_POST["kategori"]);
	$merek = htmlspecialchars($_POST["merek"]);
	$nama_brg = htmlspecialchars(ucwords($_POST["nama_barang"]));
	$harga = htmlspecialchars($_POST["harga"]);
	$h_jual = htmlspecialchars($_POST["h_jual"]);

	$kueri = "UPDATE master_barang SET kode_barang='$kode_brg', 
										kategori='$ktg', 
										merek='$merek', 
										nama_barang='$nama_brg', 
										harga='$harga',
										harga_jual='$h_jual'
									WHERE id_barang='$id' ";
	$update = mysqli_query($conn, $kueri);
	// var_dump($id);
	// var_dump($kode_brg);
	// var_dump($ktg);
	// var_dump($merek);
	// var_dump($nama_brg);
	// var_dump($harga);

	//jika berhasil
	if ($update == 0) {
		echo "
		<script>
			alert('Gagal diubah!');
			window.location.href='user.php'
		</script>
		";
	} else {
		echo "
		<script>
			alert('Berhasil diubah!');
			window.location.href='user.php'
		</script>
		";
	}
}
// //hapus
if (isset($_POST["hapusbrguser"])) {
	$id = $_POST["id"];

	$kueri = "DELETE FROM master_barang WHERE id_barang='$id' ";
	$hapus = mysqli_query($conn, $kueri);

	if ($hapus == 0) {
		echo "
			<script>
				alert('Gagal dihapus!');
				window.location.href='user.php'
			</script>
			" or die(mysqli_connect_errno() . mysqli_connect_error());
	} else {
		echo "
			<script>
				alert('Berhasil dihapus!');
				window.location.href='user.php'
			</script>
			";
	}
}

// ==Kategori aman
// tambah
if (isset($_POST["tambahktguser"])) {
	$nama_kategori = htmlspecialchars(ucwords($_POST["nama_kategori"]));
	$ket_kategori = htmlspecialchars($_POST["ket_kategori"]);

	$tambah = mysqli_query($conn, "INSERT INTO master_kategori (nama_kategori, ket_kategori) 
										VALUES ('$nama_kategori', '$ket_kategori')");
	//jika berhasil, maka akan diredirect
	if ($tambah) {
		echo "
			<script>
				alert('Kategori baru berhasil ditambahkan!');
				window.location.href='user_kategori.php'
			</script>
			";
	} else {
		echo "
			<script>
				alert('Gagal menambah kategori baru!');
				window.location.href='user_kategori.php'
			</script>
			";
	}
}
//ubah
if (isset($_POST["ubahktguser"])) {
	$id = htmlspecialchars($_POST["id"]);
	$nama_ktg = htmlspecialchars(ucwords($_POST["nama_kategori"]));
	$ket_ktg = htmlspecialchars($_POST["ket_kategori"]);

	$kueri = "UPDATE master_kategori SET nama_kategori='$nama_ktg', ket_kategori='$ket_ktg' WHERE id_kategori='$id' ";
	$ubah = mysqli_query($conn, $kueri);

	//jika berhasil, maka akan diredirect
	if ($ubah == 0) {
		echo "
			<script>
				alert('Gagal diubah!');
				window.location.href='user_kategori.php'
			</script>
			" or die(mysqli_connect_errno() . mysqli_connect_error());
	} else {
		echo "
			<script>
				alert('Berhasil diubah!');
				window.location.href='user_kategori.php'
			</script>
			";
	}
}
//hapus belum jadi
if (isset($_POST["hapusktguser"])) {
	$id = $_POST["id"];
	$nama = $_POST['nama_kategori'];
	$query = "DELETE FROM master_kategori WHERE id_kategori='$id'";
	$result = mysqli_query($conn, $query);

	if ($result == 0) {
		echo "
			<script>
				alert('Gagal dihapus!');
				alert('Karena berelasi!');
				window.location.href='user_kategori.php'
			</script>
			" or die(mysqli_connect_errno() . mysqli_connect_error());
		// var_dump($result);
	} else {
		echo "
			<script>
				alert('Berhasil dihapus!');
				window.location.href='user_kategori.php'
			</script>
			";
	}
}

// ==Supplier /aman
// tambah
if (isset($_POST["tambahspuser"])) {
	$kode_sp = htmlspecialchars(strtoupper($_POST["kode_supplier"]));
	$nama_sp = htmlspecialchars($_POST["nama_supplier"]);
	$kab = htmlspecialchars($_POST["kab_kota"]);

	$tambah = mysqli_query($conn, "INSERT INTO master_supplier (kode_supplier, nama_supplier, kab_kota)
										VALUES ('$kode_sp','$nama_sp', '$kab')");
	//jika berhasil, maka akan diredirect
	if ($tambah) {
		echo "
			<script>
				alert('Supplier berhasil ditambahkan!');
				window.location.href='user_supplier.php'
			</script>
			";
	} else {
		echo "
			<script>
				alert('Gagal menambah Supplier!');
				window.location.href='user_supplier.php'
			</script>
			";
	}
}
// hapus
if (isset($_POST["hapusspuser"])) {
	$id = $_POST["id_supplier"];

	$delete = "DELETE FROM master_supplier WHERE id_supplier = '$id' ";
	$kueri = mysqli_query($conn, $delete);

	if ($kueri == 0) {
		echo "
		<script>
			alert('Gagal dihapus!');
			window.location.href='user_supplier.php'
		</script>
		" or die(mysqli_connect_errno() . mysqli_connect_error());
	} else {
		echo "
			<script>
				alert('Berhasil dihapus!');
				window.location.href='user_supplier.php'
			</script>
			";
	}
}
// ubah
if (isset($_POST["ubahspuser"])) {
	$id = htmlspecialchars($_POST["id_supplier"]);
	$kode_sp = htmlspecialchars($_POST["kode_supplier"]);
	$nama = htmlspecialchars(ucwords($_POST["nama_supplier"]));
	$kab = htmlspecialchars(ucwords($_POST["kab_kota"]));

	$ubah = mysqli_query($conn, "UPDATE master_supplier SET kode_supplier='$kode_sp', nama_supplier='$nama', kab_kota='$kab' WHERE id_supplier='$id' ");

	//jika berhasil, maka akan diredirect
	if ($ubah) {
		echo "
			<script>
				alert('Supplier berhasil diubah!');
				window.location.href='user_supplier.php'
			</script>
			";
	} else {
		echo "
			<script>
				alert('Gagal mengubah supplier tersebut!');
				window.location.href='user_supplier.php'
			</script>
			";
	}
}

// ==Merek /aman
//tambah
if (isset($_POST["tambahmrkuser"])) {
	$nama_merek = htmlspecialchars(ucwords($_POST["nama_merek"]));
	$ket_merek = htmlspecialchars($_POST["ket_merek"]);

	$kueri = "INSERT INTO master_merek (nama_merek, ket_merek) VALUES ('$nama_merek', '$ket_merek') ";
	$tambah = mysqli_query($conn, $kueri);
	//jika berhasil ditambah, maka akan ke redirect
	if ($tambah == 0) {
		echo "
			<script>
				alert('Gagal menambah!');
				window.location.href='user_merek.php'
			</script>
			";
	} else {
		echo "
			<script>
				alert('Berhasil menambah!');
				window.location.href='user_merek.php'
			</script>
			";
	}
}
//hapus
if (isset($_POST["hapusmrkuser"])) {
	$nama = $_POST["nama_merek"];

	$kueri = "DELETE FROM master_merek WHERE nama_merek='$nama' ";
	$hapus = mysqli_query($conn, $kueri);

	if ($hapus == 0) {
		echo "
			<script>
				alert('Gagal dihapus!');
				window.location.href='user_merek.php'
			</script>
			" or die(mysqli_connect_errno() . mysqli_connect_error());
	} else {
		echo "
			<script>
				alert('Berhasil dihapus!');
				window.location.href='user_merek.php'
			</script>
			";
	}
}
//ubah //belum bisa
if (isset($_POST["ubahmrkuser"])) {
	$id = htmlspecialchars($_POST["id"]);
	$nama_mrk = htmlspecialchars(ucwords($_POST["nama_merek"]));
	$ket = htmlspecialchars($_POST["ket_merek"]);

	$kueri = "UPDATE master_merek SET nama_merek='$nama_mrk', ket_merek='$ket' WHERE id_merek='$id'";
	$update = mysqli_query($conn, $kueri);

	//jika berhasil, maka akan diredirect
	if ($update == 0) {
		echo "
			<script>
				alert('Gagal diubah!');
				window.location.href='user_merek.php'
			</script>
			" or die(mysqli_connect_errno() . mysqli_connect_error());
	} else {
		echo "
			<script>
				alert('Berhasil diubah!');
				window.location.href='user_merek.php'
			</script>
			";
	}
}

// ==Satuan /aman
// tambah
if (isset($_POST["tambahstnuser"])) {
	$nama_satuan = htmlspecialchars(ucwords($_POST["nama_satuan"]));
	$ket_satuan = htmlspecialchars($_POST["ket_satuan"]);

	$tambah = mysqli_query($conn, "INSERT INTO master_satuan (nama_satuan, ket_satuan)
								VALUES ('$nama_satuan','$ket_satuan') ");

	//jika berhasil ditambah, maka akan ke redirect
	if ($tambah) {
		echo "
			<script>
				alert('Satuan baru berhasil ditambahkan!');
				window.location.href='user_satuan.php'
			</script>
			";
	} else {
		echo "
			<script>
				alert('Gagal menambah satuan baru!');
				window.location.href='user_satuan.php'
			</script>
			";
	}
}
// hapus
if (isset($_POST["hapusstnuser"])) {
	$id = $_POST["id"];

	$delete = "DELETE FROM master_satuan WHERE id_satuan='$id'";
	$hapus = mysqli_query($conn, $delete);
	if ($hapus == 0) {
		echo "
			<script>
				alert('Gagal dihapus!');
				window.location.href='user_satuan.php'
			</script>
			" or die(mysqli_connect_errno() . mysqli_connect_error());
	} else {
		echo "
			<script>
				alert('Berhasil dihapus!');
				window.location.href='user_satuan.php'
			</script>
			";
	}
}
// ubah
if (isset($_POST["ubahstnuser"])) {
	$id = htmlspecialchars($_POST["id"]);
	$nama_stn = htmlspecialchars(ucwords($_POST["nama_satuan"]));
	$ket_stn = htmlspecialchars($_POST["ket_satuan"]);

	$ubah = "UPDATE master_satuan SET nama_satuan = '$nama_stn', ket_satuan = '$ket_stn' WHERE id_satuan = '$id' ";
	$update = mysqli_query($conn, $ubah);
	//jika berhasil, maka akan diredirect
	if ($update == 0) {
		echo "
			<script>
				alert('Gagal diubah!');
				window.location.href='user_satuan.php'
			</script>
			" or die(mysqli_connect_errno() . mysqli_connect_error());
	} else {
		echo "
			<script>
				alert('Berhasil diubah!');
				window.location.href='user_satuan.php'
			</script>
			";
	}
}

// ==pembelian User
// tambah aman
if (isset($_POST["btnuserpembelian"])) {
	$kode_pemb = htmlspecialchars(strtoupper($_POST["kode_pembelian"]));
	// $date = $_POST["tanggal"];
	$barang = htmlspecialchars($_POST["id_barang"]);
	$jumlah = htmlspecialchars($_POST["jumlah"]);
	$harga = htmlspecialchars($_POST["harga"]);
	$stn = htmlspecialchars($_POST["satuan"]);
	$sp = htmlspecialchars($_POST["supplier"]);

	// hitung stok
	$hitung1 = mysqli_query($conn, "SELECT * FROM master_barang WHERE id_barang='$barang'");
	$hitung2 = mysqli_fetch_array($hitung1);
	$stoksekarang = $hitung2["stok"]; //stok master_barang saat ini

	if ($stoksekarang && $jumlah) {
		//melakukan penambahan stok
		$tambahstok = $stoksekarang + $jumlah;
		//tambah
		$kueri = "INSERT INTO master_pembelian (kode_pembelian, barang, jumlah, satuan, supplier, harga)
							VALUES ('$kode_pemb', '$barang', '$jumlah', '$stn', '$sp', '$harga')";
		$tambah	= mysqli_query($conn, $kueri) or die(mysqli_error($conn));
		$update = mysqli_query($conn, "UPDATE master_barang SET stok='$tambahstok' WHERE id_barang='$barang' ");

		//jika berhasil, maka akan diredirect
		if ($tambah && $update) {
			echo "
			<script>
				alert('Pembelian berhasil ditambahkan!');
				window.location.href='user_pembelian.php'
			</script>
			";
		} else {
			echo "
			<script>
				alert('Gagal menambah Pembelian!');
				window.location.href='user_pembelian.php'
			</script>
			";
		}
	}
}
// ubah aman
if (isset($_POST["ubahuserpembelian"])) {
	$id_pb = $_POST["id"];
	$kode = htmlspecialchars($_POST["kode_pembelian"]);
	$barang = htmlspecialchars($_POST["barang"]);
	$jumlah = htmlspecialchars($_POST["jumlah"]);
	$satuan = htmlspecialchars($_POST["satuan"]);
	$sp = htmlspecialchars($_POST["supplier"]);
	$harga = htmlspecialchars($_POST["harga"]);

	// cari tahu jumlah pembelian
	$kueri1 = mysqli_query($conn, "SELECT * FROM master_pembelian WHERE id_pembelian='$id_pb' ");
	$kueri2 = mysqli_fetch_array($kueri1);
	$jumlahsekarang = $kueri2["jumlah"];

	// stok barang
	$stok_barang1 = mysqli_query($conn, "SELECT * FROM master_barang WHERE id_barang='$barang'");
	$stok_barang2 = mysqli_fetch_array($stok_barang1);
	$stoksekarang = $stok_barang2["stok"];

	if ($jumlah >= $jumlahsekarang) {
		// kalau inputan jumlah lebih besar daripada jumlah yang tercatat
		// hitung selisih
		$selisih = $jumlah - $jumlahsekarang;
		$stokbaru = $stoksekarang + $selisih;

		// pembelian
		$query1 = mysqli_query($conn, "UPDATE master_pembelian SET kode_pembelian='$kode',
															 		barang='$barang',
																	jumlah='$jumlah',
																	satuan='$satuan',
																	supplier='$sp',
																	harga='$harga'
																WHERE id_pembelian='$id_pb'");

		// barang
		$query2 = mysqli_query($conn, "UPDATE master_barang SET stok='$stokbaru' WHERE id_barang='$barang'");

		if ($query1 && $query2) {
			echo "
			<script>
				alert('Berhasil diubah!');
				window.location.href='user_pembelian.php'
			</script>
			";
		} else {
			echo "
			<script>
				alert('Gagal diubah!');
				window.location.href='user_pembelian.php'
			</script>
			";
		}
	} else {
		// kalau lebih kecil
		// hitung selisih
		$selisih = $jumlahsekarang - $jumlah;
		$stokbaru = $stoksekarang - $selisih;

		// pembelian
		$query1 = mysqli_query($conn, "UPDATE master_pembelian SET kode_pembelian='$kode', 
											barang='$barang',
											jumlah='$jumlah',
											satuan='$satuan',
											supplier='$sp',
											harga='$harga'
										WHERE id_pembelian='$id_pb' ");

		// barang
		$query2 = mysqli_query($conn, "UPDATE master_barang SET stok='$stokbaru' WHERE id_barang='$barang'");

		if ($query1 && $query2) {
			echo "
			<script>
				alert('Berhasil diubah!');
				window.location.href='user_pembelian.php'
			</script>
			";
		} else {
			echo "
			<script>
				alert('Gagal diubah!');
				window.location.href='user_pembelian.php'
			</script>
			";
		}
	}
}
// hapus aman
if (isset($_POST["hpsuserpembelian"])) {
	$id = $_POST["id"];
	$barang = $_POST["barang"];
	$jumlah = $_POST["jumlah"];

	// cari tahu jumlah pembelian
	// $kueri1 = mysqli_query($conn, "SELECT * FROM master_pembelian WHERE id_pembelian='$id' ");
	// $kueri2 = mysqli_fetch_array($kueri1);
	// $jumlahsekarang = $kueri2["jumlah"];

	// stok barang
	$kueri3 = mysqli_query($conn, "SELECT * FROM master_barang WHERE id_barang='$barang' ");
	$kueri4 = mysqli_fetch_array($kueri3);
	$stoksekarang = $kueri4["stok"];

	// hitung pengurangan stok
	$stokbaru = $stoksekarang - $jumlah;

	// pembelian
	$delete = mysqli_query($conn, "DELETE FROM master_pembelian WHERE id_pembelian='$id'");

	// barang
	$update = mysqli_query($conn, "UPDATE master_barang SET stok='$stokbaru' WHERE id_barang='$barang'");

	if ($delete && $update) {
		echo "
			<script>
				alert('Berhasil dihapus!');
				window.location.href='user_pembelian.php'
			</script>
			";
	} else {
		echo "
			<script>
				alert('Gagal dihapus!');
				window.location.href='user_pembelian.php'
			</script>
			";
	}
}

// ==penjualan User
// tambah
if (isset($_POST["btnusertambah"])) {
	$kode_pen = htmlspecialchars(strtoupper($_POST["kode_penjualan"]));
	$brg = htmlspecialchars($_POST["id_barang"]); //id barang
	$jumlah = htmlspecialchars($_POST["jumlah"]);
	$satuan = htmlspecialchars($_POST["satuan"]);
	$harga = htmlspecialchars($_POST["harga"]);
	$user = htmlspecialchars($_POST["user"]);

	// hitung stok
	$hitung1 = mysqli_query($conn, "SELECT * FROM master_barang WHERE id_barang='$brg' ");
	$hitung2 = mysqli_fetch_array($hitung1);
	$stoksekarang = $hitung2["stok"];

	if ($stoksekarang > $jumlah) {
		// kurangi stok dengan jumlah yang akan dikeluarkan
		$selisih = $stoksekarang - $jumlah;
		//stok cukup
		$kueri = "INSERT INTO master_penjualan (kode_penjualan, barang, jumlah, satuan, harga, user) 
						VALUES ('$kode_pen', '$brg', '$jumlah', '$satuan', '$harga', '$user')";
		$tambah = mysqli_query($conn, $kueri) or die(mysqli_error($conn));
		$update = mysqli_query($conn, "UPDATE master_barang SET stok='$selisih' WHERE id_barang='$brg'");

		if ($tambah && $update) {
			echo "
			<script>
				alert('Penjualan berhasil ditambahkan!');
				window.location.href='user_penjualan.php'
			</script>
			";
		} else {
			echo "
			<script>
				alert('Gagal menambah Penjualan!');
				window.location.href='user_penjualan.php'
			</script>
			";
		}
	} else {
		//stok tidak cukup
		echo "
			<script>
				alert('Stok barang tidak cukup!');
				alert('Silahkan melakukan pembelian untuk menambah stok!');
				window.location.href='user_penjualan.php'
			</script>
			";
	}
}
// hapus
if (isset($_POST["btnuserhapus"])) {
	$id_pen = $_POST["id"]; //id penjualan
	$brg = $_POST["barang"]; //id barang

	// penjualan
	$kueri1 = mysqli_query($conn, "SELECT * FROM master_penjualan WHERE id_penjualan='$id_pen'");
	$kueri2 = mysqli_fetch_array($kueri1);
	$jumlahsekarang = $kueri2["jumlah"];

	// barang
	$kueri3 = mysqli_query($conn, "SELECT * FROM master_barang WHERE id_barang='$brg'");
	$kueri4 = mysqli_fetch_array($kueri3);
	$stoksekarang = $kueri4["stok"];

	// penambahan stok ketika dihapus
	$stoktambah = $stoksekarang + $jumlahsekarang;

	$hapus = mysqli_query($conn, "DELETE FROM master_penjualan WHERE id_penjualan='$id_pen'");
	$update = mysqli_query($conn, "UPDATE master_barang SET stok='$stoktambah' WHERE id_barang='$brg'");

	if ($hapus && $update) {
		echo "
			<script>
				alert('Berhasil dihapus!');
				window.location.href='user_penjualan.php'
			</script>
			";
	} else {
		echo "
			<script>
				alert('Gagal dihapus!');
				window.location.href='user_penjualan.php'
			</script>
			";
	}
}
// ubah
if (isset($_POST["ubahuserpenjualan"])) {
	$id = htmlspecialchars($_POST["id"]);
	$kode_pj = htmlspecialchars($_POST["kode_penjualan"]);
	$brg = htmlspecialchars($_POST["barang"]);
	$jumlah = htmlspecialchars($_POST["jumlah"]);
	$satuan = htmlspecialchars($_POST["satuan"]);
	$harga = htmlspecialchars($_POST["harga"]);
	$user = htmlspecialchars($_POST["user"]);

	// cari tahu jumlah pembelian sekarang
	$kueri1 = mysqli_query($conn, "SELECT * FROM master_penjualan WHERE id_penjualan='$id' ");
	$kueri2 = mysqli_fetch_array($kueri1);
	$jumlahsekarang = $kueri2["jumlah"];

	// stok barang sekarang
	$stok_barang1 = mysqli_query($conn, "SELECT * FROM master_barang WHERE id_barang='$brg'");
	$stok_barang2 = mysqli_fetch_array($stok_barang1);
	$stoksekarang = $stok_barang2["stok"];

	// if ($stoksekarang > $jumlah) {
	// } else {
	// 	//stok tidak cukup
	// 	echo "
	// 		<script>
	// 			alert('Stok barang tidak cukup!');
	// 			alert('Silahkan melakukan pembelian untuk menambah stok!');
	// 			window.location.href='master_penjualan.php'
	// 		</script>
	// 		";
	// }

	if ($jumlah >= $jumlahsekarang) {
		// kalau jumlah inputan lebih besar daripada jumlah yang tercatat
		// maka akan dihitung
		$selisih = $jumlah - $jumlahsekarang;
		$stokbaru = $stoksekarang - $selisih;


		// kueri update penjualan
		$query1 = mysqli_query($conn, "UPDATE master_penjualan SET kode_penjualan='$kode_pj',
																	barang='$brg',
																	jumlah='$jumlah',
																	satuan='$satuan',
																	harga='$harga',
																	user='$user'
																WHERE id_penjualan='$id' ");

		// kueri update barang
		$query2 = mysqli_query($conn, "UPDATE master_barang SET stok='$stokbaru' WHERE id_barang='$brg' ");

		// jika kueri penjualan dan barang di update
		if ($query1 && $query2) {
			echo "
			<script>
				alert('Berhasil diubah!');
				window.location.href='user_penjualan.php'
			</script>
			";
		} else {
			echo "
			<script>
				alert('Gagal diubah!');
				window.location.href='user_penjualan.php'
			</script>
			";
		}
	} else {
		// kalau lebih kecil
		// hitung selisih
		$selisih = $jumlahsekarang - $jumlah;
		$stokbaru = $stoksekarang + $selisih;

		// penjualan
		$query1 = mysqli_query($conn, "UPDATE master_penjualan SET kode_penjualan='$kode_pj', 
																	barang='$brg',
																	jumlah='$jumlah',
																	satuan='$satuan',
																	harga='$harga',
																	user='$user'
																WHERE id_penjualan='$id' ");

		// barang
		$query2 = mysqli_query($conn, "UPDATE master_barang SET stok='$stokbaru' WHERE id_barang='$brg'");

		if ($query1 && $query2) {
			echo "
			<script>
				alert('Berhasil diubah!');
				window.location.href='user_penjualan.php'
			</script>
			";
		} else {
			echo "
			<script>
				alert('Gagal diubah!');
				window.location.href='user_penjualan.php'
			</script>
			";
		}
	}
}

// ==USER==


// ==Pembelian Admin
// ==tambah aman
if (isset($_POST["btnpembelian"])) {
	$kode_pemb = htmlspecialchars(strtoupper($_POST["kode_pembelian"]));
	// $date = $_POST["tanggal"];
	$barang = htmlspecialchars($_POST["id_barang"]);
	$jumlah = htmlspecialchars($_POST["jumlah"]);
	$harga = htmlspecialchars($_POST["harga"]);
	$stn = htmlspecialchars($_POST["satuan"]);
	$sp = htmlspecialchars($_POST["supplier"]);

	// hitung stok
	$hitung1 = mysqli_query($conn, "SELECT * FROM master_barang WHERE id_barang='$barang'");
	$hitung2 = mysqli_fetch_array($hitung1);
	$stoksekarang = $hitung2["stok"]; //stok master_barang saat ini

	if ($stoksekarang && $jumlah) {
		//melakukan penambahan stok
		$tambahstok = $stoksekarang + $jumlah;
		//tambah
		$kueri = "INSERT INTO master_pembelian (kode_pembelian, barang, jumlah, satuan, supplier, harga)
							VALUES ('$kode_pemb', '$barang', '$jumlah', '$stn', '$sp', '$harga')";
		$tambah	= mysqli_query($conn, $kueri) or die(mysqli_error($conn));
		$update = mysqli_query($conn, "UPDATE master_barang SET stok='$tambahstok' WHERE id_barang='$barang' ");

		//jika berhasil, maka akan diredirect
		if ($tambah && $update) {
			echo "
			<script>
				alert('Pembelian berhasil ditambahkan!');
				window.location.href='master_pembelian.php'
			</script>
			";
		} else {
			echo "
			<script>
				alert('Gagal menambah Pembelian!');
				window.location.href='master_pembelian.php'
			</script>
			";
		}
	}

	// $kueri = "INSERT INTO master_pembelian (kode_pembelian, barang, jumlah, harga, satuan, supplier) 
	// 					VALUES ('$kode_pemb', '$barang', '$jumlah', '$harga', '$stn', '$sp')";
	// $tambah = mysqli_query($conn, $kueri) or die(mysqli_error($conn));

	// //jika berhasil, maka akan diredirect
	// if ($tambah) {
	// 	echo "
	// 		<script>
	// 			alert('Pembelian berhasil ditambahkan!');
	// 			window.location.href='master_pembelian.php'
	// 		</script>
	// 		";
	// } else {
	// 	echo "
	// 		<script>
	// 			alert('Gagal menambah Pembelian!');
	// 			window.location.href='master_pembelian.php'
	// 		</script>
	// 		";
	// }
}
// hapus aman
if (isset($_POST["hpspembelian"])) {
	$id = $_POST["id"];
	$barang = $_POST["barang"];
	$jumlah = $_POST["jumlah"];

	// cari tahu jumlah pembelian
	// $kueri1 = mysqli_query($conn, "SELECT * FROM master_pembelian WHERE id_pembelian='$id' ");
	// $kueri2 = mysqli_fetch_array($kueri1);
	// $jumlahsekarang = $kueri2["jumlah"];

	// stok barang
	$kueri3 = mysqli_query($conn, "SELECT * FROM master_barang WHERE id_barang='$barang' ");
	$kueri4 = mysqli_fetch_array($kueri3);
	$stoksekarang = $kueri4["stok"];

	// hitung pengurangan stok
	$stokbaru = $stoksekarang - $jumlah;

	// pembelian
	$delete = mysqli_query($conn, "DELETE FROM master_pembelian WHERE id_pembelian='$id'");

	// barang
	$update = mysqli_query($conn, "UPDATE master_barang SET stok='$stokbaru' WHERE id_barang='$barang'");

	if ($delete && $update) {
		echo "
			<script>
				alert('Berhasil dihapus!');
				window.location.href='master_pembelian.php'
			</script>
			";
	} else {
		echo "
			<script>
				alert('Gagal dihapus!');
				window.location.href='master_pembelian.php'
			</script>
			";
	}
}
//ubah aman
if (isset($_POST["ubahpembelian"])) {
	$id_pb = $_POST["id"];
	$kode = htmlspecialchars($_POST["kode_pembelian"]);
	$barang = htmlspecialchars($_POST["barang"]);
	$jumlah = htmlspecialchars($_POST["jumlah"]);
	$satuan = htmlspecialchars($_POST["satuan"]);
	$sp = htmlspecialchars($_POST["supplier"]);
	$harga = htmlspecialchars($_POST["harga"]);

	// cari tahu jumlah pembelian
	$kueri1 = mysqli_query($conn, "SELECT * FROM master_pembelian WHERE id_pembelian='$id_pb' ");
	$kueri2 = mysqli_fetch_array($kueri1);
	$jumlahsekarang = $kueri2["jumlah"];

	// stok barang
	$stok_barang1 = mysqli_query($conn, "SELECT * FROM master_barang WHERE id_barang='$barang'");
	$stok_barang2 = mysqli_fetch_array($stok_barang1);
	$stoksekarang = $stok_barang2["stok"];

	if ($jumlah >= $jumlahsekarang) {
		// kalau inputan jumlah lebih besar daripada jumlah yang tercatat
		// hitung selisih
		$selisih = $jumlah - $jumlahsekarang;
		$stokbaru = $stoksekarang + $selisih;

		// pembelian
		$query1 = mysqli_query($conn, "UPDATE master_pembelian SET kode_pembelian='$kode',
															 		barang='$barang',
																	jumlah='$jumlah',
																	satuan='$satuan',
																	supplier='$sp',
																	harga='$harga'
																WHERE id_pembelian='$id_pb'");

		// barang
		$query2 = mysqli_query($conn, "UPDATE master_barang SET stok='$stokbaru' WHERE id_barang='$barang'");

		if ($query1 && $query2) {
			echo "
			<script>
				alert('Berhasil diubah!');
				window.location.href='master_pembelian.php'
			</script>
			";
		} else {
			echo "
			<script>
				alert('Gagal diubah!');
				window.location.href='master_pembelian.php'
			</script>
			";
		}
	} else {
		// kalau lebih kecil
		// hitung selisih
		$selisih = $jumlahsekarang - $jumlah;
		$stokbaru = $stoksekarang - $selisih;

		// pembelian
		$query1 = mysqli_query($conn, "UPDATE master_pembelian SET kode_pembelian='$kode', 
											barang='$barang',
											jumlah='$jumlah',
											satuan='$satuan',
											supplier='$sp',
											harga='$harga'
										WHERE id_pembelian='$id_pb' ");

		// barang
		$query2 = mysqli_query($conn, "UPDATE master_barang SET stok='$stokbaru' WHERE id_barang='$barang'");

		if ($query1 && $query2) {
			echo "
			<script>
				alert('Berhasil diubah!');
				window.location.href='master_pembelian.php'
			</script>
			";
		} else {
			echo "
			<script>
				alert('Gagal diubah!');
				window.location.href='master_pembelian.php'
			</script>
			";
		}
	}
}

// ==Penjualan Admin
// ==tambah aman
if (isset($_POST["btnpenjualan"])) {
	$kode_pen = htmlspecialchars(strtoupper($_POST["kode_penjualan"]));
	$brg = htmlspecialchars($_POST["id_barang"]); //id barang
	$jumlah = htmlspecialchars($_POST["jumlah"]);
	$satuan = htmlspecialchars($_POST["satuan"]);
	$harga = htmlspecialchars($_POST["harga"]);
	$user = htmlspecialchars($_POST["user"]);


	// hitung stok
	$hitung1 = mysqli_query($conn, "SELECT * FROM master_barang WHERE id_barang='$brg'");
	$hitung2 = mysqli_fetch_array($hitung1);
	$stoksekarang = $hitung2["stok"]; //stok master_barang saat ini

	if ($stoksekarang > $jumlah) {

		// kurangi stok dengan jumlah yang akan dikeluarkan
		$selisih = $stoksekarang - $jumlah;
		//stok cukup
		$kueri = "INSERT INTO master_penjualan (kode_penjualan, barang, jumlah, satuan, harga, user) 
						VALUES ('$kode_pen', '$brg', '$jumlah', '$satuan', '$harga', '$user')";
		$tambah = mysqli_query($conn, $kueri) or die(mysqli_error($conn));
		$update = mysqli_query($conn, "UPDATE master_barang SET stok='$selisih' WHERE id_barang='$brg'");

		//jika berhasil, maka akan diredirect
		if ($tambah && $update) {
			echo "
			<script>
				alert('Penjualan berhasil ditambahkan!');
				window.location.href='master_penjualan.php'
			</script>
			";
		} else {
			echo "
			<script>
				alert('Gagal menambah Penjualan!');
				window.location.href='master_penjualan.php'
			</script>
			";
		}
	} else {
		//stok tidak cukup
		echo "
			<script>
				alert('Stok barang tidak cukup!');
				alert('Silahkan melakukan pembelian untuk menambah stok!');
				window.location.href='master_penjualan.php'
			</script>
			";
	}
}
// hapus 
if (isset($_POST["hapuspenjualan"])) {
	$id_pen = $_POST["id"]; //id penjualan
	$brg = $_POST["barang"]; //id barang

	// penjualan
	$kueri1 = mysqli_query($conn, "SELECT * FROM master_penjualan WHERE id_penjualan='$id_pen'");
	$kueri2 = mysqli_fetch_array($kueri1);
	$jumlahsekarang = $kueri2["jumlah"];

	// barang
	$kueri3 = mysqli_query($conn, "SELECT * FROM master_barang WHERE id_barang='$brg'");
	$kueri4 = mysqli_fetch_array($kueri3);
	$stoksekarang = $kueri4["stok"];

	// penambahan stok ketika dihapus
	$stoktambah = $stoksekarang + $jumlahsekarang;

	$hapus = mysqli_query($conn, "DELETE FROM master_penjualan WHERE id_penjualan='$id_pen'");
	$update = mysqli_query($conn, "UPDATE master_barang SET stok='$stoktambah' WHERE id_barang='$brg'");

	if ($hapus && $update) {
		echo "
			<script>
				alert('Berhasil dihapus!');
				window.location.href='master_penjualan.php'
			</script>
			";
	} else {
		echo "
			<script>
				alert('Gagal dihapus!');
				window.location.href='master_penjualan.php'
			</script>
			";
	}
}
//ubah aman
if (isset($_POST["btnubahpenjualan"])) {
	$id = htmlspecialchars($_POST["id"]);
	$kode_pj = htmlspecialchars($_POST["kode_penjualan"]);
	$brg = htmlspecialchars($_POST["barang"]);
	$jumlah = htmlspecialchars($_POST["jumlah"]);
	$satuan = htmlspecialchars($_POST["satuan"]);
	$harga = htmlspecialchars($_POST["harga"]);
	$user = htmlspecialchars($_POST["user"]);

	// cari tahu jumlah pembelian sekarang
	$kueri1 = mysqli_query($conn, "SELECT * FROM master_penjualan WHERE id_penjualan='$id' ");
	$kueri2 = mysqli_fetch_array($kueri1);
	$jumlahsekarang = $kueri2["jumlah"];

	// stok barang sekarang
	$stok_barang1 = mysqli_query($conn, "SELECT * FROM master_barang WHERE id_barang='$brg'");
	$stok_barang2 = mysqli_fetch_array($stok_barang1);
	$stoksekarang = $stok_barang2["stok"];

	// if ($stoksekarang > $jumlah) {
	// } else {
	// 	//stok tidak cukup
	// 	echo "
	// 		<script>
	// 			alert('Stok barang tidak cukup!');
	// 			alert('Silahkan melakukan pembelian untuk menambah stok!');
	// 			window.location.href='master_penjualan.php'
	// 		</script>
	// 		";
	// }

	if ($jumlah >= $jumlahsekarang) {
		// kalau jumlah inputan lebih besar daripada jumlah yang tercatat
		// maka akan dihitung
		$selisih = $jumlah - $jumlahsekarang;
		$stokbaru = $stoksekarang - $selisih;


		// kueri update penjualan
		$query1 = mysqli_query($conn, "UPDATE master_penjualan SET kode_penjualan='$kode_pj',
																	barang='$brg',
																	jumlah='$jumlah',
																	satuan='$satuan',
																	harga='$harga',
																	user='$user'
																WHERE id_penjualan='$id' ");

		// kueri update barang
		$query2 = mysqli_query($conn, "UPDATE master_barang SET stok='$stokbaru' WHERE id_barang='$brg' ");

		// jika kueri penjualan dan barang di update
		if ($query1 && $query2) {
			echo "
			<script>
				alert('Berhasil diubah!');
				window.location.href='master_penjualan.php'
			</script>
			";
		} else {
			echo "
			<script>
				alert('Gagal diubah!');
				window.location.href='master_penjualan.php'
			</script>
			";
		}
	} else {
		// kalau lebih kecil
		// hitung selisih
		$selisih = $jumlahsekarang - $jumlah;
		$stokbaru = $stoksekarang + $selisih;

		// penjualan
		$query1 = mysqli_query($conn, "UPDATE master_penjualan SET kode_penjualan='$kode_pj', 
																	barang='$brg',
																	jumlah='$jumlah',
																	satuan='$satuan',
																	harga='$harga',
																	user='$user'
																WHERE id_penjualan='$id' ");

		// barang
		$query2 = mysqli_query($conn, "UPDATE master_barang SET stok='$stokbaru' WHERE id_barang='$brg'");

		if ($query1 && $query2) {
			echo "
			<script>
				alert('Berhasil diubah!');
				window.location.href='master_penjualan.php'
			</script>
			";
		} else {
			echo "
			<script>
				alert('Gagal diubah!');
				window.location.href='master_penjualan.php'
			</script>
			";
		}
	}
}
