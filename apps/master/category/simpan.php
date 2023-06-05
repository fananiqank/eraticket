<?php	

	$date = date("Y-m-d H:i:s");
	$date2 = date("Y-m-d_G-i-s");
	$tabel = "mtkategori";
if($_POST['jenis']=='edit'){
	if ($_POST['sub']){
			$data = array( 
			    'nama_kategori_sub' => $_POST['nama'],
			 	'dateupdate_kategori_sub' => $date
			); 
			$exec= $con->update("mtkategori_sub", $data,"id_kategori_sub = '$_POST[kode]'");

		if($exec){
			echo "<script>alert('Successfully')</script>";  
			echo "<script>window.location='content.php?p=$_POST[getp]&sub=$_POST[sub]'</script>";  
		} else {
			echo "<script>alert('Not Saved')</script>"; 
			echo "<script>window.location='content.php?p=$_POST[getp]&sub=$_POST[sub]'</script>";  
		}
	} else {
		$data = array( 
			    'nama_kategori' => $_POST['nama'],
			 	'dateupdate_kategori' => $date
			); 
			$exec= $con->update($tabel, $data,"id_kategori = '$_POST[kode]'");

		if($exec){
			echo "<script>alert('Successfully')</script>";  
			echo "<script>window.location='content.php?p=$_POST[getp]'</script>";  
		} else {
			echo "<script>alert('Not Saved')</script>"; 
			echo "<script>window.location='content.php?p=$_POST[getp]'</script>";  
		}
	}
} else {
	if($_POST['sub']) {
		$idkategori_sub = $con->idurut("mtkategori_sub","id_kategori_sub");
		$data = array( 
		 	    'id_kategori_sub' => $idkategori_sub,
				'nama_kategori_sub' => $_POST['nama'],
				'status_kategori_sub' => 1,
				'dateupdate_kategori_sub' => $date,
				'id_kategori' => $_POST['sub'] 
				); 
		$exec= $con->insert("mtkategori_sub", $data);
		if($exec){
			echo "<script>alert('Successfully')</script>";  
			echo "<script>window.location='content.php?p=$_POST[getp]&sub=$_POST[sub]'</script>";  
		} else {
			echo "<script>alert('Not Saved')</script>"; 
			echo "<script>window.location='content.php?p=$_POST[getp]&sub=$_POST[sub]'</script>";  
		}

	} else {
	
		if ($_GET['j']){
			if ($_GET['s']){
				$pager = explode("_",$_GET['p']);
				$pag = $pager[0];
				$idkategori_sub = $con->idurut("mtkategori_sub","id_kategori_sub");
				$data = array( 
						'status_kategori_sub' => 9,
						'dateupdate_kategori_sub' => $date,
						); 
				$exec= $con->update("mtkategori_sub", $data, "id_kategori_sub = '$_GET[j]'");
				if($exec){
					echo "<script>alert('Successfully')</script>";  
					echo "<script>window.location='content.php?p=$pag&sub=$_GET[s]'</script>";  
				} else {
					echo "<script>alert('Not Saved')</script>"; 
					echo "<script>window.location='content.php?p=$pag$sub=$_GET[s]'</script>";  
				}
			} else {
				$pager = explode("_",$_GET['p']);
				$pag = $pager[0];
				$data = array( 
						'status_kategori' => 9,
						'dateupdate_kategori' => $date, 
						); 
				$exec= $con->update("mtkategori", $data, "id_kategori = '$_GET[j]'");
				if($exec){
					echo "<script>alert('Successfully')</script>";  
					echo "<script>window.location='content.php?p=$pag'</script>";  
				} else {
					echo "<script>alert('Not Saved')</script>"; 
					echo "<script>window.location='content.php?p=$pag'</script>";  
				}
			}
		} else {
			$idkategori = $con->idurut($tabel,"id_kategori");
			$data = array( 
			 	    'id_kategori' => $idkategori,
					'nama_kategori' => $_POST['nama'],
					'status_kategori' => 1,
					'dateupdate_kategori' => $date
					); 
			$exec= $con->insert($tabel, $data);
			if($exec){
				echo "<script>alert('Successfully')</script>";  
				echo "<script>window.location='content.php?p=$_POST[getp]'</script>";  
			} else {
				echo "<script>alert('Not Saved')</script>"; 
				echo "<script>window.location='content.php?p=$_POST[getp]'</script>";  
			}
		}
	}
}

