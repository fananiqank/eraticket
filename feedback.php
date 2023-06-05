<?php 
if($_GET['reload'] == '1'){
	include "funlibs.php";
	$con = new Database();

	$selmodagent = $con->select("trdata a left join trrequest b on a.id_data=b.id_data
	left join mtdept g on a.departemen_data=g.id_dept
	left join trwo c on a.id_data =c.id_data
	left join mtkategori d on c.id_kategori = d.id_kategori
	left join mtagent e on c.id_agent = e.id_agent
	left join mtpegawai f on e.id_pegawai = f.id_pegawai",
	"a.*,b.id_req,b.note_user,c.id_wo,c.dateupdate_wo,g.nama_dept,d.nama_kategori,f.nama_pegawai","b.id_req = '$_GET[idr]'");
	foreach ($selmodagent as $mg) {}
		
}
	if ($mg['note_user'] != ''){
		if($mg['status_data'] == 0){
			echo "<b><i>Rejected by ".$app['nama_pegawai']."</i></b> <br>".$mg['note_user']; 
		} else if ($mg['status_data'] == 5){
 			echo "<b><i>Hold by ".$app['nama_pegawai']."</i></b> <br>".$mg['note_user']; 
 		} else {
 			echo "<b><i>Approved by ".$app['nama_pegawai']."</i></b> <br>".$mg['note_user']; 
 		}
 	}
 ?>
<br>
<?php 
	 $selfb = $con->select("(select * from (select dateupdate_feedback,remark_feedback,id_wo,1 as type from trfeedback where id_wo = '$mg[id_wo]' union 
select dateupdate_fu as dateupdate_feedback,remark_fu as remark_feedback, id_req as id_wo,2 as type from trfollowup where id_req = '$mg[id_req]'
) as a ORDER BY dateupdate_feedback) as b","*");
	 foreach ($selfb as $cfb){}
	 	// if($cfb[type] == 1) {
	 	// 	if($cfb['id_wo']){echo "<b>Assign</b> <br>";}
	 	// 	else {echo "";}
	 	// } else {
	 	// 	if($cfb['id_wo']){echo "<b>User</b> <br>";}
	 	// 	else {echo "";}
	 	// }
?>
	    <ul>
		<?php 					
		foreach ($selfb as $fb) { ?>
			<li>
				<b><?php if($fb[type] == 1) {
			 		if($fb['id_wo']){echo "<b>Assign - </b>";}
			 		else {echo "";}
			 	} else {
			 		if($fb['id_wo']){echo "<b>User - </b>";}
			 		else {echo "";}
			 	} ?> <i><?=date('d-m-Y H:i:s',strtotime($fb['dateupdate_feedback']))?></i></b>
				<br>
				<?=$fb['remark_feedback']?>
			</li>	
		<?php }
		?>
	    </ul> 	