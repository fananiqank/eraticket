<?php
//error_reporting(0);
require( '../../../funlibs.php' );
$con=new Database;
session_start();
$table = 'mtkategori';
$primaryKey = 'id_kategori';
$joinQuery = "";       
$extraWhere="status_kategori != 9";
$columns = array(
	array( "db" => "id_kategori",     "dt" => 0, "field" => "id_kategori" ),
	array( "db" => "nama_kategori", 	"dt" => 1, "field" => "nama_kategori" ),
	array( "db" => "id_kategori", 	"dt" => 2, "field" => "id_kategori", 
			'formatter' => function( $d, $row ) {
					$isijum = "
					<a href='#' class='label label-warning' onClick='detail($d)'>Detail</a>
					";
				return "$isijum";

			}),
	array( "db" => "id_kategori", 	"dt" => 3, "field" => "id_kategori", 
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
// <a href='#' class='on-default remove-row'><i class='fa fa-trash-o'></i></a>