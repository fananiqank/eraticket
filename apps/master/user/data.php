<?php
//error_reporting(0);
require( '../../../funlibs.php' );
$con=new Database;
session_start();
$table = 'mauser_login';
$primaryKey = 'ID';
$joinQuery = "from mauser_login a 
JOIN mtpegawai b on a.ID_PEGAWAI=b.id_pegawai
JOIN mtrole c on a.ID_ROLE=c.id_role";       
$extraWhere="STATUS = 1 and b.id_status = 1";
$columns = array(
	array( "db" => "a.ID",     "dt" => 0, "field" => "ID" ),
	array( "db" => "b.nama_pegawai", 	"dt" => 1, "field" => "nama_pegawai" ),
	array( "db" => "c.nama_role", 	"dt" => 2, "field" => "nama_role" ),
	array( "db" => "a.USERNAME", 	"dt" => 3, "field" => "USERNAME" ),
	array( "db" => "a.STATUS", 	"dt" => 4, "field" => "STATUS",
		'formatter' => function( $d, $row ) {
				if ($d == 1){
					$isijom = "
					<label class='label label-success'>Active</label>";
				} else {
					$isijom = "
					<label class='label label-warning'>InActive</label>";
				}
				
				return "$isijom";

	}),
	array( "db" => "ID", 	"dt" => 5, "field" => "ID", 
			'formatter' => function( $d, $row ) {
					$isijam = "
					<a href='#' class='on-default edit-row' onClick='edit($d)'><i class='fa fa-pencil'></i></a>
					<a href='#' class='on-default remove-row' onClick='hapuscat($d)'><i class='fa fa-trash-o'></i></a>
					";
				
				return "$isijam";

	}),
);
$sql_details = array(	
); 
 
echo json_encode(
	Database::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere )
);
// <a href='#' class='on-default remove-row' onClick='inactive($d)'><i class='fa fa-trash-o'></i></a>