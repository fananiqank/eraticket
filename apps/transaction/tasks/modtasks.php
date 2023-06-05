<?php
include "../../../funlibs.php";
$con = new Database();
$selmodreq = $con->select("trrequest a left join mtdept b on a.departemen_req=b.id_dept
	left join trwo c on a.id_req =c.id_req
	left join mtkategori d on c.id_kategori = d.id_kategori
	left join mtagent e on c.id_agent = e.id_agent
	left join mtpegawai f on e.id_pegawai = f.id_pegawai","a.*,b.nama_dept,c.note_agent,c.feedback_user,d.nama_kategori,f.nama_pegawai","a.id_req = '$_GET[id]'");

$seljmlwo = $con->select("trwo","count(id_wo) as jmlwo");
foreach ($seljmlwo as $jmlwo) {}

$selagent = $con->select("mtagent a join mtpegawai b on a.id_pegawai=b.id_pegawai","id_agent,nama_pegawai","id_status = 1");
$selcat = $con->select("mtkategori","*","status_kategori = '1'");
//echo "Select id_agent,nama_pegawai from mtagent a join mtpegawai b on a.id_pegawai=b.id_pegawai where status_agent = 1";
foreach ($selmodreq as $mg) {}
	

	if($mg['status_req'] == '1'){
		$isijam = "<a href='javascript:void(0)' class='label label-danger'>Open</a>";
	} else if ($mg['status_req'] == '2') {
		$isijam = "<a href='javascript:void(0)' class='label label-info'>On Progress</a>";
	} else if ($mg['status_req'] == '3') {
		$isijam = "<a href='javascript:void(0)' class='label label-warning'>Hold WO</a>";
	} else if ($mg['status_req'] == '4') {
		$isijam = "<a href='javascript:void(0)' class='label label-success'>Closed</a>";
	} else if ($mg['status_req'] == '0') {
		$isijam = "<a href='javascript:void(0)' class='label label-default'>Reject</a>";
	} else if ($mg['status_req'] == '5') {
		$isijam = "<a href='javascript:void(0)' class='label label-warning' style='color:#000000;'>Hold Request</a>";
	} 
 ?>
<!-- Theme CSS -->
		<!-- Vendor CSS -->
		
		<span class="separator"></span>
				<form class="form-user" id="formku" method="post" action="content.php?p=<?=$_GET[p]?>_s" enctype="multipart/form-data">
					<div class="row" >
                    	<div class="col-md-12">
							
                            <div class="col-md-10" style="padding: 1%;margin-bottom: 2%">
                        	<h2><strong>Work Order</strong> &ensp;
                        		<font style="font-size: 18px;vertical-align: middle;"><?php echo $isijam; ?></font> 
                        	</h2> 
                        	
                            </div>
                            <div class="col-md-2" style="padding: 1%;">
                        		<a href="javascript:void(0)"onClick="window.open('cetak.php?page=request&id=<?=$_GET[id]?>')"  style="cursor:pointer">
                        			<img src="assets/images/print-icon.png" alt="Print PDF" />
                        		</a>
                            </div>
                        </div>
						<input id="kode" name="kode" value="<?=$_GET[id]?>" type="hidden" >
						<input id="notiket" name="notiket" value="<?=$mg['no_ticket']?>" type="hidden" >
						<input id="getp" name="getp" value="<?=$_GET[p]?>" type="hidden" >
						<div class="col-md-6 col-lg-6" >
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
													<label class="col-md-4 control-label" for="profileLastName">Created Date</label>
													<div class="col-md-8">
														<?php echo $mg['created_date_req']?>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-4 control-label" for="profileAddress">Last Update</label>
													<div class="col-md-8">
														<?php echo $mg['dateupdate_req']?>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-4 control-label" for="profileAddress">Complete On</label>
													<div class="col-md-8">
														<?php echo $mg['closed_date_req']?>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-4 control-label" for="profileAddress">Remark Problem</label>
													<div class="col-md-8">
														<?php echo $mg['remark_req']?>
													</div>
												</div>
												
											</fieldset>									
										</div>
									</div>
								
							</div>

						</div>
						<div class="col-md-6 col-lg-6">
							
											<fieldset>
												<div class="form-group">
													<label class="col-md-4 control-label" for="profileFirstName">Category</label>
													<div class="col-md-8">
														<select data-plugin-selectTwo class="form-control populate"  placeholder="None Selected" name="kategori" id="kategori">
															<option value="">Choose Category</option>
															<?php 
																  foreach ($selcat as $cat) { 
																  if($data[id_kategori] == $cat[id_kategori]){
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
													<label class="col-md-4 control-label" for="profileLastName">Assigned To</label>
													<div class="col-md-8">
														<select data-plugin-selectTwo class="form-control populate" name="assign" id="assign">
															<option value="">Choose Agent</option>
															<?php 
																  foreach ($selagent as $age) { 
																  if($data[id_agent] == $age[id_agent]){
																  	$s="selected";
																  } else{
																  	$s="";
																  }
																  $selwoag = $con->select("trwo","count(id_wo) as jmlwoag","id_agent = '$age[id_agent]'");
																  foreach ($selwoag as $woag) {}
																  	if ($woag['jmlwoag'] > 0){
																  		$persen = (($jmlwo['jmlwo']/$woag['jmlwoag'])*100);
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
														<textarea name="noteuser" id="noteuser" class="form-control ckeditor"><?=$mg['note_user']?></textarea>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-4 control-label" for="profileAddress">Note for Agent</label>
													<div class="col-md-8">
														<textarea name="noteagent" id="noteagent" class="form-control"></textarea>
													</div>
												</div>
											</fieldset>
							
						</div>
						<?php if ($mg['status_req'] == 1 || $mg['status_req'] == 5){ ?>
						<div class="col-md-12" align="center" style="margin-top: 2%;">
							
								<button id="btn-simpan" name="simpan" class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')" value="app">
								 Approve 
				                </button>
				                <?php if ($mg['status_req'] != 5){ ?>
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

			
<?php 
?>