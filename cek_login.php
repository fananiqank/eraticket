<?php
//error_reporting(0);
session_start ();
date_default_timezone_set ( 'Asia/Jakarta' );
include 'funlibs.php';
$con = new Database();
//$check = $_POST['check'];
$username = addslashes(trim($_POST ['username']));
//$pass = md5($_POST ['pwd']);
$pass = sha1($_POST ['pwd']);
//$pref =$con->select("people","id_pref,nopref,nama_perusahaan,logo,alamat,no_telp", "id_pref = '1'");
if($username=='admin'){
	$tabel = "people a";
	$fild  = "a.id,a.name,a.clientid,a.title"; //menampilkan semua fild
	$where = "email='$username' AND password='$pass' and a.statusid = 'Active' and approval_type > 0";
	$dtk=$con->select($tabel,$fild,$where);
	//echo "select $fild from $tabel where $where";
}else{
	$tabel = "people a";
	$fild  = "a.id,a.name,a.clientid,a.title"; //menampilkan semua fild
	$where = "email='$username' AND password='$pass' and a.statusid = 'Active' and approval_type > 0";
	$dtk=$con->select($tabel,$fild,$where);
	//echo "select $fild from $tabel where $where";
}

	if(count($dtk)>=1 and $check==null)
	{
		foreach($pref as $val){
		$_SESSION['ID_PREF'] = $val['id_pref'];
		$_SESSION['NOPREF'] = $val['nopref'];
		$_SESSION['NAMA_PERUSAHAAN'] = $val['nama_perusahaan'];
		$_SESSION['LOGO'] = $val['logo'];
		$_SESSION['ALAMAT'] = $val['alamat'];
		$_SESSION['NO_TELP'] = $val['no_telp'];
}
		foreach($dtk as $value){
			$_SESSION ['ID_LOGIN'] = $value['id'];
			$_SESSION ['ID_PEG'] = $value['id'];
			$_SESSION ['ID_CLIENT'] = $value['clientid'];
			$_SESSION ['NAMA_PEG'] = $value['name'];
        	$user_ip = getenv('REMOTE_ADDR');
			$name = gethostbyaddr($user_ip);
			
			$datas = array(  
		   'peopleid' => $value['id'],
		   'ipaddress' => $user_ip,
		   'description' => 'Login Approve Success',
		   'timestamp' => date("Y-m-d H:i:s"),
		  );
			$exec=$con->insert("systemlog",$datas);
			
			
			if ($exec) {
				echo "<script>location.href='content.php?p=$_POST[halaman]&d=$_POST[dataid]';</script>";
			} else {
        		echo "<script>location.href='$hs';</script>";	
        	}
	   }	
	} 
	elseif(count($dtk)>=1 and $check==1){
		foreach($dtk as $value){
			$_SESSION ['ID_LOGIN'] = $value['id'];
			$_SESSION ['ID_PEG'] = $value['id'];
			$_SESSION ['ID_CLIENT'] = $value['clientid'];
			$_SESSION ['NAMA_PEG'] = $value['name'];
			echo $value['id'];
			die();
			if ($value['id'] <> '') {
				echo "<script>location.href='content.php?p=$_POST[halaman]&d=$_POST[dataid]';</script>";
			} else {
				echo "<script>location.href='$hsi';</script>";
			}
        	

	   }	
	} 
	else {
		//die;
			//echo $_SESSION[ID_ROLE];		
			echo "<script>location.href='login.php';</script>"; 
	}
	
?>
