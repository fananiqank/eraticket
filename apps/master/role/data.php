<?php
//error_reporting(0);
require( '../../../funlibs.php' );
$con=new Database;
session_start();
$table = 'mtrole';
$primaryKey = 'id_role';
$joinQuery = "";       
$extraWhere="";
$columns = array(
	array( "db" => "id_role",     "dt" => 0, "field" => "id_role" ),
	array( "db" => "nama_role", 	"dt" => 1, "field" => "nama_role" ),
	array( "db" => "id_role", 	"dt" => 2, "field" => "id_role", 
			'formatter' => function( $d, $row ) {
					$isijam = "
					<a href='#' class='on-default edit-row' onClick='edit($d)'><i class='fa fa-pencil'></i></a>
					
					";
				/*return "
				<a href='javascript:void(0)' data-toggle='modal' id='mod' data-target='#datajaminan' onClick=detiljams('$d') class='label label-success' style='cursor:pointer'>Lihat Jaminan</a>
				";*/
				return "$isijam";

			}),
);
//var_dump($columns);
$sql_details = array(	
); 
 
//echo "select * from $joinQuery where $extraWhere";
echo json_encode(
	Database::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere )
);
// <a href='#' class='on-default remove-row'><i class='fa fa-trash-o'></i></a>