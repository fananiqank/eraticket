<?php
session_start();
//echo $_SESSION['ID_PEG'];
include "../../../funlibs.php";
$con = new Database();
$selmodreq = $con->select("trdata a left join trrequest b on a.id_data=b.id_data
	left join mtdept g on a.departemen_data=g.id_dept
	left join trwo c on b.id_req =c.id_req
	left join mtkategori d on c.id_kategori = d.id_kategori
	left join mtagent e on c.id_agent = e.id_agent
	left join mtpegawai f on e.id_pegawai = f.id_pegawai
	left join mtkategori_sub h on c.id_kategori_sub = h.id_kategori_sub",
	"a.*,b.id_req,b.note_user,c.id_wo,c.dateupdate_wo,c.note_agent,c.priority_wo,g.nama_dept,d.id_kategori,d.nama_kategori,e.id_agent,f.nama_pegawai,c.id_kategori_sub,h.nama_kategori_sub",
	"b.id_req = '$_GET[id]'");

$seljmlwo = $con->select("trwo a join trdata b on a.id_data=b.id_data","count(id_wo) as jmlwo","status_data != '4'");
foreach ($seljmlwo as $jmlwo) {}

$selagent = $con->select("mtagent a join mtpegawai b on a.id_pegawai=b.id_pegawai","id_agent,nama_pegawai","id_status = 1");
$selcat = $con->select("mtkategori","*","status_kategori = '1'");

//echo "Select id_agent,nama_pegawai from mtagent a join mtpegawai b on a.id_pegawai=b.id_pegawai where status_agent = 1";
foreach ($selmodreq as $mg) {}
	

	if($mg['status_data'] == '1'){
		$isijam = "<a href='javascript:void(0)' class='label label-danger'>Open</a>";
	} else if ($mg['status_data'] == '2') {
		$isijam = "<a href='javascript:void(0)' class='label label-info'>On Progress</a>";
	} else if ($mg['status_data'] == '3') {
		$isijam = "<a href='javascript:void(0)' class='label label-warning'>Hold</a>";
	} else if ($mg['status_data'] == '4') {
		$isijam = "<a href='javascript:void(0)' class='label label-success'>Closed</a>";
	} else if ($mg['status_data'] == '0') {
		$isijam = "<a href='javascript:void(0)' class='label label-default'>Reject</a>";
	} else if ($mg['status_data'] == '5') {
		$isijam = "<a href='javascript:void(0)' class='label label-warning' style='color:#000000;'>Hold Request</a>";
	} else if ($mg['status_data'] == '6') {
		$isijam = "<a href='javascript:void(0)' class='label label-warning' style='background-color:#0000FF'>Assigned</a>";
	} 

	if ($mg['priority_wo'] == 1){
		$prio = "<a href='javascript:void(0)' class='label label-success' >Low</a>";
	} else if ($mg['priority_wo'] == 2){
		$prio = "<a href='javascript:void(0)' class='label label-warning' style='color:#000000'>Medium</a>";
	} else if ($mg['priority_wo'] == 3){
		$prio = "<a href='javascript:void(0)' class='label label-danger'>High</a>";
	}
 ?>
