<?php
//error_reporting(0);
require( '../../../funlibs.php' );
$con=new Database;
session_start();
$table = 'mtkategoritopik';
$primaryKey = 'id_kattopik';
$joinQuery = "";       
$extraWhere="jenis_kattopik = 1";
$columns = array(
	array( "db" => "id_kattopik",     "dt" => 0, "field" => "id_kattopik" ),
	array( "db" => "nama_kattopik", 	"dt" => 1, "field" => "nama_kattopik" ),
	array( "db" => "id_kattopik", 	"dt" => 2, "field" => "id_kattopik", 
			'formatter' => function( $d, $row ) {
					$isijum = "
					<a href='#' class='label label-warning' onClick='detail($d)'>Detail</a>
					";
				return "$isijum";

			}),
	array( "db" => "id_kattopik", 	"dt" => 3, "field" => "id_kattopik", 
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
