<?php
// echo $_POST[jenis];
// die();
require_once "funlibs.php";
$con = new Database();
$date = date("Y-m-d H:i:s");
$date2 = date("Y-m-d_H-i-s");
$tabel = "mtpegawai";
$namasatu = stripslashes(addslashes($_POST['nama1']));
$namadua = stripslashes(addslashes($_POST['nama2']));
if ($_POST['jenis'] == 'edit') {
	$tabel = "mtpegawai";
	$idpeg = $con->idurut("mtpegawai", "id_pegawai");
	$idagent = $con->idurut("mtagent", "id_agent");
	$extensi = array('png', 'jpg', 'jpeg');
	$nama = $_FILES['file_img']['name'];
	$namaasli = $idpeg . $date2 . '.jpg';
	$x = explode('.', $nama);
	$eks = strtolower(end($x));
	$ukuran = $_FILES['file_img']['size'];
	$file_tmp = $_FILES['file_img']['tmp_name'];
	$path = "assets/img/pegawai/";

	$data = array(
		/*'nama_berita' => $_POST[nama],*/
		'nama_pegawai' => $namasatu . " " . $namadua,
		'nama_awal' => $namasatu,
		'nama_akhir' => $namadua,
		'email' => $_POST['email'],
		'phone' => $_POST['phone'],
		'id_jabatan' => $_POST['position'],
		'id_cabang' => $_POST['location'],
		'id_status' => $_POST['setatus'],
		'dateupdate_pegawai' => $date,
	);

	$data2 = array(
		/*'nama_berita' => $_POST[nama],*/
		'id_jobcat' => $_POST['jobcat'],
		'dateupdate_agent' => $date
	);

	$exec = $con->update($tabel, $data, "id_pegawai = '$_POST[peg]'");
	$exec2 = $con->update("mtagent", $data2, "id_agent = '$_POST[kode]'");

	if ($exec2) {
		echo "<script>alert('Successfully')</script>";
		echo "<script>window.location='content.php?p=$_POST[getp]&d=$_POST[kode]'</script>";
	} else {
		echo "<script>alert('Not Saved')</script>";
		echo "<script>window.location='content.php?p=$_POST[getp]&d=$_POST[kode]'</script>";
	}
}
if ($_POST['jenis'] == 'image') {
	$extensi = array('png', 'jpg', 'jpeg');
	$nama = $_FILES['file_img']['name'];
	$namaasli = $idpeg . $date2 . '.jpg';
	$x = explode('.', $nama);
	$eks = strtolower(end($x));
	$ukuran = $_FILES['file_img']['size'];
	$file_tmp = $_FILES['file_img']['tmp_name'];
	$path = "assets/img/pegawai/";

	$data = array(
		'image' => $namaasli
	);

	//echo $nama." ".$file_tmp;
	$nama2 = $_POST['nm_gambar'];
	$folder = "assets/img/pegawai/$nama2";

	if (file_exists($folder)) {
		unlink($folder);
	}
	if (file_exists($folder)) {
		echo "Delete sukses";
	} else {
		"Delete error";
	}
	//print_r($_FILES);
	if (!empty($_FILES)) {
		if (in_array($eks, $extensi) === true) {
			if ($ukuran < 2044070) {

				if (move_uploaded_file($file_tmp, $path . $namaasli)) {
					$exec = $con->update($tabel, $data, "id_pegawai = '$_POST[peg]'");
					//var_dump($exec);
				} else {
					echo 'GAGAL MENGUPLOAD GAMBAR';
				}
				//echo $file_tmp,$path.$namaasli;
			} else {
				echo 'UKURAN FILE TERLALU BESAR';
			}
		} else {
			echo 'EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN';
		}
	}
	if ($exec) {
		echo "<script>alert('Successfully')</script>";
		echo "<script>window.location='content.php?p=ag1'</script>";
	} else {
		echo "<script>alert('Not Saved')</script>";
		echo "<script>window.location='content.php?p=ag1'</script>";
	}
} else if ($_POST[jenis] == 'tambah') {
	$idpeg = $con->idurut("mtpegawai", "id_pegawai");
	$idagent = $con->idurut("mtagent", "id_agent");
	$extensi = array('png', 'jpg', 'jpeg');
	$nama = $_FILES['file_img']['name'];
	$namaasli = $idpeg . $date2 . '.jpg';
	$x = explode('.', $nama);
	$eks = strtolower(end($x));
	$ukuran = $_FILES['file_img']['size'];
	$file_tmp = $_FILES['file_img']['tmp_name'];
	$path = "assets/img/pegawai/";

	$data2 = array(
		/*'nama_berita' => $_POST[nama],*/
		'id_agent' => $idagent,
		'id_pegawai' => $idpeg,
		'id_jobcat' => $_POST['jobcat'],
		'dateupdate_agent' => $date
	);

	//echo $nama." ".$file_tmp;
	//print_r($_FILES);
	//die();
	print_r($_FILES['file_img']['error'] === UPLOAD_ERR_OK);
	print_r($_FILES['file_img']['error']);
	print_r(UPLOAD_ERR_OK);
	//die();
	if ($_FILES['file_img']['error'] === UPLOAD_ERR_OK) {
		if (in_array($eks, $extensi) === true) {
			if ($ukuran < 2044070) {

				if (move_uploaded_file($file_tmp, $path . $namaasli)) {
					$data = array(
						/*'nama_berita' => $_POST[nama],*/
						'id_pegawai' => $idpeg,
						'nama_pegawai' => $namasatu . " " . $namadua,
						'nama_awal' => $namasatu,
						'nama_akhir' => $namadua,
						'email' => $_POST['email'],
						'phone' => $_POST['phone'],
						'id_jabatan' => $_POST['position'],
						'id_cabang' => $_POST['location'],
						'id_status' => 1,
						'id_departemen' => 1,
						'dateupdate_pegawai' => $date,
						'image' => $namaasli
					);
					$exec = $con->insert($tabel, $data);
					$exec2 = $con->insert("mtagent", $data2);
				} else {
					echo 'GAGAL MENGUPLOAD GAMBAR';
				}
				//echo $file_tmp,$path.$namaasli;
			} else {
				echo 'UKURAN FILE TERLALU BESAR';
			}
		} else {
			echo 'EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN';
		}
	} else {
		$data = array(
			/*'nama_berita' => $_POST[nama],*/
			'id_pegawai' => $idpeg,
			'nama_pegawai' => $namasatu . " " . $namadua,
			'nama_awal' => $namasatu,
			'nama_akhir' => $namadua,
			'email' => $_POST['email'],
			'phone' => $_POST['phone'],
			'id_jabatan' => $_POST['position'],
			'id_cabang' => $_POST['location'],
			'id_status' => 1,
			'id_departemen' => 1,
			'dateupdate_pegawai' => $date,
		);
		$exec = $con->insert($tabel, $data);
		$exec2 = $con->insert("mtagent", $data2);
	}
	if ($exec2) {
		echo "<script>alert('Successfully')</script>";
		echo "<script>window.location='content.php?p=$_POST[getp]'</script>";
	} else {
		echo "<script>alert('Not Saved')</script>";
		echo "<script>window.location='content.php?p=$_POST[getp]'</script>";
	}
}
