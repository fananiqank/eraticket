<?php	

	$date = date("Y-m-d H:i:s");
	$date2 = date("Y-m-d_G-i-s");
	$tabel = "mauser_login";
		
	$pass1=md5($_POST['password']);
	$pass2=md5($_POST['password2']);

if($_POST['jenis'] == 'edit'){
	if($_POST['password'] != ''){
		if($pass1===$pass2){	
			$data = array(  
					 'ID_PEGAWAI' => $_POST['pegawai'],
					 'ID_ROLE' => $_POST['role'],
					 'USERNAME' => $_POST['username'],
					 'PASSWORD' => $pass1,
					 'STAMPDATE' => $date,
					 'STATUS' => $_POST['setatus'],
			);
			$exec= $con->update($tabel, $data,"ID = '$_POST[kode]'");
		} else {
			echo "<script>alert('Password Salah');</script>"."<script>window.location='content.php?p=$_POST[getp]'</script>";
			
		}
	} else {
		$data = array( 
			'ID_PEGAWAI' => $_POST['pegawai'],
			'ID_ROLE' => $_POST['role'],
			'USERNAME' => $_POST['username'],
			'STAMPDATE' => $date,
			'STATUS' => $_POST['setatus'],
		);
		$exec= $con->update($tabel, $data,"ID = '$_POST[kode]'");
	}
		if($exec){
			echo "<script>alert('Successfully')</script>";  
			echo "<script>window.location='content.php?p=$_POST[getp]'</script>";  
		} else {
			echo "<script>alert('Not Saved')</script>"; 
			echo "<script>window.location='content.php?p=$_POST[getp]'</script>";  
		}
}
else if ($_GET['j']){
		
				$data = array( 
						'STATUS' => 0,
						'STAMPDATE' => $date, 
						); 
				$exec= $con->update("mauser_login", $data, "ID = '$_GET[j]'");
				if($exec){
					echo "<script>alert('Successfully')</script>";  
					echo "<script>window.location='content.php?p=us1'</script>";  
				} else {
					echo "<script>alert('Not Saved')</script>"; 
					echo "<script>window.location='content.php?p=us1'</script>";  
				}
			
		
} else {
	if($pass1===$pass2){
		$id=$con->idurut($tabel,"ID");
		$data = array( 
				 'ID' => $id, 
				 'ID_PEGAWAI' => $_POST['pegawai'],
				 'ID_ROLE' => $_POST['role'],
				 'USERNAME' => $_POST['username'],
				 'PASSWORD' => $pass1,
				 'STATUS' => 1,
				 'STAMPDATE' => $date,
		);
		$exec= $con->insert($tabel, $data);
	} else {
		echo "<script>alert('Password Salah');</script>"."<script>window.location='content.php?p=$_POST[getp]'</script>";
	}
}