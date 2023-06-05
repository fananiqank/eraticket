<?php
session_start();
require_once("funlibs.php");
$con=new Database();


$term = trim(strip_tags($_GET['term'])); 
//$dat=$con->select("ak_acc","*","(account like '%$term%' or description like '%$term%') and post_flag='1'");
//$dat=$con->select("ak_acc","*","(account like '%$term%' or description like '%$term%') and post_flag='1' and substr(parent,1,3)='111'");
$dat=$con->select("mtpegawai","nama_pegawai,email,id_departemen","nama_pegawai like '%$term%' and id_status = 5");
// echo "select nama_pegawai,email from mtpegawai where nama_pegawai like '%$term%'";
foreach($dat as $row)
{
	//$row=htmlentities(stripslashes($row['account']." - ".$row['description']));
	
    // $row_set[] = array("nama_pegawai" => $row[nama_pegawai],
				// 	   "email" => $row[email],
				// );
    $row['value']=htmlentities(stripslashes($row['nama_pegawai']));
    $row['id']=(int)$row['email'];
    $row['dept']=$row['id_departemen'];
//buat array yang nantinya akan di konversi ke json
    $row_set[] = $row;
}
//data hasil query yang dikirim kembali dalam format json
echo json_encode($row_set);
?>