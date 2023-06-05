<?php
session_start();
require_once("funlibs.php");
$con=new Database();

$term = trim(strip_tags($_GET['term'])); 
//$dat=$con->select("ak_acc","*","(account like '%$term%' or description like '%$term%') and post_flag='1'");
//$dat=$con->select("ak_acc","*","(account like '%$term%' or description like '%$term%') and post_flag='1' and substr(parent,1,3)='111'");
$dat=$con->select("people","*","nogm like '%$term%' and statusid='Active'");
// echo "select * from people where nogm like '%$term%'";
foreach($dat as $row)
{
	//$row=htmlentities(stripslashes($row['account']." - ".$row['description']));
	
    // $row_set[] = array("nama_pegawai" => $row[nama_pegawai],
				// 	   "email" => $row[email],
				// );
    $row['value']=htmlentities(stripslashes($row['nogm']));
    $row['id']=(int)$row['email'];
    $row['email']=$row['email'];
    $row['dept']=$row['clientid'];
    $row['nama']=$row['name'];
    $row['jabatan']=$row['jabatan'];
    $row['mobile']=$row['mobile'];
    $row['peopleid']=$row['id'];

//buat array yang nantinya akan di konversi ke json
    $row_set[] = $row;
}
//data hasil query yang dikirim kembali dalam format json
//var_dump($row_set);
echo json_encode($row_set);
?>