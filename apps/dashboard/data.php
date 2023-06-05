<?php
//error_reporting(0);
require( 'funlibs.php' );
$con=new Database;
session_start();
$table = 'people';
$primaryKey = 'id';
$joinQuery = "from (select a.name as namepeople, c.`name` as namedept, b.title,b.mobile,b.statusid,b.id as iddtl,case when typereq = 1 then 'Permintaan Akun' when typereq = 2 then 'Izin Akses Data' when typereq = 4 then 'Penutupan Akun' 
	end as typereqshow,typereq,a.nogm,concat(b.id,'_',b.typereq) as gab
from people a join people_dtl_request b on a.id=b.peopleid join clients c on b.clientid=c.id ORDER BY b.id DESC) as a";       
$extraWhere="";
$columns = array(
	array( "db" => "iddtl",     "dt" => 0, "field" => "iddtl" ),
	array( "db" => "typereqshow", 	"dt" => 1, "field" => "typereqshow" ),
	array( "db" => "nogm", 	"dt" => 2, "field" => "nogm" ),
	array( "db" => "namepeople", 	"dt" => 3, "field" => "namepeople" ),
	array( "db" => "namedept", 	"dt" => 4, "field" => "namedept" ),
	array( "db" => "title as jabatan", 	"dt" => 5, "field" => "jabatan" ),
	array( "db" => "mobile as phone", 	"dt" => 6, "field" => "phone" ),
	array( "db" => "statusid", 	"dt" => 7, "field" => "statusid", 
		'formatter' => function( $d, $row ) {
			if($d == 'Active') {$return = "<font style='color:green'>Active</font>";} 
			else if ($d=='Request') {$return = "<font style='color:blue'>Waiting Approve</font>";} 
			else { $return = "<font style='color:red'>Non Aktif</font>";}
	 	return $return;

	}),
	array( "db" => "gab", 	"dt" => 8, "field" => "gab", 
		'formatter' => function( $d, $row ) {
			$exo = explode('_', $d);
			if($exo[1] == 1){
				$return = "<a href='javascript:void(0)' class='label label-primary' onClick='window.open(\"cetak.php?page=newrequestacc&id=$exo[0]\")'  style='cursor:pointer'>Download</a>"; 
			} else if($exo[1] == 2){
				$return = "<a href='javascript:void(0)' class='label label-primary' onClick='window.open(\"cetak.php?page=newrequestaci&id=$exo[0]\")'  style='cursor:pointer'>Download</a>"; 
			} else if($exo[1] == 4){
				$return = "<a href='javascript:void(0)' class='label label-primary' onClick='window.open(\"cetak.php?page=newrequestacp&id=$exo[0]\")'  style='cursor:pointer'>Download</a>"; 
			} 
			return $return;

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
 
echo json_encode(
	Database::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere )
);
