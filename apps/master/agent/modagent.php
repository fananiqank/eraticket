<?php
//echo "Select * from mtagent a join mtpegawai b on a.id_pegawai=b.id_pegawai where id_agent = '$_GET[id]'";
include "../../../funlibs.php";
$con = new Database();
$selmodagent = $con->select("mtagent a join mtpegawai b on a.id_pegawai=b.id_pegawai 
join mtjabatan c on b.id_jabatan=c.id_jabatan 
join mtjobcat d on a.id_jobcat=d.id_jobcat 
join mtcabang e on b.id_cabang=e.ID_CABANG
join mtdept f on b.id_departemen=f.id_dept","*","a.id_agent = '$_GET[id]'");

// assign
$seljmlon = $con->select("trwo b left join trdata c on b.id_data=c.id_data","count(b.id_wo) as jmlon","b.id_agent = '$_GET[id]' and c.status_data = '2'");
foreach ($seljmlon as $jmlon) {}
$seljmlhl = $con->select("trwo b left join trdata c on b.id_data=c.id_data","count(b.id_wo) as jmlhl","b.id_agent = '$_GET[id]' and c.status_data = '3'");
foreach ($seljmlhl as $jmlhl) {}
$seljmlcl = $con->select("trwo b left join trdata c on b.id_data=c.id_data","count(b.id_wo) as jmlcl","b.id_agent = '$_GET[id]' and c.status_data = '4'");
foreach ($seljmlcl as $jmlcl) {}
$seljmlas = $con->select("trwo b left join trdata c on b.id_data=c.id_data","count(b.id_wo) as jmlas","b.id_agent = '$_GET[id]' and c.status_data = '6'");
foreach ($seljmlas as $jmlas) {}

// tasks
$seljmltop = $con->select("trtasks","count(id_tasks) as jmltop","id_agent = '$_GET[id]' and status_tasks = '1'");
foreach ($seljmltop as $jmltop) {}
$seljmlton = $con->select("trtasks","count(id_tasks) as jmlton","id_agent = '$_GET[id]' and status_tasks = '2'");
foreach ($seljmlton as $jmlton) {}
$seljmlthl = $con->select("trtasks","count(id_tasks) as jmlthl","id_agent = '$_GET[id]' and status_tasks = '3'");
foreach ($seljmlthl as $jmlthl) {}
$seljmltcl = $con->select("trtasks","count(id_tasks) as jmltcl","id_agent = '$_GET[id]' and status_tasks = '4'");
foreach ($seljmltcl as $jmltcl) {}


foreach ($selmodagent as $mg) {}
	if($mg[image] == ""){
		$img = "assets/images/poto-user.png";
	} else {
		$img = "assets/img/pegawai/$mg[image]";
	}

 ?>

		<span class="separator"></span>
				
					<div class="row">
						<div class="col-md-4 col-lg-3">

							<section class="panel">
								<div class="panel-body">
									<div class="thumb-info mb-md">
										<a href="content.php?p=<?=$_GET[p]?>&ph=<?=$_GET[id]?>"><img src="<?=$img?>" class="img-responsive" width="100%" style="width:150%;height: 200px" title="Klik Edit Photo"></a>
										<div class="thumb-info-title">
											<span class="thumb-info-inner"><?=$mg['nama_pegawai']?></span>
											<span class="thumb-info-type"><?=$mg['nama_jobcat']?></span>
										</div>
									</div>
									<hr class="dotted short">
									<div align="center" style="width: 100%">
										<a href="content.php?p=<?=$_GET[p]?>&d=<?=$_GET[id]?>" type="button" style="padding: 7%;width: 70%" class="btn btn-primary">Edit</a>
									</div>
								</div>
							</section>

						</div>
						<div class="col-md-8 col-lg-6">
							<h3 style="margin-bottom: 3%"><b><i>Personal Information</i></b></h3>
											<fieldset>
												<div class="form-group">
													<label class="col-md-3 control-label" for="profileFirstName">First Name</label>
													<div class="col-md-8">
														<?php echo $mg['nama_awal']?>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label" for="profileLastName">Last Name</label>
													<div class="col-md-8">
														<?php echo $mg['nama_akhir']?>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label" for="profileAddress">Position</label>
													<div class="col-md-8">
														<?php echo $mg['nama_dept']?>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label" for="profileAddress">Position</label>
													<div class="col-md-8">
														<?php echo $mg['nama_jabatan']?>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label" for="profileCompany">Job Category</label>
													<div class="col-md-8">
														<?php echo $mg['nama_jobcat']?>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label" for="profileCompany">Email</label>
													<div class="col-md-8">
														<?php echo $mg['email']?>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label" for="profileCompany">Phone</label>
													<div class="col-md-8">
														<?php echo $mg['phone']?>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label" for="profileAddress">Location</label>
													<div class="col-md-8">
														<?php echo $mg['NAMA_CABANG']?>
													</div>
												</div>
											</fieldset>
							
						</div>

						<div class="col-md-12 col-lg-3">

							<div class="tabs">
								<ul class="nav nav-tabs tabs-primary">
									<li class="active">
										<a href="#overview" data-toggle="tab">Assign</a>
									</li>
									<li>
										<a href="#edit" data-toggle="tab">Tasks</a>
									</li>
								</ul>
								<div class="tab-content">
									<div id="overview" class="tab-pane active">
										<h4 class="mb-md">Assign</h4>
											<!-- <select data-plugin-selectTwo class="form-control populate" name="bulan" placeholder="None Selected" id="bulan"
											onchange="ubahbulan(<?=$_GET[id]?>,this.value)">
													<option value="A">All</option>
													<option value="01">January</option>
													<option value="02">February</option>
													<option value="03">March</option>
													<option value="04">April</option>
													<option value="05">May</option>
													<option value="06">June</option>
													<option value="07">July</option>
													<option value="08">August</option>
													<option value="09">September</option>
													<option value="10">October</option>
													<option value="11">November</option>
													<option value="12">December</option>
											</select>
											<div id="isiassign">
												
											</div> -->
										<ul class="simple-card-list mb-xlg">
											<li class="primary">
												<h3><?=$jmlas['jmlas']?></h3>
												<p>Assign</p>
											</li>
											<li class="primary">
												<h3><?=$jmlon['jmlon']?></h3>
												<p>On Progress</p>
											</li>
											<li class="primary">
												<h3><?=$jmlhl['jmlhl']?></h3>
												<p>Hold</p>
											</li>
											<li class="primary">
												<h3><?=$jmlcl['jmlcl']?></h3>
												<p>Closed</p>
											</li>
										</ul>
										
									</div>
									<div id="edit" class="tab-pane">
										<h4 class="mb-md">Tasks</h4>
										<ul class="simple-card-list mb-xlg">
											<li class="primary">
												<h3><?=$jmltop['jmltop']?></h3>
												<p>Open</p>
											</li>
											<li class="primary">
												<h3><?=$jmlton['jmlton']?></h3>
												<p>On Progress</p>
											</li>
											<li class="primary">
												<h3><?=$jmlthl['jmlthl']?></h3>
												<p>Hold</p>
											</li>
											<li class="primary">
												<h3><?=$jmltcl['jmltcl']?></h3>
												<p>Closed</p>
											</li>
										</ul>
										
									</div>
								</div>
							</div>
						</div>
						
					</div>
					<!-- end: page -->
				</section>
			</div>

		</section>
 
<?php 
?>