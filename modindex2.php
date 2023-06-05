<?php
//echo "Select * from mtagent a join mtpegawai b on a.id_pegawai=b.id_pegawai where id_agent = '$_GET[id]'";
include "funlibs.php";
$con = new Database();
if ($_GET[x] == "view"){

$selmodagent = $con->select("trdata a left join trrequest b on a.id_data=b.id_data
	left join mtdept g on a.departemen_data=g.id_dept
	left join trwo c on a.id_data =c.id_data
	left join mtkategori d on c.id_kategori = d.id_kategori
	left join mtagent e on c.id_agent = e.id_agent
	left join mtpegawai f on e.id_pegawai = f.id_pegawai",
	"a.*,b.id_req,b.note_user,c.id_wo,c.dateupdate_wo,g.nama_dept,d.nama_kategori,f.nama_pegawai","b.id_req = '$_GET[id]'");
foreach ($selmodagent as $mg) {}
	if($mg[image] == ""){
		$img = "assets/images/!logged-user.jpg";
	} else {
		$img = "assets/img/pegawai/$mg[image]";
	}

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
		$isijam = "<a href='javascript:void(0)' class='label label-warning' style='color: #000000;'>Hold Request</a>";
	} else if ($mg['status_data'] == '6') {
		$isijam = "<a href='javascript:void(0)' class='label label-warning' style='background-color:#0000FF'>Assigned</a>";
	} 

	$selapp = $con->select("trapprove a join mtpegawai b on a.id_pegawai=b.id_pegawai","b.nama_pegawai","a.id_req = $_GET[id]");
	foreach ($selapp as $app) {}
 ?>
<!-- Theme CSS -->
		<!-- Vendor CSS -->
		
		<span class="separator"></span>
		<form class="form-horizontal" method="post" id="form-user ft11">		
					<div class="row">
                    	<div class="col-md-12">
							
                            <div class="col-md-10" style="padding: 1%;">
                        	<h2><strong>Request Order</strong> &ensp;
                        		<font style="font-size: 16px;vertical-align: middle;"><?php echo $isijam; ?></font> 
                        	</h2> 
                        	
                            </div>
                            <div class="col-md-2" style="padding: 1%;">
                        		<!-- <a href="javascript:void(0)"onClick="window.open('cetak.php?page=request&id=<?=$_GET[id]?>')"  style="cursor:pointer">
                        			<img src="assets/images/print-icon.png" alt="Print PDF" />
                        		</a> -->
                            </div>
                        </div>
					
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
													<label class="col-md-4 control-label" for="profileAddress">Problem</label>
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
											<fieldset>
												<div class="form-group">
													<label class="col-md-4 control-label" for="profileFirstName">Category</label>
													<div class="col-md-8">
														<?php echo $mg['nama_kategori']?>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-4 control-label" for="profileLastName">Assigned To</label>
													<div class="col-md-8">
														<?php echo $mg['nama_pegawai']?>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-4 control-label" for="profileAddress">Complete On</label>
													<div class="col-md-8">
														<?php echo $mg['closed_date_data']?>
													</div>
												</div>
												<?php if($mg['status_data'] == '1' || $mg['status_data'] == '2'){ ?>
												<div class="form-group">
													<label class="col-md-4 control-label" for="profileAddress">Follow Up</label>
													<div class="col-md-8">
														<textarea class="form-control" id="followup" name="followup"></textarea>
														<input id="idreq" name="idreq" value="<?=$_GET[id]?>" type="hidden" />
														<a href="javascript:void(0)" class="btn btn-primary" onclick="inputfu()">Submit</a>
													</div>
												</div>
												<?php } ?>
											</fieldset>
							
						</div>
					
						<div class="col-md-12 col-lg-12">
							<fieldset>
											<div class="form-group">
													<div class="col-md-2" >
														<label class="control-label" for="profileAddress" style="float: right;">Feedback Agent</label>
													</div>											
													<div class="col-md-10 pre-scrollable" style="height: 100px;" id="convert">
															<?php  include "feedback.php"; ?>
																									
													</div>
											</div>
								</fieldset>

						</div>

					</div>
		</form>
					<!-- end: page -->
	</section>
</div>

			
    
    <!-- Vendor -->
		
<?php 
} else {
	$selmg = $con->select("mttopik a join mtkategoritopik b on a.id_kattopik=b.id_kattopik","a.*,b.nama_kattopik","id_topik = $_GET[id]");
//echo "select a.*,b.nama_kattopik from mttopik a join mtkategoritopik b on a.id_kattopik=b.id_kattopik where id_topik = $_GET[id]";
	foreach ($selmg as $mg) {}
?>	
	<div class="form-group">
			<label class="col-md-2 control-label" for="profileLastName"><b>Category Topic</b></label>
			<div class="col-md-9">
				<?php echo $mg['nama_kattopik']?>
			</div>
			<div class="col-md-1">
				<!-- <a href="javascript:void(0)"onClick="window.open('cetak.php?page=request&id=<?=$_GET[id]?>')"  style="cursor:pointer">
                        			<img src="assets/images/print-icon.png" alt="Print PDF" />
                </a> -->
			</div>
	</div>
	<div class="form-group">
			<label class="col-md-2 control-label" for="profileLastName"><b>Tips</b></label>
			<div class="col-md-2">
				<?php if($mg['tips'] == 1){
					echo "Yes";
				} else {
					echo "No";
				}
				?>
			</div>
	</div>
	<hr>
	<div class="form-group" style="border-top: medium;">
			<label class="col-md-2 control-label" for="profileAddress"><b>Problem</b></label>
			<div class="col-md-10">
				<?php echo $mg['problem']?>
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
				<?php echo $mg['solusi']?>
			</div>
	</div>

	<div>
		<p>&nbsp;</p>
	</div>
<?php 
}
?>
<script type="text/javascript">
	
</script>