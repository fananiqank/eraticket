<?php	
	$date = date("Y-m-d H:i:s");
	$date2 = date("Y-m-d_G-i-s");
	$tabel = "mtkategoritopik";
	$problem = trim($_POST['problem']);
	$analisis = trim($_POST['analisis']);
	$solusi = trim($_POST['solusi']);
if($_POST['jenis']=='edit'){
	if ($_POST['sub']){
		
		$where = array("id_topik" => $_POST['kode']);
		$con->delete("mttopik",$where);

		$idtopik = $con->idurut("mttopik","id_topik");
		$data = array( 
				'id_topik' => $idtopik,
			    'problem' => $problem,
			    'analisis' => $analisis,
			    'solusi' => $solusi,
			 	'status_topik' => 1,
			 	'id_kattopik' => $_POST['sub'],
			 	'tips' =>  $_POST['tips'],
			 	'dateupdate_topik' => $date,
			 	'jenis_topik' => 1,
		); 

		$exec= $con->insert("mttopik", $data);
		if($exec){
			echo "<script>alert('Successfully')</script>";  
			echo "<script>window.location='content.php?p=$_POST[getp]&sub=$_POST[sub]'</script>";  
		} else {
			echo "<script>alert('Not Saved')</script>"; 
			echo "<script>window.location='content.php?p=$_POST[getp]&sub=$_POST[sub]'</script>";  
		}
	} else {
		$data = array( 
			    'nama_kattopik' => $_POST['nama'],
			 	'dateupdate_kattopik' => $date,
			); 
			$exec= $con->update($tabel, $data,"id_kattopik = '$_POST[kode]'");

		if($exec){
			echo "<script>alert('Successfully')</script>";  
			echo "<script>window.location='content.php?p=$_POST[getp]'</script>";  
		} else {
			echo "<script>alert('Not Saved')</script>"; 
			echo "<script>window.location='content.php?p=$_POST[getp]'</script>";  
		}
	}
} else if ($_GET['j']){
	if($_GET['sub']){
		$where = array("id_topik" => $_GET['j']);
				//echo $_POST[kode];
		$exec = $con->delete("mttopik",$where);
		if($exec){
			echo "<script>alert('Successfully')</script>";  
			echo "<script>window.location='content.php?p=to1&sub=$_GET[sub]'</script>";  
		} else {
			echo "<script>alert('Not Saved')</script>"; 
			echo "<script>window.location='content.php?p=to1&sub=$_GET[sub]'</script>";  
		}
	} else {
		$where = array("id_kattopik" => $_GET['j']);
				//echo $_POST[kode];
		$exec = $con->delete("mtkategoritopik",$where);
		if($exec){
			echo "<script>alert('Successfully')</script>";  
			echo "<script>window.location='content.php?p=to1'</script>";  
		} else {
			echo "<script>alert('Not Saved')</script>"; 
			echo "<script>window.location='content.php?p=to1'</script>";  
		}
	}
}else {
	if($_POST['sub']) {
		$idtopik = $con->idurut("mttopik","id_topik");
		$data = array( 
				'id_topik' => $idtopik,
			    'problem' => $problem,
			    'analisis' => $analisis,
			    'solusi' => $solusi,
			 	'status_topik' => 1,
			 	'id_kattopik' => $_POST['sub'],
			 	'tips' =>  $_POST['tips'],
			 	'dateupdate_topik' => $date,
			 	'jenis_topik' => 1,
		); 

		$exec= $con->insert("mttopik", $data);
		if($exec){

			echo "<script>alert('Successfully')</script>";  
			echo "<script>window.location='content.php?p=$_POST[getp]&sub=$_POST[sub]'</script>";  
		} else {
			echo "<script>alert('Not Saved')</script>"; 
			echo "<script>window.location='content.php?p=$_POST[getp]&sub=$_POST[sub]'</script>";  
		}

	} else {

		$idkattopik = $con->idurut($tabel,"id_kattopik");
		$data = array( 
		 	    'id_kattopik' => $idkattopik,
				'nama_kattopik' => $_POST['nama'],
				'status_kattopik' => 1,
				'dateupdate_kattopik' => $date,
				'jenis_kattopik' => 1,
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

