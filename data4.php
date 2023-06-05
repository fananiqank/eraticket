<?php
//error_reporting(0);
require( 'funlibs.php' );
$con=new Database;
session_start();
$table = 'people';
$primaryKey = 'id';
$joinQuery = "from (select * from (select a.name as namepeople, c.`name` as namedept, b.title,b.mobile,b.statusid,b.id as iddtl,
case when typereq = 1 then 'Permintaan Akun' when typereq = 2 then 'Izin Akses Data' when typereq = 4 then 'Penutupan Akun' 
	end as typereqshow,typereq,a.nogm,concat(b.id,'_',b.typereq) as gab,concat(b.id,'_',b.statusid,'_',b.typereq) as gat,
	DATE(b.created_date) created_date_dtl
from people a join people_dtl_request b on a.id=b.peopleid join clients c on b.clientid=c.id join locations d on b.locationid=d.id 
where d.peopleid like '%$_SESSION[ID_LOGIN]%' and b.statusid = 'Request' and b.peopledtlidparent = 0 
union 
select a.name as namepeople, e.`name` as namedept, b.title,b.mobile,b.statusid,b.id as iddtl,
case when typereq = 1 then 'Permintaan Akun' when typereq = 2 then 'Izin Akses Data' when typereq = 4 then 'Penutupan Akun' 
	end as typereqshow,typereq,a.nogm,concat(b.id,'_',b.typereq) as gab,concat(b.id,'_',COALESCE( NULLIF(c.headizinstatus,'') ,'Request'),'_',b.typereq,'_',c.id) as gat,
	DATE(b.created_date) created_date_dtl from people a 
								 join people_dtl_request b on a.id=b.peopleid 
								 join people_izinakses c on b.id=c.peopledtlid 
								 join locations d on c.locationid=d.id 
								 join clients e on d.clientid=e.id
where d.peopleid like '%$_SESSION[ID_LOGIN]%' and b.statusid = 'Approve' and coalesce(c.headizinpeopleid, '') = '') ab
ORDER BY iddtl DESC) as a";       
$extraWhere="";
$columns = array(
	array( "db" => "iddtl",     "dt" => 0, "field" => "iddtl" ),
	array( "db" => "typereqshow", 	"dt" => 1, "field" => "typereqshow" ),
	array( "db" => "nogm", 	"dt" => 2, "field" => "nogm" ),
	array( "db" => "namepeople", 	"dt" => 3, "field" => "namepeople" ),
	array( "db" => "namedept", 	"dt" => 4, "field" => "namedept" ),
	array( "db" => "title as jabatan", 	"dt" => 5, "field" => "jabatan" ),
	array( "db" => "created_date_dtl", 	"dt" => 6, "field" => "created_date_dtl" ),
	array( "db" => "gat", 	"dt" => 7, "field" => "gat", 
		'formatter' => function( $d, $row ) {
			$exi = explode('_', $d);
			if($exi[1] == 'Active') {$return = "<font style='color:green'>Active</font>";}
			else if($exi[1] == 'Approve') {$return = "<font style='color:green'>Approve</font>";} 
			else if($exi[1] == 'Reject') {$return = "<font style='color:red'>Reject</font>";} 
			else if ($exi[1]=='Request') {$return = "<a href='javascript:void(0)' data-toggle='modal' data-target='#funModal3' id='mod' onclick='model3($exi[0],$exi[2],$exi[3])' class='label label-warning' style='cursor:pointer;background-color:#FF4500'>Please Approve</a>";} 
			else { $return = "<font style='color:red'>Non Aktif</font>";}
	 	return $return;

	}),
	array( "db" => "gab", 	"dt" => 8, "field" => "gab", 
		'formatter' => function( $d, $row ) {
			$exo = explode('_', $d);
			if($exo[1] == 1){
				$return = "<a href='javascript:void(0)' class='label label-primary' onClick='window.open(\"cetak.php?page=newrequestacc&id=$exo[0]\")'  style='cursor:pointer'>Download Form</a>"; 
			} else if($exo[1] == 2){
				$return = "<a href='javascript:void(0)' class='label label-primary' onClick='window.open(\"cetak.php?page=newrequestaci&id=$exo[0]\")'  style='cursor:pointer'>Download Form</a>"; 
			} else if($exo[1] == 4){
				$return = "<a href='javascript:void(0)' class='label label-primary' onClick='window.open(\"cetak.php?page=newrequestacp&id=$exo[0]\")'  style='cursor:pointer'>Download Form</a>"; 
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