<!-- Theme CSS -->
		<!-- Vendor CSS -->
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

		<span class="separator"></span>
				<form class="form-user" id="formku" method="post" action="content.php?p=<?=$_GET[p]?>_s" enctype="multipart/form-data">
					<div class="row">
                    	<div class="col-md-12">
							
                            <div class="col-md-10" style="padding: 1%;margin-bottom: 2%">
                        	<h2><strong>Request Order</strong> &ensp;
                        		<font style="font-size: 18px;vertical-align: middle;"><?php echo $isijam; ?></font> 
                        	</h2> 
                        	
                            </div>
                            <div class="col-md-2" style="padding: 1%;">
                        		<a href="javascript:void(0)" onClick="window.open('cetak.php?page=request&id=<?=$_GET[id]?>')"  style="cursor:pointer">
                        			<img src="assets/images/print-icon.png" alt="Print PDF" />
                        		</a>
                            </div>
                        </div>
						<input id="kode" name="kode" value="<?=$_GET[id]?>" type="hidden" >
						<input id="iddata" name="iddata" value="<?=$mg[id_data]?>" type="hidden" >
						<input id="notiket" name="notiket" value="<?=$mg['no_ticket']?>" type="hidden" >
						<input id="getp" name="getp" value="<?=$_GET[p]?>" type="hidden" >
						<input id="appr" name="appr" value="<?=$_SESSION['ID_PEG'];?>" type="hidden" >
						<div class="col-md-6 col-lg-6">
							<div class="tabs">
									<div id="overview" class="tab-pane active">
										<!-- <h4 class="mb-xlg">Personal Information</h4> -->
										<div id="edit" class="tab-pane">

											<fieldset>
												<div class="form-group">
													<label class="col-md-4 control-label" for="profileFirstName">No. Ticket</label>
													<div class="col-md-8">
														<?php echo $mg['no_ticket']?>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-4 control-label" for="profileFirstName">Dept</label>
													<div class="col-md-8">
														<?php echo $mg['nama_dept']?>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-4 control-label" for="profileFirstName">Hardware ID</label>
													<div class='col-md-8'>
										                <span style="cursor:pointer" data-toggle="collapse" data-target="#demo"><b><?php echo $mg['namaaset_data']?></b></span>
										               
										            </div>
													 <div id="demo" class="col-md-12 collapse"><?php include "detailaset.php"; ?></div>
												</div>

												<div class="form-group">
													<label class="col-md-4 control-label" for="profileLastName">Created Date</label>
													<div class="col-md-8">
														<?php echo $mg['created_date_data']?>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-4 control-label" for="profileAddress">Last Update</label>
													<div class="col-md-8">
														<?php echo $mg['dateupdate_data']?>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-4 control-label" for="profileAddress">Complete On</label>
													<div class="col-md-8">
														<?php echo $mg['closed_date_data']?>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-4 control-label" for="profileAddress">Remark Problem</label>
													<div class="col-md-8">
														<?php echo $mg['remark_data']?>
													</div>
												</div>
												
											</fieldset>									
										</div>
									</div>
							</div>
						</div>
						<div class="col-md-6 col-lg-6">
							<?php if($mg['status_data'] == 1 || $mg['status_data'] == 5) { ?>
											<fieldset>
												<div class="form-group">
													<label class="col-md-4 control-label" for="profileFirstName">Category</label>
													<div class="col-md-8">
														<select data-plugin-selectTwo class="form-control populate"  placeholder="None Selected" name="kategori" id="kategori" onchange="kate(this.value)">
															<option value="">Choose Category</option>
															<?php 
																  foreach ($selcat as $cat) { 
																  if($mg['id_kategori'] == $cat['id_kategori']){
																  	$s="selected";
																  } else{
																  	$s="";
																  }
															?>
																<option value="<?=$cat[id_kategori]?>" <?=$s?>><?=$cat['nama_kategori']?></option>
															<?php } ?>
														</select>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-4 control-label" for="profileFirstName">Sub Category</label>
													<div class="col-md-8">
														<select data-plugin-selectTwo class="form-control populate"  placeholder="None Selected" name="subkategori" id="subkategori" required>

														</select>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-4 control-label" for="profileFirstName">Priority</label>
													<div class="col-md-8">
														<select data-plugin-selectTwo class="form-control populate"  placeholder="None Selected" name="priority" id="priority" required>
															<option value="">Choose Priority</option>
																<option value="1" <?php if($mg['priority_request'] == 1){ echo "selected";}?> >Low</option>
																<option value="2" <?php if($mg['priority_request'] == 2){ echo "selected";}?> >Middle</option>
																<option value="3" <?php if($mg['priority_request'] == 3){ echo "selected";}?> >High</option>
														</select>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-4 control-label" for="profileLastName">Assigned To</label>
													<div class="col-md-8">
														<select data-plugin-selectTwo class="form-control populate" name="assign" id="assign" required>
															<option value="">Choose Agent</option>
															<?php 
																  foreach ($selagent as $age) { 
																  if($mg['id_agent'] == $age['id_agent']){
																  	$s="selected";
																  } else{
																  	$s="";
																  }
																  $selwoag = $con->select("trwo a join trdata b on a.id_data=b.id_data","count(id_wo) as jmlwoag","a.id_agent = '$age[id_agent]' and b.status_data != 4");
																  foreach ($selwoag as $woag) {}
																  	if ($woag['jmlwoag'] > 0){
																  		$persen1 = (($woag['jmlwoag']/$jmlwo['jmlwo'])*100);
																  		$persen = number_format($persen1);
																  	} else {
																  		$persen = '0';
																  	}
															?>
																<option value="<?=$age[id_agent]?>" <?=$s?>><?=$age['nama_pegawai'].'  ('.$persen.' %)'?></option>
															<?php } ?>
														</select>
													</div> 
												</div>
												<div class="form-group">
													<label class="col-md-4 control-label" for="profileAddress">Note for User</label>
													<div class="col-md-8">
														<textarea name="noteuser" id="noteuser" class="form-control"><?=$mg['note_user']?></textarea>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-4 control-label" for="profileAddress">Note for Agent</label>
													<div class="col-md-8">
														<textarea name="noteagent" id="noteagent" class="form-control"></textarea>
													</div>
												</div>
											</fieldset>
							<?php } else { ?>
											<fieldset>
												<div class="form-group">
													<label class="col-md-4 control-label" for="profileFirstName">Category</label>
													<div class="col-md-8">
														<?php echo $mg['nama_kategori']; ?>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-4 control-label" for="profileFirstName">Sub Category</label>
													<div class="col-md-8">
														<?php echo $mg['nama_kategori_sub']; ?>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-4 control-label" for="profileFirstName">Priority</label>
													<div class="col-md-8">
														<?php echo $prio; ?>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-4 control-label" for="profileLastName">Assigned To</label>
													<div class="col-md-8">
														<?php echo $mg['nama_pegawai']; ?>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-4 control-label" for="profileAddress">Note for User</label>
													<div class="col-md-8">
														<?php echo $mg['note_user']; ?>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-4 control-label" for="profileAddress">Note for Agent</label>
													<div class="col-md-8">
														<?php echo $mg['note_agent']; ?>
													</div>
												</div>
												
											</fieldset>

							<?php } ?>
						</div>
						<?php if($mg['status_data'] != 1 || $mg['status_data'] != 5) { ?>
							<div class="col-md-12 col-lg-12">
								<div class="form-group">
									<label class="col-md-2 control-label" for="profileAddress">Feedback Agent</label>
										<div class="col-md-10 pre-scrollable">
											<ul>
												<?php $selfb = $con->select("trfeedback","*","id_wo = '$mg[id_wo]'");
															
													foreach ($selfb as $fb) { ?>
													<li>
														<b><i><?=date('d-m-Y H:i:s',strtotime($fb['dateupdate_feedback']))?></i></b>
														<br>
															<?=$fb['remark_feedback']?>
													</li>	
															<?php }
															?>
											</ul>
										</div>
								</div>
							</div>
						<?php 
						}
						if ($mg['status_data'] == 1 || $mg['status_data'] == 5){ ?>
						<div class="col-md-12" align="center" style="margin-top: 2%;">
							
								<button id="btn-simpan" name="simpan" class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')" value="app" onclick="simpan(this.value)">
								 Approve 
				                </button>
				                <?php if ($mg['status_data'] != 5){ ?>
				                	<button id="btn-simpan" name="simpan" class="btn btn-warning" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')" value="hold">
								 	Hold Request
				                	</button>
				            	<?php } ?>
				                <button id="btn-simpan" name="simpan" class="btn btn-danger" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')" value="rej">
								 Reject
				                </button>
						</div>
						<?php } ?>
					</div>
				</form>
			</div>
					<!-- end: page -->
				</section>
			</div>
<script>
function kate(id){
		$.get('apps/transaction/request/subcat.php?id='+id, function(data) {
				$('#subkategori').html(data);    
		});
		
}	

function detailaset(id){
              $.ajax({
                  url:'apps/transaction/request/detailaset.php',
                  type:'post',
                  data:{userid:id},
                  success: function(response){
                      $('#demo').html(response);   
                  }
              });           
}


</script>