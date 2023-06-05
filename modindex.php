<?php
//echo "Select * from mtagent a join mtpegawai b on a.id_pegawai=b.id_pegawai where id_agent = '$_GET[id]'";
include "funlibs.php";
$con = new Database();
if ($_GET[x] == "view"){

$selmodagent = $con->select("tickets a left join clients b on a.clientid=b.id
left join people c on a.userid=c.id
left join people d on a.adminid=d.id
left join people f on a.approvedby=f.id
left join assets e on a.assetid=e.id 
left join clients g on a.clientid=g.id ",
"a.id as idticket,a.ticket,e.tag,e.name as nameaset,e.serial,e.machine_id,a.timestamp as createdate,a.modifydate,a.subject,c.name as nameuser,d.name as namestaff,a.reported,f.name as nameapprove,a.status as status_ticket,a.approvedate,nodenumber,a.userid,a.closedate,
a.finishdate,a.ticketroom,g.name as namadep,a.adminid,a.ticketimg","a.id = '$_GET[id]'");
foreach ($selmodagent as $mg) {}
	if($mg[image] == ""){
		$img = "assets/images/!logged-user.jpg";
	} else {
		$img = "assets/img/pegawai/$mg[image]";
	}

	if($mg['status_ticket'] == 'Open'){
		$isijam = "<a href='javascript:void(0)' class='label label-danger'>Open</a>";
	} else if ($mg['status_ticket'] == 'In Progress') {
		$isijam = "<a href='javascript:void(0)' class='label label-info'>In Progress</a>";
	} else if ($mg['status_ticket'] == 'Hold') {
		$isijam = "<a href='javascript:void(0)' class='label label-warning'>Hold</a>";
	} else if ($mg['status_ticket'] == 'Closed') {
		$isijam = "<a href='javascript:void(0)' class='label label-success'>Closed</a>";
	} else if ($mg['status_ticket'] == 'Reject') {
		$isijam = "<a href='javascript:void(0)' class='label label-default'>Reject</a>";
	} else if ($mg['status_ticket'] == 'Finished') {
		$isijam = "<a href='javascript:void(0)' class='label label-warning' style='background-color:yellow;color: #000000;'>Finished</a>";
	} else if ($mg['status_ticket'] == 'Assigned') {
		$isijam = "<a href='javascript:void(0)' class='label label-warning' style='background-color:#0000FF'>Assigned</a>";
	} else if($mg['status_ticket'] == 'Reopened'){
		$isijam = "<a href='javascript:void(0)' class='label label-danger' style='color:#FFD700'>Reopened</a>";
	} 

	$selapp = $con->select("trapprove a join mtpegawai b on a.id_pegawai=b.id_pegawai","b.nama_pegawai","a.id_req = $_GET[id]");
	foreach ($selapp as $app) {}
 ?>
<!-- Theme CSS -->
		<!-- Vendor CSS -->
		
		<span class="separator"></span>
				
					<div class="row">
                    	<div class="col-md-12">
							
                            <div class="col-md-10" style="padding: 1%;">
                        	<h2><strong>Ticket Order</strong> &ensp;
                        		<font style="font-size: 16px;vertical-align: middle;"><?php echo $isijam; ?></font> 
                        	</h2> 
                        	
                            </div>
                            
                        </div>
		<form method="post" id="form1" name="form1" class="form-user ft11" enctype="multipart/form-data" >				
						<div class="col-md-6 col-lg-6">
							<div class="tabs">
									<div id="overview" class="tab-pane active">
										<!-- <h4 class="mb-xlg">Personal Information</h4> -->
										<div id="edit" class="tab-pane">

											<fieldset>
												<div class="form-group">
													<label class="col-md-4 control-label" for="profileFirstName"><b>No. Ticket</b></label>
													<div class="col-md-8">
														<?php echo $mg['ticket']?>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-4 control-label" for="profileLastName"><b>Department</b></label>
													<div class="col-md-8">
														<?php echo $mg['namadep']?>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-4 control-label" for="profileLastName"><b>Created Date</b></label>
													<div class="col-md-8">
														<?php echo $mg['createdate']?>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-4 control-label" for="profileAddress"><b>Last Update</b></label>
													<div class="col-md-8">
														<?php echo $mg['modifydate']?>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-4 control-label" for="profileLastName"><b>Assigned To</b></label>
													<div class="col-md-8">
														<?php 
														$expst = explode(";", $mg['adminid']);
														$jmlst = count($expst);
														for($i=0;$i<$jmlst;$i++){
															foreach($con->select("people","name","id=$expst[$i]") as $namastaff){echo "- ".$namastaff['name'];
																}
														}
														?>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-4 control-label" for="profileAddress"><b>Problem</b></label>
													<div class="col-md-8">
														<?php echo $mg['subject']?>
													</div>
												</div>
												<?php if($mg['ticketimg'] != ''){ ?>
												<div class="form-group">
													<a class="btn btn-primary ft11" data-toggle="collapse" href="#idcollapse" style="text-align: center;">Image Problem</a>
													<div id="idcollapse" class="collapse" data-parent="#accordion">
														<?php 
														
														echo '<img src="data:image/jpeg;base64,'.base64_encode($mg['ticketimg']).'" width="150" height="120"/>';  ?>
													</div>
												</div>
												<?php } ?>
											</fieldset>
											
										</div>
									</div>
							</div>

						</div>
						<div class="col-md-6 col-lg-6">
											<fieldset>
												<div class="form-group">
													<label class="col-md-4 control-label" for="profileFirstName"><b>Asset ID</b></label>
													<div class="col-md-8">
														<?php //echo $mg['machine_id'].' - '.$mg['nameaset']
																echo $mg['nodenumber'];
														?>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-4 control-label" for="profileAddress"><b>Reported</b></label>
													<div class="col-md-8">
														<?php echo $mg['reported']?>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-4 control-label" for="profileAddress"><b>Room</b></label>
													<div class="col-md-8">
														<?php echo $mg['ticketroom']?>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-4 control-label" for="profileLastName"><b>Finished Date</b></label>
													<div class="col-md-8">
														<?php echo $mg['finishdate']?>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-4 control-label" for="profileAddress"><b>Closed Date</b></label>
													<div class="col-md-8">
														<?php if($mg['status_ticket'] == 'Closed' || $mg['status_ticket'] == 'Reject') {
															echo $mg['closedate'];}?>
													</div>
												</div>
												<!-- <div class="form-group">
													<label class="col-md-4 control-label" for="profileAddress">Hold Date</label>
													<div class="col-md-8">
														<?php echo $mg['holddate']; ?>
													</div>
												</div> -->
												<?php if($mg['status_ticket'] == 'Finished'){ ?>
												<div class="form-group">
													
													<label class="col-md-4 control-label" for="profileAddress"><b>Confirm Closed Ticket</b></label>
													<div class="col-md-8">
														<textarea class="form-control" id="followup" name="followup" placeholder="enter your review"></textarea>
														<input id="idreq" name="idreq" value="<?=$_GET[id]?>" type="hidden" />
														<!-- <a href="javascript:void(0)" class="btn btn-primary" onclick="inputfu()">Submit</a> -->
														<a href="javascript:void(0)" onClick="updatestatusclose(<?=$_GET[id]?>,<?=$mg['userid']?>,1)"  style="cursor:pointer" class="btn btn-success">
						                        			<b>Yes</b>
						                        		</a>
						                        		<a href="javascript:void(0)" onClick="updatestatusclose(<?=$_GET[id]?>,<?=$mg['userid']?>,2)"  style="cursor:pointer" class="btn btn-danger">
						                        			<b>No</b>
						                        		</a>
						                        		<br>
						                        		
													</div>
													<div class="col-md-12" style="font-size: 10px;"><b><i>NB: Ticket akan di closed otomatis oleh system dalam 24 jam setelah Finished</i></b></div>
												</div>
												<?php } ?>
												<?php if($mg['status_ticket'] != 'Finished' && $mg['status_ticket'] != 'Closed'){ ?>
													<div class="form-group">
														<label class="col-md-4 control-label" for="profileAddress"><b>Follow Up</b></label>
														<div class="col-md-8">
															<textarea class="form-control" id="followup" name="followup" placeholder="write your note"></textarea>
															<input id="idreq" name="idreq" value="<?=$_GET[id]?>" type="hidden" />
															<!-- <a href="javascript:void(0)" class="btn btn-primary" onclick="inputfu()">Submit</a> -->
															<a href="javascript:void(0)" onClick="followupuser(<?=$_GET[id]?>,<?=$mg['userid']?>,3)"  style="cursor:pointer" class="btn btn-success btn-sm ft11">
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
						<div class="col-md-12 col-lg-12 ft11">
							<fieldset>
								<div class="form-group">
									<div class="col-md-2" >
										<label class="control-label" for="profileAddress" style="float: right;"><b>Feedback Agent</b></label>
									</div>											
									<div class="col-md-10">
											<?php 
													if($mg['status_ticket'] == 'Reject'){
														echo "<b><i>Rejected by ".$mg['nameapprove']."</i></b> ".$mg['note_user']." - ".$mg['approvedate']; 
													} else {
											 			echo "<b><i>Approved by ".$mg['nameapprove']."</i></b>".$mg['note_user']." - ".$mg['approvedate']; 
											 		}
											 	
											 ?>
										<div class="pre-scrollable" style="height: 250px;">
										<?php 
											 $selfb = $con->select("tickets_replies a JOIN people b on a.peopleid=b.id","a.*,b.name as nameassigned","ticketid = '$mg[idticket]' and typereplies = 2");

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
														<b><i><?php echo $fb['nameassigned']." - ".date('Y-m-d H:i:s',strtotime($fb['timestamp']))." | ".$fb['statusreplies']?></i></b>
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
					<!-- end: page -->
				</section>
			</div>

			
    
    <!-- Vendor -->
		
<?php 
} else {
	$selmg = $con->select("kb_articles a join kb_categories b on a.categoryid=b.id","a.*,b.name as namecategories","a.id = $_GET[id]");
//echo "select a.*,b.nama_kattopik from mttopik a join mtkategoritopik b on a.id_kattopik=b.id_kattopik where id_topik = $_GET[id]";
	foreach ($selmg as $mg) {}
?>	
	<div class="form-group">
			<label class="col-md-2 control-label" for="profileLastName"><b>Category Topic</b></label>
			<div class="col-md-9">
				<?php echo $mg['namecategories']?>
			</div>
			<div class="col-md-1">
				<!-- <a href="javascript:void(0)"onClick="window.open('cetak.php?page=request&id=<?=$_GET[id]?>')"  style="cursor:pointer">
                        			<img src="assets/images/print-icon.png" alt="Print PDF" />
                </a> -->
			</div>
	</div>
	<!-- <div class="form-group">
			<label class="col-md-2 control-label" for="profileLastName"><b>Tips</b></label>
			<div class="col-md-2">
				<?php if($mg['tips'] == 1){
					echo "Yes";
				} else {
					echo "No";
				}
				?>
			</div>
	</div> -->
	<hr>
	<div class="form-group" style="border-top: medium;">
			<label class="col-md-2 control-label" for="profileAddress"><b>Problem</b></label>
			<div class="col-md-10">
				<?php echo $mg['name']?>
			</div>
	</div>

	<!-- <div class="form-group" style="border-top: medium;">
			<label class="col-md-2 control-label" for="profileAddress"><b>Analysis</b></label>
			<div class="col-md-10">
				<?php echo $mg['analisis']?>
			</div>
	</div> -->
	<div class="form-group" style="border-top: medium;">
			<label class="col-md-2 control-label" for="profileAddress"><b>Solution</b></label>
			<div class="col-md-10 pre-scrollable">
				<?php echo $mg['content']?>
			</div>
	</div>

	<div>
		<p>&nbsp;</p>
	</div>
<?php 
}
?>

<script type="text/javascript">
	function updatestatusclose(id,user,tipe){
		var data = $('.form-user').serialize();
		//alert(data);
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