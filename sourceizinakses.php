<?php 
if($_GET['reload'] == 1) {
	require_once "funlibs.php";
	$con = new Database();
	$ipaddress = $_GET['ipad'];
} else {
	$ipaddress = $ipaddress;
}
	$selfile = $con->select("people_izinakses_tmp a left join assets b on a.assetid=b.id left join locations c on a.locationid=c.id left join clients d on c.clientid=d.id","a.*,b.name as nameasset,case when hak_akses = 1 then 'Full Akses' when hak_akses=2 then 'Read Only' end hakakses,c.name as locationname,d.name as clientname","a.ipaddress = '$ipaddress'");

?>


	<table class="table">
		<thead>
			<tr>
				<th>Asset ID</th>
				<th>File/Folder</th>
				<th>Lokasi</th>
				<th>Dept Tujuan</th>
				<th>Hak Akses</th>
				<th>Remark</th>
				<th>#</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($selfile as $file) { ?>
			<tr>
				<td><?=$file['nameasset']?></td>
				<td><?=$file['filefolder']?></td>
				<td><?=$file['lokasi']?></td>
				<td><?=$file['clientname']." - ".$file['locationname']?></td>
				<td><?=$file['hakakses']?></td>
				<td><?=$file['remark']?></td>
				<td><a href="javascript:void(0)" class="" onclick="delfilefolder('<?=$file[id]?>')"><i class="fa fa-trash"></i></a></td>
			</tr>
		<?php } ?>
		</tbody>
	</table>