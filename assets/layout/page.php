<?php
//error_reporting(0);
// error_reporting(E_ALL & ~E_NOTICE);
/*				$query=mysql_query("SELECT * FROM site_config WHERE ID='1'");
				while ($site=mysql_fetch_array($query))
				{
					$site_name= $site['NAMA'];
					$site_ket = $site['KETERANGAN']; 
					$site_kota= $site['KOTA'];
					$site_logo= $site['LOGO'];
					$site_fax= $site['TELP'];
					$site_telp= $site['FAX'];
					$site_email= $site['EMAIL'];
					$site_alamat= $site['ALAMAT']; 
				}


$id_user=$_SESSION['ID_PEG'];
$hak_menunya="";
$qhak_akses=mysql_query("SELECT * FROM hak_akses WHERE ID_USER='$id_user'");
while ($hak_akses=mysql_fetch_assoc($qhak_akses)){
	$hak_menunya=$hak_menunya."".$hak_akses['ID_MENU'].",";
}
$ids_menu = rtrim($hak_menunya, ',');
*/
//echo $_GET[p];
if (!empty($_GET['p'])) {
	$awal=substr($_GET[p], 0,1);
	$as = substr($_GET[p], -2,2);
	if ($awal=="v"){
		$page=substr($_GET[p], 1,2);
		$pagesub=substr($_GET[p], 1,2);
	} else if ($as=="_s"){
	 	$mn = substr($_GET[p], 0,3);
	 	$page="simpan";
	 	$pagesub=substr($_GET[p], 0,2);
	}
	else {
		$page=substr($_GET[p], 0,2);
		$pagesub=substr($_GET[p], 0,2);
	}

		$selhakas = $con->select("mtrole a join mtrole_dtl b on a.id_role=b.id_role join mamenu c on c.ID=b.id_menu",
		"b.id_menu"," SLUG = '$pagesub' and a.id_role = '$_SESSION[ID_ROLE]'");
	foreach ($selhakas as $hakas) {}
		//echo "select id_menu from mtrole a join mtrole_dtl b on a.id_role=b.id_role join mamenu c on c.ID=b.id_menu where SLUG = '$page' and a.id_role = $_SESSION[ID_ROLE]";
	//die;
		if(count($hakas[id_menu]) > 0){
			$page = $page;
			$pagesub = $pagesub;
			$mn = $mn;
		} else {
		echo "<script>location.href='login.php';</script>"; 
		}
} else {
	$page="Home";
}
if($awal == 'v') {
$menu=$con->select("mamenu","*","(JENIS_PAGE is not null or JENIS_PAGE!='') and STATUS='1'");
} else if($awal != 'v'){
$menu=$con->select("mamenu","*","(JENIS_PAGE is not null or JENIS_PAGE!='') and STATUS='1' and SLUG = '$pagesub'");
}
	foreach($menu as $menuval){
			if($menuval['JENIS_PAGE']=='0'){ 
				$folder="apps/master";
			}elseif($menuval['JENIS_PAGE']=='1'){ 
				$folder="apps/transaction";
			}elseif($menuval['JENIS_PAGE']=='2'){ 
				$folder="apps/inventory";
			}elseif($menuval['JENIS_PAGE']=='3'){ 
				$folder="apps/report";

			// }elseif($menuval['JENIS_PAGE']=='3'){ 
			// 	$folder="setting";
			// }elseif($menuval['JENIS_PAGE']=='5'){ 
			// 	$folder="approve";
			// }elseif($menuval['JENIS_PAGE']=='6'){ 
			// 	$folder="laporan";
			}

			switch($page)
			{		

				case "Home":
					$modul="apps/dashboard/dashboard.php";
					$title="$menuval[NAMA]";
					$data="$folder/$menuval[FOLDER]/js.php";
					$cdpk="nav-expanded";
				break;
				case "$menuval[SLUG]":
					$modul="$folder/index.php";
					$content="$folder/$menuval[FOLDER]/content.php";
					$title="$menuval[NAMA]";
					$data="$folder/$menuval[FOLDER]/js.php";
					$cdpk="nav-expanded";
				break;
				case "simpan":
					$modul="$folder/index.php";
					$content="$folder/$menuval[FOLDER]/simpan.php";
					$title="$menuval[NAMA]";
					$data="$folder/$menuval[FOLDER]/js.php";
					$cdpk="nav-expanded";
				break;
				case "modal":
					$modul="$folder/index.php";
					$content="$folder/$menuval[FOLDER]/modagent.php";
					$title="$menuval[NAMA]";
					$data="$folder/$menuval[FOLDER]/js.js";
					$cdpk="nav-expanded";
				break;
			}


// $haktemp="";
// $hak_a=$con->select("mtrole_dtl","*","id_role='$_SESSION[ID_ROLE]'");

// //die();
// foreach($hak_a as $hak_akses){
// 	$haktemp=$haktemp."".$hak_akses['id_menu'].",";
// }
// $akses_menu=rtrim($haktemp,',');
// $array_akses_menu=explode(',',$akses_menu);
	
}
$haktemp="";
	$hak_a=$con->select("mtrole_dtl","*","id_role='$_SESSION[ID_ROLE]'");

	//die();
	foreach($hak_a as $hak_akses){
		$haktemp=$haktemp."".$hak_akses['id_menu'].",";
	}
	$akses_menu=rtrim($haktemp,',');
	$array_akses_menu=explode(',',$akses_menu);
?>
