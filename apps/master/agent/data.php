<?php
error_reporting(0);
require( '../../../funlibs.php' );
$con=new Database;
session_start();
$table = 'mtagent';
$primaryKey = 'id_agent';
$joinQuery = "from mtagent a join mtpegawai b on a.id_pegawai=b.id_pegawai 
left join mtjabatan c on b.id_jabatan=c.id_jabatan 
left join mtjobcat d on a.id_jobcat=d.id_jobcat 
left join mtcabang e on b.id_cabang=e.ID_CABANG";       
$extraWhere="b.id_status != 3";
$columns = array(
	array( "db" => "a.id_agent",     "dt" => 0, "field" => "id_agent" ),
	array( "db" => "b.nama_pegawai", 	"dt" => 1, "field" => "nama_pegawai" ),
	array( "db" => "b.email",     "dt" => 2, "field" => "email" ),
	array( "db" => "b.phone",     "dt" => 3, "field" => "phone" ),
	array( "db" => "c.nama_jabatan", 	"dt" => 4, "field" => "nama_jabatan" ),
	array( "db" => "d.nama_jobcat", 	"dt" => 5, "field" => "nama_jobcat" ),
	array( "db" => "e.NAMA_CABANG", 	"dt" => 6, "field" => "NAMA_CABANG" ),
	array( "db" => "CONCAT(a.id_agent,'_',b.id_status) as gab", 	"dt" => 7, "field" => "gab", 
			'formatter' => function( $d, $row ) {
					$exp = explode('_',$d);
					$idag = $exp[0];
					$stat = $exp[1];
					if ($stat == 1) {
						$isijam = "<a href='javascript:void(0)' data-toggle='modal' data-target='#funModal' id='mod' onclick='mode($idag)' class='label label-warning' style='cursor:pointer'>details</a>";
					} else {
						$isijam = "<a href='javascript:void(0)' data-toggle='modal' data-target='#funModal' id='mod' onclick='mode($idag)' class='label label-danger' style='cursor:pointer'>details</a>";
					}
				/*return "
				<a href='javascript:void(0)' data-toggle='modal' id='mod' data-target='#datajaminan' onClick=detiljams('$d') class='label label-success' style='cursor:pointer'>Lihat Jaminan</a>
				";*/
				return "$isijam";

			}),
);
//var_dump($columns);
$sql_details = array(	
); 
 
// $jsonp = preg_match('/^[$A-Z_][0-9A-Z_$]*$/i', $_GET['callback']) ?
// 	$_GET['callback'] :
// 	false;
// if ( $jsonp ) {
// 	echo $jsonp.'('.json_encode(
// 	Database::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere )).');'; }
//echo "select * from $joinQuery where $extraWhere";
echo json_encode(
	Database::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere )
);
