<?php
//error_reporting(0);
session_start ();
date_default_timezone_set ( 'Asia/Jakarta' );
include 'funlibs.php';
$con = new Database();
//$check = $_POST['check'];
$username = addslashes(trim($_POST ['username']));
$pass = md5($_POST ['pwd']);
$pref =$con->select("mtpreference","id_pref,nopref,nama_perusahaan,logo,alamat,no_telp", "id_pref = '1'");
if($username=='admin'){
	$tabel = "mauser_login a join mtpegawai b on a.ID_PEGAWAI=b.ID_PEGAWAI
	left join mtjabatan c on b.id_jabatan = c.id_jabatan";
	$fild  = "a.ID,a.ID_PEGAWAI,a.ID_GUDANG,b.id_cabang,b.id_jabatan,b.nama_pegawai,a.ID_ROLE,a.KETERANGAN"; //menampilkan semua fild
	$where = "username='$username' AND password='$pass' and a.STATUS != 0";
	$dtk=$con->select($tabel,$fild,$where);
	//echo "select $fild from $tabel where $where";
}else{
	$tabel = "mauser_login a join mtpegawai b on a.ID_PEGAWAI=b.ID_PEGAWAI
	left join mtjabatan c on b.id_jabatan = c.id_jabatan";
	$fild  = "a.ID,a.ID_PEGAWAI,a.ID_GUDANG,b.id_cabang,b.id_jabatan,b.nama_pegawai,a.ID_ROLE,a.KETERANGAN"; //menampilkan semua fild
	$where = "username='$username' AND password='$pass' and a.STATUS != 0";
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
			$_SESSION ['ID_LOGIN'] = $value['ID'];
			$_SESSION ['ID_PEG'] = $value['ID_PEGAWAI'];
			$_SESSION ['ID_GUDANG'] = $value['ID_GUDANG'];
			$_SESSION ['ID_CABANG'] = $value['id_cabang'];
			$_SESSION ['ID_JABATAN'] = $value['id_jabatan'];
			$_SESSION ['ID_ROLE'] = $value['ID_ROLE'];
			$_SESSION ['JEN'] = $value['KETERANGAN'];
			//$_SESSION ['ID_DIV'] = $value['id_divisi'];
			$_SESSION ['NAMA_PEG'] = $value['nama_pegawai'];
        	$user_ip = getenv('REMOTE_ADDR');
			$name = gethostbyaddr($user_ip);
			
			$datas = array(  
		   'username' => $_POST['username'],
		   'ip' => $user_ip,
		   'hostname' => $name,
		   'stampdate' => date("Y-m-d H:i:s"),
		  );
			$exec=$con->insert("user_log",$datas);
				//die;
			if ($_POST['emm'] == 1) {
				echo "<script>location.href='content.php?p=$_POST[halaman]&d=$_POST[dataid]';</script>";
			} else {
        		echo "<script>location.href='$hs';</script>";	
        	}
	   }	
	} 
	elseif(count($dtk)>=1 and $check==1){
		foreach($dtk as $value){
			$_SESSION ['ID_LOGIN'] = $value['ID'];
			$_SESSION ['ID_PEG'] = $value['id_pegawai'];
			$_SESSION ['ID_GUDANG'] = $value['ID_GUDANG'];
			$_SESSION ['ID_CABANG'] = $value['ID_CABANG'];
			$_SESSION ['ID_JABATAN'] = $value['id_jabatan'];
			$_SESSION ['ID_ROLE'] = $value['ID_ROLE'];
			$_SESSION ['ANDROID'] = $check;
			//$_SESSION ['ID_DIV'] = $value['id_divisi'];
			$_SESSION ['NAMA_PEG'] = $value['nama_pegawai'];
			//echo $_SESSION[ID_ROLE]."s";
			//die;
			if ($_POST['emm'] == 1) {
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
