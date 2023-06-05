<?php
session_start();
require_once("funlibs.php");
$con=new Database();


//ambil data eraticket
	foreach ($con->select("clients","*","id = '$_GET[id]'") as $oas) {}
	echo $oas['id']."_".$oas['name'];

?>

