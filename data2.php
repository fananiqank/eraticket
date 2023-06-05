<?php
//error_reporting(0);
require( 'funlibs.php' );
$con=new Database;
session_start();
$table = 'kb_articles';
$primaryKey = 'id';
$joinQuery = "from kb_articles a join kb_categories b on a.categoryid=b.id";       
$extraWhere="";
$columns = array(
	array( "db" => "a.id as idarticles",     "dt" => 0, "field" => "idarticles" ),
	array( "db" => "a.name as namearticles", 	"dt" => 1, "field" => "namearticles" ),
	array( "db" => "b.name as namecategories", 	"dt" => 2, "field" => "namecategories" ),
	array( "db" => "a.id as idarticles", 	"dt" => 3, "field" => "idarticles", 
			'formatter' => function( $d, $row ) {
					$isijum = "<a href='#' class='label label-warning' style='color:#000000;font-size:11px;text-align:center' data-toggle='modal' data-target='#funModal' id='mod' onclick='model($d)'>detail</a>";
				
				return "$isijum";

	}),
	
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
