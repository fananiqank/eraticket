<?php
//error_reporting(0);
require( 'funlibs.php' );
$con=new Database;

// require( 'funlibs2.php' );
// $con2=new Database2;
if($_GET[d]){$idt = "and a.id = $_GET[d]";}else{$idt="";}
session_start();
$table = 'tickets';
$primaryKey = 'ticket';
$joinQuery = "from tickets a join clients b on a.clientid=b.id
left join people c on a.userid=c.id
left join people d on a.adminid=d.id
left join assets e on a.assetid=e.id";  


$extraWhere="typeasset = 1 and typeticket = 1 $idt"; 


$columns = array(
	array( "db" => "a.id as idticket",  "dt" => 0, "field" => "idticket" ),
	array( "db" => "CONCAT(a.ticket,'_',a.id) as gab", "dt" => 1, "field" => "gab", 
			'formatter' => function( $d, $row ) {
				$gab = explode("_",$d);
				$idreq = $gab[1];
				$notick = $gab[0];
					$isijam = "<a href='javascript:void(0)' data-toggle='modal' data-target='#funModal' id='mod' onclick='model($idreq)' class='label label-warning' style='cursor:pointer;font-size:11px;background-color:#FF4500'>$notick</a>";
				/*return "
				<a href='javascript:void(0)' data-toggle='modal' id='mod' data-target='#datajaminan' onClick=detiljams('$d') class='label label-success' style='cursor:pointer'>Lihat Jaminan</a>
				";*/
				return "$isijam";

			}),
	array( "db" => "e.nodenumber",     "dt" => 2, "field" => "nodenumber" ),
	array( "db" => "c.name as name_user",     "dt" => 3, "field" => "name_user" ),
	array( "db" => "a.reported",     "dt" => 4, "field" => "reported" ),
	array( "db" => "b.name as name_dept", 	"dt" => 5, "field" => "name_dept" ),
	array( "db" => "a.ticketroom", 	"dt" => 6, "field" => "ticketroom" ),
	array( "db" => "d.name as name_staff", 	"dt" => 7, "field" => "name_staff" ),
	array( "db" => "a.timestamp as date_ticket", 	"dt" => 8, "field" => "date_ticket" ),
	array( "db" => "a.status", 	"dt" => 9, "field" => "status" ,
			'formatter' => function( $d, $row ) {
					
					if($d == 'Open'){
						$isijam = "<a href='javascript:void(0)' class='label label-danger'>$d</a>";
					} else if ($d == 'In Progress') {
						$isijam = "<a href='javascript:void(0)' class='label label-info'>$d</a>";
					} else if ($d == 'Closed') {
						$isijam = "<a href='javascript:void(0)' class='label label-success'>$d</a>";
					} else if ($d == 'Hold') {
						$isijam = "<a href='javascript:void(0)' class='label label-warning' style='color: #000000;'>$d</a>";
					} else if ($d == 'Assigned') {
						$isijam = "<a href='javascript:void(0)' class='label label-warning' style='background-color:#0000FF'>$d</a>";
					} else if ($d == 'Finished') {
						$isijam = "<a href='javascript:void(0)' class='label label-warning' style='background-color: yellow; color:#000000'>$d</a>";
					} else if ($d == 'Reject') {
						$isijam = "<a href='javascript:void(0)' class='label label-default'>$d</a>";
					} else if ($d == 'Reopened') {
						$isijam = "<a href='javascript:void(0)' class='label label-danger' style='color:#FFD700'>$d</a>";
					} 
					// $isijam = "<a href='javascript:void(0)' data-toggle='modal' data-target='#funModal' id='mod' onclick='mode($d)' class='label label-warning' style='cursor:pointer'>details</a>";
				/*return "
				<a href='javascript:void(0)' data-toggle='modal' id='mod' data-target='#datajaminan' onClick=detiljams('$d') class='label label-success' style='cursor:pointer'>Lihat Jaminan</a>
				";*/
				return "$isijam";

			}),
);
//var_dump($columns);
$sql_details = array(	
); 
 
//echo "select *  $joinQuery  $extraWhere";
echo json_encode(
	Database::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere )
);
