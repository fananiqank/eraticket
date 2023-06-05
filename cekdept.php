<?php
//error_reporting(0);
require( 'funlibs.php' );
$con=new Database;
// require( 'funlibs2.php' );
// $con2=new Database2;

session_start();

//ambil data eraticket
	foreach ($con->select("mtdept","*","iditassets = '$_GET[id]'") as $oas) {}
	
echo $oas['id_dept']."_".$oas['nama_dept'];
?>