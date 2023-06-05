<?php
//error_reporting(0);
require( '../../../funlibs.php' );
$con=new Database;
session_start();
if($_GET['c']==''){
	$cat="";
}else{
	$cat="and a.id_kategori = $_GET[c]";
}

if($_GET['s']==''){
	$sub="";
}else{
	$sub="and a.id_kategori_sub='$_GET[s]'";
}

if($_GET['y']==''){
	$pri="";
}else{
	$pri="and a.priority_wo='$_GET[y]'";
}

if($_GET['t']==''){
	$sta="";
}else{
	$sta="and b.status_data='$_GET[t]'";
}

if($_GET['j']==''){
	$jen="";
}else{
	$jen="and a.jenis_wo='$_GET[j]'";
}

if($_GET['g']==''){
	$asi="";
}else{
	$asi="and a.id_agent='$_GET[g]'";
}

// if($_GET['a']==''){
// 	$ase="";
// }else{
// 	$ase="and b.asetid_data='$_GET[a]'";
// }

if($_GET['tg']== 'A' && $_GET['tg2']== 'A'){
	$tgl="";
}else{
	$tgl="and DATE(a.created_date_wo) BETWEEN '$_GET[tg]' AND '$_GET[tg2]'";
}
					
$table = 'trwo';
$primaryKey = 'id_wo';
$joinQuery = "from trwo a left join trdata b on a.id_data=b.id_data
left join trrequest g on a.id_req=g.id_req 
left join mtdept c on b.departemen_data=c.id_dept
left join mtkategori d on a.id_kategori = d.id_kategori
left join mtkategori_sub h on a.id_kategori_sub=h.id_kategori_sub
left join mtagent e on a.id_agent = e.id_agent
left join mtpegawai f on e.id_pegawai = f.id_pegawai
left join mttopik j on a.id_wo = j.id_wo
left join (select * from trfeedback order by id_feedback DESC) as k on a.id_wo = k.id_wo";       
$extraWhere="a.id_wo like '%' $cat $sub $pri $sta $jen $asi $tgl GROUP BY b.id_data";
//echo $extraWhere;
$columns = array(
	array( "db" => "a.id_wo",     "dt" => 0, "field" => "id_wo" ),
	array( "db" => "a.no_ticket", 	"dt" => 1, "field" => "no_ticket"),
	array( "db" => "b.nama_data",     "dt" => 2, "field" => "nama_data" ),
	// array( "db" => "b.asetid_data", 	"dt" => 3, "field" => "asetid_data" ),
	array( "db" => "f.nama_pegawai", 	"dt" => 3, "field" => "nama_pegawai" ),
	array( "db" => "d.nama_kategori", 	"dt" => 4, "field" => "nama_kategori" ),
	array( "db" => "h.nama_kategori_sub", 	"dt" => 5, "field" => "nama_kategori_sub" ),
	array( "db" => "a.jenis_wo", 	"dt" => 6, "field" => "jenis_wo",
	'formatter' => function( $d, $row ) {
					if($d == '1'){
						$isijum = "Request";
					} else if ($d == '2') {
						$isijum = "Non Request";
					} 
					
				return "$isijum";
	}),
	array( "db" => "b.created_date_data", 	"dt" => 7, "field" => "created_date_data" ),
	array( "db" => "a.created_date_wo", 	"dt" => 8, "field" => "created_date_wo"),
	array( "db" => "b.closed_date_data", 	"dt" => 9, "field" => "closed_date_data" ),
	array( "db" => "a.priority_wo", 	"dt" => 10, "field" => "priority_wo",
	'formatter' => function( $d, $row ) {
					if($d == '1'){
						$isijum = "Low";
					} else if ($d == '2') {
						$isijum = "Medium";
					} else if ($d == '3') {
						$isijum = "High";
					}
					
				return "$isijum";
	}),
	array( "db" => "b.status_data", 	"dt" => 11, "field" => "status_data" ,
			'formatter' => function( $d, $row ) {
					
					if($d == '1'){
						$isijam = "Open";
					} else if ($d == '2') {
						$isijam = "On Progress";
					} else if ($d == '3') {
						$isijam = "Hold WO";
					} else if ($d == '4') {
						$isijam = "Closed";
					} else if ($d == '0') {
						$isijam = "Reject";
					} else if ($d == '5') {
						$isijam = "Hold Request";
					} else if ($d == '6') {
						$isijam = "Assigned";
					} 
					// $isijam = "<a href='javascript:void(0)' data-toggle='modal' data-target='#funModal' id='mod' onclick='mode($d)' class='label label-warning' style='cursor:pointer'>details</a>";
				/*return "
				<a href='javascript:void(0)' data-toggle='modal' id='mod' data-target='#datajaminan' onClick=detiljams('$d') class='label label-success' style='cursor:pointer'>Lihat Jaminan</a>
				";*/
				return "$isijam";

	}),
	array( "db" => "concat((DATEDIFF(CURDATE(),a.sla_date_wo) - 2),'_',b.status_data) as stla", 	"dt" => 12, "field" => "stla", 
	'formatter' => function( $d, $row ) {
				   $det = explode('_', $d);
				   $dif = $det[0];
				   $stat = $det[1];

					if ($stat == '2' || $stat == '3'){
						if($dif > 0){
							$isijum = "<b>+ $dif</b>";
						} else if ($dif == 0){
							$isijum = "<b>$dif</b>";
						} else if ($dif < 0){
							$isijum = "<b>$dif</b>";
						}
					}
				return "$isijum";

	}),
	
	array( "db" => "concat(j.problem,'_-',b.remark_data) as prob", 	"dt" => 13, "field" => "prob",
	'formatter' => function( $d, $row ) {
				   $cok = explode('_-', $d);
				   $pro = $cok[0];
				   $rem = $cok[1];

					if ($pro != ''){
							$isijem = $cok[0];
					} else {
							$isijem = $cok[1];
					}
				return "$isijem";

	}),
	array( "db" => "k.remark_feedback", 	"dt" => 14, "field" => "remark_feedback"),
	// array( "db" => "j.solusi", 	"dt" => 15, "field" => "solusi"),
);
//var_dump($columns);
$sql_details = array(	
); 
 
//echo "select * from $joinQuery where $extraWhere";
echo json_encode(
	Database::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere )
);
