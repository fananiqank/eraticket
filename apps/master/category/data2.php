<?php
//error_reporting(0);
require( '../../../funlibs.php' );
$con=new Database;
session_start();
$table = 'mtkategori_sub';
$primaryKey = 'id_kategori_sub';
$joinQuery = "";       
$extraWhere="status_kategori_sub != 9 and id_kategori = '$_GET[su]'";
$columns = array(
	array( "db" => "id_kategori_sub",     "dt" => 0, "field" => "id_kategori_sub" ),
	array( "db" => "nama_kategori_sub", 	"dt" => 1, "field" => "nama_kategori_sub" ),
	array( "db" => "id_kategori_sub", 	"dt" => 2, "field" => "id_kategori_sub", 
			'formatter' => function( $d, $row ) {
					$isijam = "
					<a href='#' class='on-default edit-row' onClick='editsub($d)'><i class='fa fa-pencil'></i></a>
					<a href='#' class='on-default remove-row' onClick='hapus($d)'><i class='fa fa-trash-o'></i></a>
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