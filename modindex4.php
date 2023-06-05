<?php
//echo "Select * from mtagent a join mtpegawai b on a.id_pegawai=b.id_pegawai where id_agent = '$_GET[id]'";
include "funlibs.php";
$con = new Database();
$ipaddress = gethostbyaddr($_SERVER['REMOTE_ADDR']);

?>
<section>
<div class="form-group" id="accordion">

<?php 

foreach($con->select("people_dtl_request","*","id = $_GET[id]") as $prq){}

	$selmodagent = $con->select("tickets a join clients b on a.clientid=b.id
	left join people c on a.userid=c.id
	left join people f on a.approvedby=f.id
	left join assets e on a.assetid=e.id",
	"a.id as idticket,a.ticket,e.tag,e.name as nameaset,e.serial,e.machine_id,a.timestamp as createdate,a.modifydate,a.subject,c.name as nameuser,a.adminid,a.reported,f.name as nameapprove,a.status as status_ticket,a.approvedate,a.ticketidparent,a.userid,a.closedate,a.finishdate","a.people_dtl_request_id = '$_GET[id]'","a.id DESC");
	foreach ($selmodagent as $cekap){}
	if(count($cekap) > 0){	
		foreach ($selmodagent as $sm) {
			if($sm['status_ticket'] == 'Open'){
				$isijam = "<span class='label label-danger'>$sm[status_ticket]</span>";
			} else if ($sm['status_ticket'] == 'In Progress') {
				$isijam = "<span class='label label-info'>$sm[status_ticket]</span>";
			} else if ($sm['status_ticket'] == 'Closed') {
				$isijam = "<span class='label label-success'>$sm[status_ticket]</span>";
			} else if ($sm['status_ticket'] == 'Finished') {
				$isijam = "<span class='label label-default' style='background-color:yellow;color: #000000;'>$sm[status_ticket]</span>";
			} else if ($sm['status_ticket'] == 'Hold') {
				$isijam = "<span class='label label-warning' style='color: #000000;'>$sm[status_ticket]</span>";
			} else if ($sm['status_ticket'] == 'Assigned') {
				$isijam = "<span class='label label-warning' style='background-color:#0000FF'>$sm[status_ticket]</span>";
			} else if ($sm['status_ticket'] == 'Reject') {
				$isijam = "<span class='label label-default'>$sm[status_ticket]</span>";
			} else if ($sm['status_ticket'] == 'Reopened') {
				$isijam = "<span class='label label-danger' style='color: #FFD700;'>$sm[status_ticket]</span>";
			} 

			if($sm['ticketidparent'] != ''){
				foreach($con->select("tickets","ticket","id = '$sm[ticketidparent]'") as $ssm){}
				$ref =  " (Ref Ticket :".$ssm['ticket']." )";
			} else {
				$ref = "";
			}
?>
    <div class="card">
      <div class="card-header">
        <a class="btn btn-primary form-control ft11" data-toggle="collapse" href="#collapse<?=$sm[idticket]?>" style="text-align: left;">
          <b><?php echo $sm['ticket'].$ref;?></b> <?=' - '.$sm['subject']." ( ".$sm['nameuser']." )";?><span style="float: right;font-size: 12px"><?=$isijam;?></span>
        </a>
      </div>
      <div id="collapse<?=$sm[idticket]?>" class="collapse" data-parent="#accordion">
        <div class="card-body">
<form method="post" id="form1" name="form1" class="form-user ft11" enctype="multipart/form-data" >			        
        <div class="col-md-6 col-lg-6">
				<fieldset>
					<div class="form-group">
						<label class="col-md-4 control-label" for="profileFirstName">No. Ticket</label>
						<div class="col-md-8">
							<?php echo $sm['ticket']?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label" for="profileLastName">Created Date</label>
						<div class="col-md-8">
							<?php echo $sm['createdate']?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label" for="profileLastName">Assigned To</label>
						<div class="col-md-8">
							<?php $expadm = explode(';', $sm['adminid']) ; 
								  foreach($expadm as $key => $value){
								  	foreach($con->select("people","name","id=$value") as $nadm){}
								  	echo "- ".$nadm['name']."<br>";
								  }
							?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label" for="profileLastName">Status</label>
						<div class="col-md-8">
							<?php echo $isijam; ?>
						</div>
					</div>
					
				</fieldset>
		  </div>
		  <div class="col-md-6 col-lg-6">
				<fieldset>
					<div class="form-group">
						<label class="col-md-4 control-label" for="profileFirstName">Subject</label>
						<div class="col-md-8">
							<?php //echo $mg['machine_id'].' - '.$mg['nameaset']
									echo $sm['subject'];
							?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label" for="profileLastName">Finished Date</label>
						<div class="col-md-8">
							<?php echo $sm['finishdate']?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label" for="profileLastName">Closed Date</label>
						<div class="col-md-8">
							<?php echo $sm['closedate']?>
						</div>
					</div>
					<?php if($sm['status_ticket'] == 'Finished'){ ?>
												<div class="form-group">
													
													<label class="col-md-4 control-label" for="profileAddress"><b>Confirm Closed Ticket</b></label>
													<div class="col-md-8">
														<textarea class="form-control" id="followup" name="followup" placeholder="enter your review"></textarea>
														<input id="idreq" name="idreq" value="<?=$_GET[id]?>" type="hidden" />
														<!-- <a href="javascript:void(0)" class="btn btn-primary" onclick="inputfu()">Submit</a> -->
																<a href="javascript:void(0)" onClick="updatestatusclose(<?=$sm['idticket']?>,<?=$sm['userid']?>,1)"  style="cursor:pointer" class="btn btn-success btn-sm ft11">
		                        			<b>Yes</b>
		                        		</a>
		                        		<a href="javascript:void(0)" onClick="updatestatusclose(<?=$sm['idticket']?>,<?=$sm['userid']?>,2)"  style="cursor:pointer" class="btn btn-danger btn-sm ft11">
		                        			<b>No</b>
		                        		</a>
		                        		<br>
						                <input type="hidden" name="ipaddressfin" id="ipaddressfin" value="<?=$ipaddress?>">        		
													</div>
													<div class="col-md-12" style="font-size: 10px;"><b><i>NB: Ticket akan di closed otomatis oleh system dalam 24 jam setelah Finished</i></b></div>
												</div>
					<?php } ?>
					<?php if($sm['status_ticket'] != 'Finished' && $sm['status_ticket'] != 'Closed'){ ?>
												<div class="form-group">
													<label class="col-md-4 control-label" for="profileAddress"><b>Follow Up</b></label>
													<div class="col-md-8">
														<textarea class="form-control" id="followup" name="followup" placeholder="write your note"></textarea>
														<input id="idreq" name="idreq" value="<?=$_GET[id]?>" type="hidden" />
														<!-- <a href="javascript:void(0)" class="btn btn-primary" onclick="inputfu()">Submit</a> -->
																<a href="javascript:void(0)" onClick="followupuser(<?=$sm['idticket']?>,<?=$sm['userid']?>,3)"  style="cursor:pointer" class="btn btn-success btn-sm ft11">
		                        			<b>Submit</b>
		                        		</a>
		                        		<br>
						                <input type="hidden" name="ipaddressfin" id="ipaddressfin" value="<?=$ipaddress?>">        		
													</div>
													
												</div>
						<?php } ?>
				</fieldset>
			
		  </div>
</form>
		  <div class="col-md-12 col-lg-12">
				<fieldset>
					<div class="form-group">
						<div class="col-md-2" >
							<label class="control-label" for="profileAddress">Conversation</label>
						</div>											
						<div class="col-md-10">
							
							<div class="pre-scrollable" style="height: 100px;">
							
							<?php 
							foreach($con->select("people_dtl_approve a join people b on a.itpeopleid=b.id","b.name,a.itnotes,itappdate,itstatus","peopledtlid = $_GET[id]") as $cekstapp){
								echo "<b>".$cekstapp['itstatus']."d by ".$cekstapp['name']."</b><br>".
								$cekstapp['itnotes']."<br>";
							}
								 $selfb = $con->select("tickets_replies a JOIN people b on a.peopleid=b.id","a.*,b.name as nameassigned","ticketid = '$sm[idticket]' and typereplies = 2","timestamp DESC");

								 foreach ($selfb as $cfb){}
								 	if($cfb['id_wo']){
							 			echo "<b>Assign</b> <br>";
							 		}
							?>
							    <ul>
								<?php 					
								foreach ($selfb as $fb) { 
									$selfiles = $con->select("files","*","ticketreplyid = $fb[id]");
								?>
									<li>
										<b><i><?php echo $fb['nameassigned']." - ".date('d-m-Y H:i:s',strtotime($fb['timestamp']))." | ".$fb['statusreplies']?></i></b>
										<br>
										<?php echo $fb['message']?>
										<ul class="todo-list list-inline" id="fileslist">
										  <?php foreach($selfiles as $file) { ?>
											  <div><?php echo $file['name'];?></div>
										  <?php } ?>
			  
									</li>	
								<?php }
								?>
							    </ul> 	
							</div>									
						</div>
					</div>
				</fieldset>
			</div>
        </div>
      </div>
    </div>
  
<?php } } else if ($prq['statusid'] == 'Cancel') {
	echo "<div align='center'>Automatic Cancel System</div>";
} else {
	echo "<div align='center'>No Ticket for this Request</div>";
} ?>
</div>
</section>
</div>


<script type="text/javascript">
	function updatestatusclose(id,user,tipe){
	//	window.location.reload();
	var data = $('.form-user').serialize();
			$.ajax({
				type: 'POST',
				url:  "simpan4.php?id="+id+"&usr="+user+"&tipe="+tipe,
				data: data,
				success: function() {
					window.location.reload();
				}
			});
	}

	function followupuser(id,user,tipe){
	//	window.location.reload();
	var data = $('.form-user').serialize();
			$.ajax({
				type: 'POST',
				url:  "simpan4.php?id="+id+"&usr="+user+"&tipe="+tipe,
				data: data,
				success: function() {
					window.location.reload();
				}
			});
	}
</script>