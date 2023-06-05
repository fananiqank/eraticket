<?php
//error_reporting(0);
require( '../../../funlibs.php' );
$con=new Database;
session_start();
$table = 'mttopik';
$primaryKey = 'id_topik';
$joinQuery = "";       
$extraWhere="id_kattopik = '$_GET[sub]' and jenis_topik = 1";
$columns = array(
	array( "db" => "id_topik",     "dt" => 0, "field" => "id_topik" ),
	array( "db" => "problem", 	"dt" => 1, "field" => "problem" ),
	array( "db" => "id_topik", 	"dt" => 2, "field" => "id_topik", 
			'formatter' => function( $d, $row ) {
					$isijum = "<a href='#' class='label label-warning' style='color:#000000' data-toggle='modal' data-target='#funModal' id='mod' onclick='mode($d)'>detail</a>";
				
				return "$isijum";

	}),
	array( "db" => "tips", 	"dt" => 3, "field" => "tips", 
			'formatter' => function( $d, $row ) {
				if($d == 1) {
					$isijum = "<a href='#' class='label label-danger'>Tips</a>";
				}
				
				return "$isijum";

	}),
	array( "db" => "id_topik", 	"dt" => 4, "field" => "id_topik", 
			'formatter' => function( $d, $row ) {
					$isijam = "
					<a href='#' class='on-default remove-row' onClick='hapuscatsub($_GET[sub],$d)'><i class='fa fa-trash-o'></i></a>
					";
				
				return "$isijam";

	}),
);
$sql_details = array(	
); 
 
echo json_encode(
	Database::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere )
);
