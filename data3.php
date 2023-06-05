<?php
//error_reporting(0);
require( 'funlibs.php' );
$con=new Database;
session_start();

if($_GET['d'] != ''){
	$where2 = "where b.id='$_GET[d]'";
} else {
	$where2 = "";
}



$table = 'people';
$primaryKey = 'id';
$joinQuery = "from (select a.name as namepeople, c.`name` as namedept, b.title,b.mobile,b.statusid,b.id as iddtl,
case when typereq = 1 then 'Permintaan Akun' when typereq = 2 then 'Izin Akses Data' when typereq = 4 then 'Penutupan Akun' 
	end as typereqshow,typereq,a.nogm,concat(b.id,'_',b.typereq,'_',coalesce(f.jfin,0)) as gab,headstatus,itstatus,concat (c.`name`,' - ',e.name) as locationname,b.norequest
from people a join people_dtl_request b on a.id=b.peopleid join clients c on b.clientid=c.id join people_dtl_approve d on b.id=d.peopledtlid 
left join locations e on a.locationid = e.id
left join (select count(id) jfin,people_dtl_request_id from tickets where people_dtl_request_id = 62 and status = 'Finished' GROUP BY people_dtl_request_id) 
f on b.id=f.people_dtl_request_id 
$where2 ORDER BY b.id DESC) as a";       
$extraWhere="";
$columns = array(
	array( "db" => "iddtl",     "dt" => 0, "field" => "iddtl" ),
	array( "db" => "typereqshow", 	"dt" => 1, "field" => "typereqshow" ),
	array( "db" => "norequest", 	"dt" => 2, "field" => "norequest" ),
	array( "db" => "nogm", 	"dt" => 3, "field" => "nogm" ),
	array( "db" => "namepeople", 	"dt" => 4, "field" => "namepeople" ),
	array( "db" => "locationname", 	"dt" => 5, "field" => "locationname" ),
	array( "db" => "title as jabatan", 	"dt" => 6, "field" => "jabatan" ),
	array( "db" => "headstatus", 	"dt" => 7, "field" => "headstatus" , 
		'formatter' => function( $d, $row ) {
			if($d == 'Approve') {$return = "<font style='color:green'>Approve</font>";} 
			else if ($d=='Reject') {$return = "<font style='color:red'>Reject</font>";} 
			else if ($d=='Cancel') {$return = "<font style='color:orange'>Cancel</font>";} 
			else {$return = "<font style='color:blue'>Waiting Approve</font>";} 

		return $return;

	}),
	array( "db" => "itstatus", 	"dt" => 8, "field" => "itstatus", 
		'formatter' => function( $d, $row ) {
			if($d == 'Approve') {$return = "<font style='color:green'>Approve</font>";} 
			else if ($d=='Reject') {$return = "<font style='color:red'>Reject</font>";} 
			else if ($d=='Cancel') {$return = "<font style='color:orange'>Cancel</font>";} 
			else {$return = "<font style='color:blue'>Waiting Approve</font>";}
		return $return;

	}),
	array( "db" => "gab", 	"dt" => 9, "field" => "gab", 
		'formatter' => function( $d, $row ) {
			$exo = explode('_', $d);
			if($exo[2] > 0){
				$tandaseru = "<span class='badge label label-danger' title='Please Confirm Finished'><i class='fa fa-exclamation'></i></span>";
			} else {
				$tandaseru = "";
			}

			if($exo[1] == 1){
				$return1 = "<a href='javascript:void(0)' class='label label-primary' onClick='window.open(\"cetak.php?page=newrequestacc&id=$exo[0]\")'  style='cursor:pointer'><i class='fa fa-download'>&nbsp;Form</i></a>"; 
			} else if($exo[1] == 2){
				$return1 = "<a href='javascript:void(0)' class='label label-primary' onClick='window.open(\"cetak.php?page=newrequestaci&id=$exo[0]\")'  style='cursor:pointer'><i class='fa fa-download'>&nbsp;Form</i></a>"; 
			} else if($exo[1] == 4){
				$return1 = "<a href='javascript:void(0)' class='label label-primary' onClick='window.open(\"cetak.php?page=newrequestacp&id=$exo[0]\")'  style='cursor:pointer'><i class='fa fa-download'>&nbsp;Form</i></a>"; 
			} 
			$detail = "<a href='#' class='label label-warning' style='color:#000000;font-size:11px;text-align:center;margin-right:10px;' data-toggle='modal' data-target='#funModal' id='mod' onclick='modelnewreq($exo[0])'>Ticket $tandaseru</a>";
			
			return $detail.$return1;

	}),
	// array( "db" => "a.id as idarticles", 	"dt" => 3, "field" => "idarticles", 
	// 		'formatter' => function( $d, $row ) {
	// 				$isijum = "<a href='#' class='label label-warning' style='color:#000000;font-size:12px;text-align:center' data-toggle='modal' data-target='#funModal' id='mod' onclick='model($d)'>detail</a>";
				
	// 			return "$isijum";

	// }),
	
	// array( "db" => "id_topik", 	"dt" => 3, "field" => "id_topik", 
	// 		'formatter' => function( $d, $row ) {
	// 				$isijam = "
	// 				<a href='#' class='on-default edit-row' onClick='edit($d)'><i class='fa fa-pencil'></i></a>
	// 				<a href='#' class='on-default remove-row'><i class='fa fa-trash-o'></i></a>
	// 				";
				
	// 			return "$isijam";

	// }),
);
$sql_details = array(	
); 
 
 //echo "select * from $joinQuery where $extraWhere";

echo json_encode(
	Database::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere )
);
