
<?php 
//error_reporting(0); 
require_once "funlibs.php";
$con = new Database;

// require_once "funlibs2.php";
// $con2 = new Database2;

require ('UserInfo.php');

$ipaddress = gethostbyaddr($_SERVER['REMOTE_ADDR']);

$seldep = $con->select("mtdept","*");
$dept=$con->select("clients","*");

if($_GET[x] == 'view'){
	$judulmod = "Request Order";
} else if($_GET[x] == 'viewnewreq') {
	$judulmod = "Progress Ticket";
} else {
	$judulmod = "Tips & Tricks";
} 

if($_GET[ids]){
	// echo "select a.id as idaset,a.machine_id as serial,a.tag,a.clientid as iditassets,b.name as nama_user,b.email,c.name as nama_category,a.categoryid,a.userid from assets a join people b on a.userid=b.id join assetcategories c on a.categoryid=c.id where a.id = $_GET[ids]";
	$dat=$con->select("assets a left join people b on a.userid=b.id join assetcategories c on a.categoryid=c.id","a.id as idaset,a.machine_id as serial,a.tag,a.clientid as iditassets,b.name as nama_user,b.email,c.name as nama_category,a.categoryid,a.userid","a.id = $_GET[ids]");
	foreach($dat as $dt){}
	foreach ($con->select("clients","*","id = '$dt[iditassets]'") as $dp) {}
	

	$dispdetail = "style='display:block'";
} else {
	$dispdetail = "style='display:none'";
}
?>
<!Doctype html>
<html class="fixed">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">
		<title>Eraticket</title>
		<meta name="keywords" content="EraTicket" />
		<meta name="description" content="EraTicket Management">
		<meta name="author" content="okler.net">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<meta name="msapplication-TileColor" content="#ffffff">
		<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
		<meta name="theme-color" content="#ffffff">
		<!-- icon -->
		<link rel="apple-touch-icon" sizes="57x57" href="assets/images/favicon/apple-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="assets/images/favicon/apple-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="assets/images/favicon/apple-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="assets/images/favicon/apple-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="assets/images/favicon/apple-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="assets/images/favicon/apple-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="assets/images/favicon/apple-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="assets/images/favicon/apple-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="assets/images/favicon/apple-icon-180x180.png">
		<link rel="icon" type="image/png" sizes="192x192"  href="assets/images/favicon/android-icon-192x192.png">
		<link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicon/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="96x96" href="assets/images/favicon/favicon-96x96.png">
		<link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon/favicon-16x16.png">
		<link rel="manifest" href="/manifest.json">

		<!-- Vendor CSS -->
    	<link rel="stylesheet" href="assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.css" />
		<!-- <link rel="stylesheet" href="assets/vendor/magnific-popup/magnific-popup.css" /> -->
		<link rel="stylesheet" href="assets/vendor/bootstrap-datepicker/css/datepicker3.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-timepicker/css/bootstrap-timepicker.css" />

		<!-- Specific Page Vendor CSS -->
		<link rel="stylesheet" href="assets/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-colorpicker/css/bootstrap-colorpicker.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-timepicker/css/bootstrap-timepicker.css" />
		<link rel="stylesheet" href="assets/vendor/dropzone/css/basic.css" />
		<link rel="stylesheet" href="assets/vendor/dropzone/css/dropzone.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-markdown/css/bootstrap-markdown.min.css" />
		<link rel="stylesheet" href="assets/vendor/morris/morris.css" />
    	<link rel="stylesheet" href="assets/vendor/select2/select2.css" />
		<link rel="stylesheet" href="assets/vendor/jquery-datatables-bs3/assets/css/datatables.css" />
		<link rel="stylesheet" href="assets/stylesheets/sweetalert.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.css" />
		<!-- Theme CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme.css" />
		
		<!-- Skin CSS -->
		<link rel="stylesheet" href="assets/stylesheets/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme-custom.css">
		<link rel="stylesheet" href="assets/stylesheets/themes/base/jquery.ui.autocomplete.css" />
		<style>
			.dt-body-center {
			    text-align: center;
			}
			.shadowback {
				-webkit-box-shadow: 4px 4px 5px 0px rgba(0,0,0,0.75);
				-moz-box-shadow: 4px 4px 5px 0px rgba(0,0,0,0.75);
				box-shadow: 4px 4px 5px 0px rgba(0,0,0,0.75);
			}
			.shadowback:hover{
				font-size: 12px;
				transition: width 10s, height 4s;
			}

			.table-aset {
				border: 1px solid #ddd;
  				text-align: left;
  				border-collapse: collapse;
  				width: 100%;
			}
			@media only screen and (max-width: 1030px) {
				.ft11 {
					font-size: 11px;
				}

				.ft9 {
					font-size: 9px;
				}
			}

			@media only screen and (min-width: 1031px) {
				.ft11 {
					font-size: 12px;
				}

				.ft9 {
					font-size: 10px;
				}
			}
			
		</style>
		<!-- Head Libs -->
		<script src="assets/vendor/modernizr/modernizr.js"></script>

	</head>
	<body>
		<!-- start: page -->
		<section class="content-body" style="margin-left: 1%;">
			<div class="center-sign">
				
				<div class="panel panel-sign">
					
					<div class="form-group has-feedback has-feedback-left" style="display:none" >
							<input type="text" style="height:38px;" name="check" id="check" class="form-control input-sm" placeholder="androidcheck">
							<div class="form-control-feedback">
								<i class="icon-user text-muted"></i>
							</div>
					</div>
					<!-- <div class="panel-body" style="background-image: linear-gradient(to bottom, rgba(0,0,0,0) 0%,rgba(0,0,0,0) 100%), url('assets/images/bgcurve3.jpg');background-position: absolute;"> -->
					<div class="panel-body" style="background-image: url('assets/images/bck2.jpg');background-position: absolute; background-size: 100% 100%;background-repeat: no-repeat;">
						<a href="index.php" class="logo pull-left">
							<img src="assets/images/logo-eratex-djaja.png" height="80" width="120%" alt="Eratex Djaja" />
						</a>
						<div class="panel-title-sign mt-xl text-right">
								<?php if($_GET[x]){ ?>
								<a href="index.php" id="back">
									<img src="assets/images/go-back.png" width="2%" alt="Back" />
						      	</a> &ensp;
						      	<?php } ?>
						      	<a href="index.php?x=newreq" class="btn btn-primary shadowback btn-sm" style="background-color: #008080;font-size: 12px;">Form Request</a>
						      	&emsp;|&emsp;
								<a href="index.php?x=viewnewreq" class="btn btn-danger shadowback btn-sm" style="font-size: 12px;">View Form Request</a>
						      	&emsp;|&emsp;
						      	<a href="login.php" class="btn btn-default shadowback btn-sm" style="background-color: #FFF4A3;font-size: 12px;">Approve Request</a>
						      	&emsp;|&emsp;
								<a href="http://intranet.eratex.co.id" class="btn btn-primary shadowback btn-sm" style="background-color: #0000CD;font-size: 12px;" target="_blank"><b>Portal IT</b></a>
								&emsp;|&emsp;
								<a href="http://192.168.31.25/ontrack" class="btn btn-default shadowback btn-sm" style="font-size: 12px;" target="_blank"><b>IT Sign in</b></a>
								&emsp;&emsp;&emsp;
								<!-- <a href="http://192.168.51.26/ontrack_dev/?route=signin" class="btn hidden-xs shadowback" style="border-color: #218CE6;font-size: 12px;"><b>Sign In</b></a>
								<a href="http://192.168.51.26/ontrack_dev/?route=signin" class="btn btn-primary btn-block btn-lg visible-xs mt-lg">Sign In</a> -->
								<!-- <a href="login.php" class="btn hidden-xs shadowback" style="border-color: #218CE6;font-size: 12px;"><b>Sign In</b></a>
								<a href="login.php" class="btn btn-primary btn-block btn-lg visible-xs mt-lg">Sign In</a>
							</a> -->
						</div>
						<p style="margin-bottom: 1%;">&nbsp;</p>

		<form action="simpan.php" method="post" id="form1" name="form1" class="form-user ft11" enctype="multipart/form-data">
						<input id="getx" name="getx" value="<?=$_GET[x]?>" type="hidden">
						<input type="hidden" name="ipaddressreport" id="ipaddressreport" value="<?=$ipaddress?>">
					<?php if($_GET[x] == 'view') { ?>
					<div class="col-sm-12" style="color: #484848;">
						
							<div class="form-group mb-lg">
								<div class="col-sm-1">
									&nbsp;
								</div>
								
								</div>
								<div class="col-sm-8">
									
								</div>
							</div>

							<div class="form-group mb-lg">
								<h5 align="center" >View Ticket</h5>
								<table class="table table-bordered table-hover pre-scrollable" id="datatable-ajax">
								<thead>
									<tr>
										<th width="5%">No</th>
										<th width="15%">No Ticket</th>
										<th width="10%">Asset ID</th>
										<th width="10%">Asset User</th>
										<th width="10%">Reported by</th>
										<th width="15%">Department</th>
										<th width="10%">Room</th>
										<th width="10%">Assigned</th>
										<th width="15%">Date</th>
										<th width="10%">Status</th>	
									</tr>
								</thead>
								
								<tbody style="overflow-x: auto">
									<input name="isiass" id="isiass" value="<?=$_GET[d]?>" type="hidden">
								</tbody>
							
							</table>
							
					</div>
					<?php } else if($_GET[x] == 'viewnewreq') { ?>
					<div class="col-sm-12" style="color: #484848;">
						
							<div class="form-group mb-lg">
								<div class="col-sm-1">
									&nbsp;
								</div>
								
								</div>
								<div class="col-sm-8">
									
								</div>
							</div>

							<div class="form-group mb-lg">
								<h5 align="center">View Form Request</h5>
								<table class="table table-bordered table-hover pre-scrollable" id="datatable-ajax2" style="font-size:11px">
								<thead>
									<tr>
										<th width="5%">No</th>
										<th width="10%">Type</th>
										<th width="10%">No Req</th>
										<th width="8%">Nopeg</th>
										<th width="12%">Nama</th>
										<th width="13%">Dept</th>
										<th width="10%">Jabatan</th>
										<th width="10%">Head Status</th>
										<th width="10%">IT Status</th>	
										<th width="10%">Progress</th>	
									</tr>
								</thead>
								
								<tbody style="overflow-x: auto">
									<input name="isiass2" id="isiass2" value="<?=$_GET[d]?>" type="hidden">
								</tbody>
							
							</table>
							
					</div>
					<?php } else if($_GET[x] == 'tips'){ ?>
					<div class="col-sm-12" style="color: #484848;">
						
							<div class="form-group mb-lg">
								<div class="col-sm-1">
									&nbsp;
								</div>
								
								</div>
								<div class="col-sm-8">
									
								</div>
							</div>

							<div class="form-group mb-lg">
								<h5 align="center">Tips & Tricks</h5>
								<table class="table table-bordered table-hover pre-scrollable" id="datatable-ajax">
								<thead>
									<tr>
										<th style="text-align: center;" width="5%">No</th>
										<th style="text-align: center;" width="45%">Problem</th>
										<th style="text-align: center;" width="30%">Categories</th>
										<th style="text-align: center;" width="20%">Detail</th>
									</tr>
								</thead>
								
								<tbody style="overflow-x: auto">
								</tbody>
							
							</table>
							
					</div>
				<?php } else if($_GET[x] == 'newreq'){ ?>
				<div class="col-sm-12" style="font-size:11px;padding-left: 2px;padding-right: 1px;">
						<div class="col-sm-4" style="color: #484848;">
							<div class="form-group mb-lg">
								<div class="col-sm-2" style="vertical-align: middle;">
									<strong>Jenis Permintaan</strong>
								</div>
								<div class="col-sm-10"  id="coldepas">
									<div class="input-group input-group-icon">
										<select data-plugin-selectTwo class="form-control populate input-sm" placeholder="None Selected" name="typereq" id="typereq" onclick="typerequest(this.value)">
										    <option value="">Choose</option>
										    <option value="1">Permintaan Akun</option>
										    <option value="2">Izin Akses Data</option>
										    <!-- <option value="3">Peminjaman Laptop</option> -->
										    <option value="4">Penutupan Akun</option>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group mb-lg" id="replacement" style="display:none">
								<div class="col-sm-2" style="vertical-align: middle;">
									<strong>Tipe</strong>
								</div>
								<div class="col-sm-10"  id="coldepas">
									<select data-plugin-selectTwo class="form-control populate input-sm" placeholder="None Selected" name="trep" id="trep" onclick="freplace(this.value)">
										    <option value="1">Replacement</option>
										    <option value="2">Not Replace</option>
										    
									</select>
								</div>
							</div>
							<div class="form-group mb-lg" id="nogmreplacement">
								<?php include "sourceformnogm2.php"; ?>
								
							</div>
							<div class="form-group mb-lg">
								<div class="col-sm-2" style="vertical-align: middle;">
									<strong>Nama</strong>
								</div>
								<div class="col-sm-10"  id="coldepas">
									<div class="input-group input-group-icon">
										<input name="namepeople" id="namepeople" type="text" class="form-control input-sm" style="text-transform: uppercase;" value="" required/>
										<input name="peopleid" id="peopleid" type="hidden" class="form-control" />
										<input name="approvetype" id="approvetype" type="hidden" class="form-control" />									
									</div>
								</div>
							</div>
							<div class="form-group mb-lg">
								<div class="col-sm-2" style="vertical-align: middle;">
									<strong>Dept</strong>
								</div>
								<div class="col-sm-10"  id="coldepas">
									<div class="input-group input-group-icon">
										<select data-plugin-selectTwo class="form-control populate input-sm" placeholder="None Selected" name="depnew" id="depnew">
										    <?php include "sourceseldep.php"; ?>
										</select>
									</div>
								</div>
								<!-- <div class="col-sm-4"  id="coldepas">
									<div class="input-group input-group-icon">
										<select data-plugin-selectTwo class="form-control populate" placeholder="Location Selected" name="locationid" id="locationid">
										    <?php //include "sourcesellocdep.php"; ?>
										</select>
									</div>
								</div> -->
							</div>
							<div class="form-group mb-lg">
								<div class="col-sm-2" style="vertical-align: middle;">
									<strong>Jabatan</strong>
								</div>
								<div class="col-sm-10"  id="coldepas">
									<div class="input-group input-group-icon">
										<input name="jabatan" id="jabatan" type="text" class="form-control input-sm" value="" required/>
										<input name="mobile" id="mobile" type="hidden" class="form-control" />
										<input name="jenispermin" id="jenispermin" type="hidden" class="form-control" />
									</div>
								</div>
							</div>
							
							<!-- <div class="form-group mb-lg">
								<div class="col-sm-2" style="vertical-align: middle;">
									<strong>Email</strong>
								</div>
								<div class="col-sm-10"  id="coldepas">
									<div class="input-group input-group-icon">
										<input name="alamatemail" id="alamatemail" type="text" class="form-control" value="" required/>
									</div>
								</div>
							</div> -->
							
						</div>
					<div id="permintaanakun" style="display:none;">
						<div class="col-sm-4" align="center">
								<h5 class="title text-uppercase text-weight-bold m-none">Sifat Kebutuhan</h5><br>
								<div class="form-group mb-lg">
								<div class="col-sm-12" style="vertical-align: middle;">
									<strong>Tanggal Kebutuhan</strong>
								</div>
								<div class="col-sm-5" >
									<div class="input-group input-group-icon">
										<input type="date" name="tglbutuh1" id="tglbutuh1" class="form-control input-sm ft9" style="padding-right: 5px;"/>
									</div>
								</div>
								<div class="col-sm-1" style="vertical-align: middle;">
									<strong>s/d</strong>
								</div>
								<div class="col-sm-5">
									<div class="input-group input-group-icon">
										<input type="date" name="tglbutuh2" id="tglbutuh2" class="form-control input-sm ft9" style="padding-right: 5px;" />
									</div>
								</div>
								<div class="col-sm-1">
									&nbsp;
								</div>
								<div class="col-sm-11" align="left">
									<input type="checkbox" value="1" onclick="cekapp(this)" id="selamaakses" name="selamaakses">&nbsp;Selama Menjabat
								</div>
							</div>
							<div class="form-group mb-lg">
								
								<h5 class="title text-uppercase text-weight-bold m-none">Alasan Kebutuhan</h5>
								<div class="col-sm-12">
									<div class="input-group input-group-icon">
										<textarea name="alasanbutuh1" id="alasanbutuh1" type="text" class="form-control ft11" ></textarea>
									</div>
								</div>
							</div>
							<div class="form-group mb-lg">	
								<h5 class="title text-uppercase text-weight-bold m-none">Website yang di akses</h5>
								<div class="col-sm-12">
									<div class="input-group input-group-icon">
										<textarea name="websiteakses" id="websiteakses" type="text" class="form-control ft11"></textarea>
									</div>
								</div>
							</div>
								
						</div>
					</div>
					<div id="penutupanakun" style="display:none">
						<div class="col-sm-4" align="center">
							<div class="form-group mb-lg">
								
								<h5 class="title text-uppercase text-weight-bold m-none">Alasan Penutupan</h5>
								<div class="col-sm-12">
									<div class="input-group input-group-icon">
										<textarea name="alasanbutuh2" id="alasanbutuh2" type="text" class="form-control ft11" ></textarea>
									</div>
								</div>
							</div>
							<div class="form-group mb-lg">
								<h5 class="title text-uppercase text-weight-bold m-none">Pengembalian Asset</h5>
								<div class="col-sm-12"  id="coldepas">
									<div class="input-group input-group-icon ft11" id="assetlist">

									</div>
								</div>
								<br><br>
								<div class="col-sm-12"  id="coldepas">
									
									<div class="col-sm-12"  id="coldepas">
										<h6 class="title text-uppercase text-weight-bold m-none" align="left">Hasil Pengecekan Asset</h6>
										<div class="input-group input-group-icon">
											<textarea class="form-control" id="notescek" name="notescek"></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div id="izinakses" style="display:none">
						<div class="col-sm-4" align="center">
							<h5 class="title text-uppercase text-weight-bold m-none">Informasi File/Folder</h5>
							<br>
							<div class="col-sm-12"  id="coldepas">
									<div class="input-group input-group-icon" id="assetlist2">

									</div>
								</div>
							<hr>
							<div class="form-group mb-lg">
								<div class="col-sm-2" style="vertical-align: middle;">
									<strong>File/Folder</strong>
								</div>
								<div class="col-sm-10"  id="coldepas">
									<div class="input-group input-group-icon">
										<input name="filefolder" id="filefolder" type="text" class="form-control input-sm" />
										
									</div>
								</div>
							</div>
							<div class="form-group mb-lg">
								<div class="col-sm-2" style="vertical-align: middle;">
									<strong>Lokasi</strong>
								</div>
								<div class="col-sm-10"  id="coldepas">
									<div class="input-group input-group-icon">
										<input name="lokasi" id="lokasi" type="text" class="form-control input-sm" />
									</div>
								</div>
							</div>

							<div class="form-group mb-lg">
								<div class="col-sm-2" style="vertical-align: middle;">
									<strong>Dept Tujuan</strong>
								</div>
								<div class="col-sm-10"  id="coldepas">
									<div class="input-group input-group-icon">
										<select data-plugin-selectTwo class="form-control populate input-sm" placeholder="None Selected" name="depizin" id="depizin">
										    <?php include "sourceseldep.php"; ?>
										</select>
									</div>
								</div>
							</div>

							<div class="form-group mb-lg">
								<div class="col-sm-2" style="vertical-align: middle;">
									<strong>Izin</strong>
								</div>
								<div class="col-sm-10"  id="coldepas">
									<div class="input-group input-group-icon">
										<select data-plugin-selectTwo class="form-control populate input-sm ft11" placeholder="None Selected" name="hakaksesfilefolder" id="hakaksesfilefolder">
										    <option value="1">Full Akses</option>
										    <option value="2">Read Only</option>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group mb-lg">
								<div class="col-sm-2" style="vertical-align: middle;">
									<strong>Remark</strong>
								</div>
								<div class="col-sm-10"  id="coldepas">
									<div class="input-group input-group-icon">
										<textarea name="remarkfilefolder" id="remarkfilefolder" type="text" class="form-control"></textarea>
									</div>
								</div>
							</div>
							<div class="form-group mb-lg">
								<div class="col-sm-2" style="vertical-align: middle;">
									<strong></strong>
								</div>
								<div class="col-sm-10"  id="coldepas">
									<div class="input-group input-group-icon" >
										<a href="javascript:void(0)" class="btn btn-primary btn-sm" style="font-size:12px;float: right;" onclick="simpanfilefolder()"><b>Add</b></a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div id="formakunakses" style="display:none">
						<div class="col-sm-4" align="center">
								<div class="row" >
									<h5 class="title text-uppercase text-weight-bold m-none">List Akun</h5>
									<br>
										<div id="akunygdiminta">
											<?php include "sourceakunminta.php"; ?>
										</div>
																	
									<br>
									<?php foreach($con->select("(select count(*) jmlminta from akunminta where statusakunminta = 1) as a","*") as $jam){} ?>
									<input type="hidden" name="jmlakunminta" id="jmlakunminta" value="<?=$jam['jmlminta']?>">

									<!-- <div class="col-sm-12">Tambahan:</div> 
									<textarea name="akun14" id="akun14" type="text" class="form-control" required></textarea> -->
								</div>
								<hr>
								<div class="row" id="nogmreplacement2" style="display:block">
									<div class="col-md-12"><b>Referense</b></div>
									
									<?php include "sourceformnogm.php"; ?>
																		
								</div>
								<div class="row" id="nogmreplacement3" style="display:none">
									<div class="col-md-12"><b>Referense</b></div>
									
																		
								</div>
								<div class="input-group input-group-icon" id="detailreplace">
								</div>
								<div class="input-group input-group-icon" id="detailreplace2">
								</div>
								<div class="input-group input-group-icon" id="assetlistreplace">
								</div>
								<hr>
								<!-- <div class="row" >
									<h5 class="title text-uppercase text-weight-bold m-none">Upload File</h5>
									<br>
									<input type="file" name="fileup" idname="fileup" class="form-control">
								</div> -->
						</div>
					</div>
					<div id="formizinakses" style="display:none">
						<div class="col-sm-4" align="center" style="overflow-x:scroll;">
								<div class="row" >
									<h5 class="title text-uppercase text-weight-bold m-none">List File/Folder</h5>
								</div>
								<div class="row" id="izinfilefolder">
									<?php include "sourceizinakses.php"; ?>
								</div>
								<hr>
								
								<!-- <div class="row" >
									<h5 class="title text-uppercase text-weight-bold m-none">Upload File</h5>
									<br>
									<input type="file" name="fileup" idname="fileup" class="form-control">
								</div> -->
						</div>
					</div>
					</div>	
							<div class="col-sm-7" align="right">
									<input type="hidden" name="statuspost" id="statuspost" value="2">
									<!-- <a href="index.php?x=viewnewreq" class="btn btn-primary shadowback btn-sm" style="background-color: #FF4500;font-size: 12px;"><b>View Form Request</b></a> -->
									
							</div>
							<div class="row" id="submitnewreq" style="display:none">
								
								<div class="col-sm-5" align="center">
									<button type="submit" class="btn btn-warning hidden-xs btn-sm">Submit</button>
									<button type="submit" class="btn btn-warning btn-block btn-lg visible-xs mt-lg btn-sm">Submit</button>
									<a href="javascript:void(0)" class="btn btn-default btn-sm" onclick="resetnew()">Reset</a>
								</div>
								
							</div>
					<?php } else { ?>
					<div class="col-sm-12" style="font-size:11px">
						<div class="col-sm-6" style="color: #484848;">
							<!-- <div class="form-group mb-lg">
								<div class="col-sm-1">
									&nbsp;
								</div>
								<div class="col-sm-3" style="vertical-align: middle;">
									<strong style="font-size: 14px;">Name</strong>
								</div>
								<div class="col-sm-8">
									<div class="input-group input-group-icon">
										<input name="nama" id="nama" type="text" class="form-control" required/>
									</div>
								</div>
							</div> -->
							<div class="form-group mb-lg">
								<div class="col-sm-1">
									&nbsp;
								</div>
								<div class="col-sm-3" style="vertical-align: middle;">
									<strong>Asset ID</strong>
								</div>
								<div class="col-sm-8"  id="coldepas">
									<div class="input-group input-group-icon">
										<select data-plugin-selectTwo class="form-control populate input-sm" placeholder="None Selected" name="hwid" id="hwid" onclick="cekaset(this.value)">
										    <option value="0">Choose</option>
										    <?php foreach($con->select("assets","*","statusid > 0 and categoryid != 3") as $ase){
										    	echo "<option value='".$ase[id]."'>".$ase[nodenumber]."</option>";
										    } ?>
										    
										</select>
										<!-- <input name="hwid" id="hwid" type="text" class="form-control input-sm" value="<?=$dt['serial']?>" required/> -->
										<input name="idasetontrack" id="idasetontrack" type="hidden" class="form-control" value="<?=$dt['idaset']?>" readonly required/>
									</div>
								</div>
							</div>
							<div class="form-group mb-lg" align="right" <?=$dispdetail?> id="detaildept">
								<div class="form-group" style="font-size: 11px;max-width: 90%;" >
									<table class="table" >
										<tr>
											<td width="20%">Department</td>
											<td width="30%"><span name="showdep2" id="showdep2"><?=$dp[name]?></span>
												<input type="hidden" name="dep" id="dep" class="form-control input-sm" value="<?=$dp['id']?>" readonly>
												<input type="hidden" name="depontrack" id="depontrack" class="form-control input-sm" value="<?=$dt['iditassets']?>" readonly>
												<input type="hidden" name="showdep" id="showdep" class="form-control" value="<?=$dp[name]?>" readonly>
											</td>
											<td width="15%">Type</td>
											<td width="35%"><span name="showtype" id="showtype"><?=$dt['nama_category']?></span>
												<input type="hidden" name="categoryid" id="categoryid" class="form-control" value="<?=$dt['categoryid']?>" readonly>
											</td>
											
										</tr>
										<tr>
											<td>User</td>
											<td><span name="nama2" id="nama2"><?=$dt['nama_user']?></span>
												<input name="nama" id="nama" type="hidden" class="form-control input-sm" value="<?=$dt['nama_user']?>" readonly required/>
												<input name="user_id" id="user_id" type="hidden" class="form-control" value="<?=$dt['userid']?>" readonly required/>
												<input name="compid" id="compid" type="hidden" class="form-control" value="<?php echo gethostbyaddr($_SERVER['REMOTE_ADDR']); ?>" readonly/>
											</td>
											<td>Email</td>
											<td><span name="email2" id="email2"><?=$dt['email']?></span>
												<input type="hidden" class="form-control" id="email" name="email" placeholder="use your eratex email" value="<?=$dt['email']?>" readonly required>
		                                        
											</td>
										</tr>
									</table>
																			
								</div>
							</div>
							
							<div class="form-group mb-lg">
								<div class="col-sm-1">
									&nbsp;
								</div>
								<div class="col-sm-3" style="vertical-align: middle;">
									<strong>Reported By</strong>
								</div>
								<div class="col-sm-8">
									<div class="input-group input-group-icon">
										<input name="report_name" id="report_name" type="text" class="form-control input-sm" onkeyup="ucode2()" required/>
									</div>
								</div>
							</div>
							<div class="form-group mb-lg">
								<div class="col-sm-1">
									&nbsp;
								</div>
								<div class="col-sm-3" style="vertical-align: middle;">
									<strong>Reported Email</strong>
								</div>
								<div class="col-sm-8">
									<div class="input-group input-group-icon">
										<input name="report_email" id="report_email" type="text" class="form-control input-sm" onblur="validate(this.value)" placeholder="use your email"/>
									</div>
									<input type="hidden" class="form-control" id="bs" name="bs" >
                                    <input type="hidden" class="form-control" id="isibs" name="isibs" >
                                    <span id="feedback"></span>
								</div>
							</div>
							<div class="form-group mb-lg">
								<div class="col-sm-1">
									&nbsp;
								</div>
								<div class="col-sm-3" style="vertical-align: middle;">
									<strong>Room</strong>
								</div>
								<div class="col-sm-8">
									<div class="input-group input-group-icon">
										<input type="text" class="form-control" id="ticketroom" name="ticketroom" placeholder="Ruang Meeting Garment 1">
									</div>
								</div>
							</div>
							<div class="form-group mb-lg">
								<div class="col-sm-1">
									&nbsp;
								</div>
								<div class="col-sm-3" style="vertical-align: middle;">
									<strong>Problem</strong>
								</div>
								<div class="col-sm-8">
									<div class="input-group input-group-icon">
										<textarea name="remark" id="remark" type="text" class="form-control" required></textarea>
									</div>
								</div>
							</div>
							<div class="form-group mb-lg">
								<div class="col-sm-1">
									&nbsp;
								</div>
								<div class="col-sm-3" style="vertical-align: middle;">
									<strong>Image Problem<br>(Optional)</strong>
								</div>
								<div class="col-sm-8">
									<div class="input-group input-group-icon">
										<input type='file' onchange="readURL(this);" id="imgprob" name="imgprob"/>
    									<img id="blah" src="#" alt="Image type JPEG,PNG. Size Max: 2MB" />
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6" align="center">
								<h1 class="title text-uppercase text-weight-bold m-none">IT Ticketing</h1>
						</div>
						
						<div class="col-sm-6" align="center" style="margin-top:2%;">
							
							<div class="row" style="margin-bottom: 1%">
								<a href="index.php?x=view" class="btn btn-primary hidden-xs btn-sm" style="padding: 3%;width: 30%;font-size:11px"><b>View Ticket</b></a>
								<a href="index.php?x=view" class="btn btn-primary btn-block btn-lg visible-xs mt-lg btn-sm" style="padding: 3%">View Request</a>
								
							</div>
							<div class="row" style="margin-bottom: 1%">
								<a href="index.php?x=tips" class="btn btn-success hidden-xs btn-sm" style="padding: 1%;width: 25%;border-radius: 34px;background-color: #DC143C;font-size:11px">Tips & Tricks</a>
								<a href="index.php?x=tips" class="btn btn-primary btn-block btn-lg visible-xs mt-lg btn-sm" style="padding: 3%">Tips & Tricks</a>
							</div>
							
							<div class="form-group" style="font-size: 11px;max-width: 80%;" >
									<?php foreach($con->select("assets a join people b on a.userid=b.id left join clients c on a.clientid=c.id
										left join assetcategories d on a.categoryid=d.id
										","a.id idaset,a.serial,a.tag,a.clientid as iditassets,b.name as nama_user,b.email,c.name as nama_dept,a.nodenumber,d.name as typecategory,a.categoryid","ipaddress like '$ipaddress'") as $yourdvc){} 

										if($yourdvc['categoryid']<>''){$dvctype=$yourdvc['typecategory'];}else {$dvctype="Tidak Terdaftar";} 
										if($yourdvc['nama_user']<>''){$dvcuser=$yourdvc['nama_user'];}else {$dvcuser="Tidak Terdaftar";}
										if($yourdvc['nama_dept']<>''){$dvcdept2=$yourdvc['nama_dept'];}else {$dvcdept2="Tidak Terdaftar";}
										if($yourdvc['nodenumber']<>''){$dvcdept3=$yourdvc['nodenumber'];}else {$dvcdept3="Tidak Terdaftar";}
									?>
									<table class="table" >
										<tr>
											<td colspan="2" align="center"> Your Device Info </td>
											<td colspan="2" ><?= UserInfo::get_device();?></td>
										</tr>
										<tr>
											<td width="20%">Dept</td>
											<td width="30%"><?=$dvcdept2;?></td>
											<td width="15%">Type</td>
											<td width="35%"><?=$dvctype;?></td>
										</tr>
										<tr>
											<td>User</td>
											<td><?=$dvcuser;?></td>
											<td>IPAddr</td>
											<td><?=$ipaddress;?></td>
										</tr>
										<tr>
											<td>Asset ID</td>
											<td><b><?=$dvcdept3;?></b></td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
										</tr>
									</table>
																			
								</div>
						</div>

					</div>
							<div class="row" >
								<div class="col-sm-4" align="right">
									<input type="hidden" name="statuspost" id="statuspost" value="1">
									<button type="submit" class="btn btn-warning hidden-xs btn-sm">Submit</button>
									<button type="submit" class="btn btn-warning btn-block btn-lg visible-xs mt-lg btn-sm">Submit</button>
									<a href="index.php" class="btn btn-default">Reset</a>
								</div>
								
							</div>
					<?php } ?>
							

							

							<!-- <div class="mb-xs text-center">
								<a class="btn btn-facebook mb-md ml-xs mr-xs">Connect with <i class="fa fa-facebook"></i></a>
								<a class="btn btn-twitter mb-md ml-xs mr-xs">Connect with <i class="fa fa-twitter"></i></a>
							</div>

							<p class="text-center">Don't have an account yet? <a href="pages-signup.html">Sign Up!</a>
 -->
		
					</div>
				</div>
		</form>
				<p class="text-center text-muted mt-md mb-md">&copy; Copyright ITD Eratex Djaja Tbk 2019. All Rights Reserved.</p>
			</div>
		</section>

		<div class="modal fade" id="funModal" tabindex="-1" role="dialog" aria-labelledby="funModalLabel" aria-hidden="true">
		  <div class="modal-dialog" style="width: 70%" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="funModalLabel"><?php echo $judulmod; ?></h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		       		<div id="modalagent"> 
		                       
		            </div>    
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
		        <!-- <button type="button" class="btn btn-primary">Send message</button> -->
		      </div>
		    </div>
		  </div>
		</div>
		

		<!-- end: page -->

		<!-- Vendor -->
		<script src="assets/vendor/jquery/jquery.js"></script>
		<script src="assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="assets/vendor/bootstrap/js/bootstrap.js"></script>
		<script src="assets/vendor/nanoscroller/nanoscroller.js"></script>
		<script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="assets/vendor/magnific-popup/magnific-popup.js"></script>
		<script src="assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
        <script src="assets/vendor/jquery-autosize/jquery.autosize.js"></script>
        <script src="assets/vendor/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
        <script src="js/jsindex.js"></script>

		<!-- Specific Page Vendor -->
		<script src="assets/vendor/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
		<script src="assets/vendor/jquery-ui-touch-punch/jquery.ui.touch-punch.js"></script>
		<script src="assets/vendor/select2/select2.js"></script>
		<script src="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
		<script src="assets/vendor/jquery-maskedinput/jquery.maskedinput.js"></script>
		<script src="assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
		<script src="assets/vendor/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
		<script src="assets/vendor/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
		<script src="assets/vendor/fuelux/js/spinner.js"></script>
		<script src="assets/vendor/dropzone/dropzone.js"></script>
		<script src="assets/vendor/bootstrap-markdown/js/markdown.js"></script>
		<script src="assets/vendor/bootstrap-markdown/js/to-markdown.js"></script>
		<script src="assets/vendor/bootstrap-markdown/js/bootstrap-markdown.js"></script>
		<script src="assets/vendor/bootstrap-maxlength/bootstrap-maxlength.js"></script>
		<script src="assets/vendor/ios7-switch/ios7-switch.js"></script>
		<script src="assets/vendor/bootstrap-confirmation/bootstrap-confirmation.js"></script>
		<script src="assets/vendor/jquery-appear/jquery.appear.js"></script>
		<script type="text/javascript" src="<?php echo $data ?>"></script>
		<script src="assets/javascripts/sweetalert.min.js"></script>
		<!-- Datatables -->
		<!-- <script src="assets/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script> -->
		<script src="assets/vendor/jquery-datatables/media/js/jquery.dataTables.min.js"></script>
		<script src="assets/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js"></script>
		<script src="assets/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>

		<!-- Theme Base, Components and Settings -->
		<script src="assets/javascripts/theme.js"></script>

		<!-- Theme Custom -->
		<script src="assets/javascripts/theme.custom.js"></script>

		<!-- Theme Initialization Files -->
		<script src="assets/javascripts/theme.init.js"></script>

		<script src="assets/javascripts/jquery-ui-1.9.2.js"></script>
		<script>
			function readURL(input) {
	            if (input.files && input.files[0]) {
	                var reader = new FileReader();

	                reader.onload = function (e) {
	                    $('#blah')
	                        .attr('src', e.target.result)
	                        .width(150)
	                        .height(150);
	                };

	                reader.readAsDataURL(input.files[0]);
	            }
	        }

			function validate(email){
			//alert(email);
			$.post('validate_email.php', { email: email }, function(data){
				if (data == 1){
				$('#feedback').text('Email valid');
				$('#bs').val(data);
				$('#isibs').val(email);
				}
				else if (data == 2) {
				$('#feedback').text('Email not valid!!');
				$('#bs').val(data);
				$('#isibs').val(email);
				swal({
					  type: 'warning',
					  title: 'Email Not Valid!!',
					  text: 'Please enter your email correctly (Eratex Email)',
					  ConfirmButtonText: 'OK',
					});
				$('#report_email').val('');
				$('#report_email').focus()
				}
			});
		
		}
		
		/*$(document).ready(function(){

			$('#email').focus(function(){
		
				if($('#email').val() === ''){
					$('#feedback').text('Go on, enter a valid email address....');
				}else{
					validate($('#email').val());
				}
		
				
			}).blur(function(){
				if($('#bs').val() == 2){
				swal({
						  type: 'warning',
						  title: 'Email Not Valid!!',
						  text: 'Please enter your email correctly',
						  ConfirmButtonText: 'OK',
						})
				$('#email').val('');
				$('#email').focus()
				}
				else if ($('#bs').val() == 1){
					var str = $('#isibs').val();
					var res = str.split("@");
					if(res[1] == 'eratex.co.id'){
						$('#feedback').text('');
					} else {
						swal({
						  type: 'warning',
						  title: 'e-mail must use eratex email',
						  text: 'use your eratex email',
						  ConfirmButtonText: 'OK',
						})
					$('#email').val('');
					$('#email').focus()
					}
					
				}
			}).keyup(function(){
				validate($('#email').val());
				
			});
		
		});
		*/
		function valscript(evt) {
		  var charCode = (evt.which) ? evt.which : event.keyCode
		   if (charCode > 32 && (charCode < 44 || charCode > 57) && (charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122))
 
		    return false;
		  return true;
		}
		
		function allvalscript(evt) {
			  var charCode = (evt.which) ? evt.which : event.keyCode
			   if (charCode > 33 && (charCode < 35 || charCode > 38)&&(charCode < 40 || charCode > 64) && (charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122))
	 
			    return false;
			  return true;
		}
		
		function hanyaHuruf(evt) {
			  var charCode = (evt.which) ? evt.which : event.keyCode
			   if (charCode > 32 && (charCode < 48 || charCode > 57) && (charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122))
	 
			    return false;
			  return true;
		}

		function hanyaAngka(evt) {
			  var charCode = (evt.which) ? evt.which : event.keyCode
			   if (charCode > 31 && (charCode < 48 || charCode > 57))
	 
				return false;
			  return true;
	  	}

		<?php if($_GET[x] == 'view'){ ?>	
		(function( $ ) {

			'use strict';
			var ass = $('#isiass').val();
			var datatableInit = function() {

				var $table = $('#datatable-ajax');
				$table.dataTable({
					"processing": true,
		         	"serverSide": true,
		        	"ajax": "data.php?d="+ass,
		        	"fnRowCallback": function (nRow, aData, iDisplayIndex) {
				     var info = $(this).DataTable().page.info();
				     $("td:nth-child(1)", nRow).html(info.start + iDisplayIndex + 1);
				     return nRow;
				 	},
				 	"order": [[ 8, "desc" ]]
		        },

				);
			};
			
			$(function() {
				datatableInit();
			});

		 }).apply( this, [ jQuery ]);
		<?php } 
		if ($_GET[x] == 'tips'){
		?>
		 (function( $ ) {

			'use strict';

			var datatableInit = function() {

				var $table = $('#datatable-ajax');
				$table.dataTable({
					"processing": true,
		         	"serverSide": true,
		        	"ajax": "data2.php",
		        	"order": [[ 0, "desc" ]],
		        	"columnDefs": [
				    {
				        targets: [2,3],
				        className: 'dt-body-center'
				    }
				  ],
				  "fnRowCallback": function (nRow, aData, iDisplayIndex) {
				     var info = $(this).DataTable().page.info();
				     $("td:nth-child(1)", nRow).html(info.start + iDisplayIndex + 1);
				     return nRow;
				 }
		        },

				);
			};
			
			$(function() {
				datatableInit();
			});

		 }).apply( this, [ jQuery ]);
		<?php }
		if ($_GET[x] == 'viewnewreq'){
		?>
		 (function( $ ) {

			'use strict';
			var ass2 = $('#isiass2').val();
			var datatableInit = function() {

				var $table = $('#datatable-ajax2');
				$table.dataTable({
					"processing": true,
		         	"serverSide": true,
		        	"ajax": "data3.php?d="+ass2,
		        	"order": [[ 0, "desc" ]],
		        	"columnDefs": [
				    {
				        targets: [4,5],
				        className: 'dt-body-center'
				    }
				  ],
				  "fnRowCallback": function (nRow, aData, iDisplayIndex) {
				     var info = $(this).DataTable().page.info();
				     $("td:nth-child(1)", nRow).html(info.start + iDisplayIndex + 1);
				     return nRow;
				 }
		        },

				);
			};
			
			$(function() {
				datatableInit();
			});

		 }).apply( this, [ jQuery ]);
		<?php } ?>

		function model(id){
			$("#funModal").show();
			isix = $("#getx").val();
			pg = $("#hal").val();
			$.get('modindex.php?id='+id+"&x="+isix, function(data) {
						$('#modalagent').html(data);    
				});
		}

		function modelnewreq(id){
			$("#funModal").show();
			isix = $("#getx").val();
			pg = $("#hal").val();
			$.get('modindex4.php?id='+id+"&x="+isix, function(data) {
						$('#modalagent').html(data);    
				});
		}

		function cekaset(id){
			
			$.get( "sourcedata.php?g=1&id="+id, function( data ) {
	        // $( ".result" ).html( data );
	        var jsonData = JSON.parse(data);
	        for (var i = 0; i < jsonData.length; i++) {
	            var counter = jsonData[i];
	            $( "#detaildept" ).show();
                $(this).val(counter.serial);
                //$('#selected_id').val(ui.item.id);
		        $( "#email" ).val( counter.email );
		        $( "#depontrack" ).val( counter.iditassets );
		        $( "#categoryid" ).val( counter.categoryid );
		        $( "#user_id" ).val( counter.userid );
		        $( "#nama" ).val( counter.nama_user );
		        $( "#idasetontrack" ).val( counter.idaset );
		        $( "#email2" ).html( counter.email );
		        $( "#nama2" ).html( counter.nama_user );
		        $( "#showtype" ).html( counter.nama_category );
		        
		       	depar(counter.iditassets);	
	        }
		    });
		}
		// $(function() {  
		//     	$('#hwid').focus();
		//         $( "#hwid" ).autocomplete({
		//          	source: function(request, response) {
		// 			    $.getJSON(
		// 			        "sourcedata.php",
		// 			        { d:'1', term:request.term}, 
		// 			        response
		// 			    );
		// 			},
		//            minLength:2, 
		//            select: function (event, ui) {
		//             if (ui.item != undefined) {

		//             	//alert('as');
		//             	$( "#detaildept" ).show();
		//                 $(this).val(ui.item.value);
		//                 //$('#selected_id').val(ui.item.id);
		// 		        $( "#email" ).val( ui.item.email );
		// 		        $( "#depontrack" ).val( ui.item.dept );
		// 		        $( "#categoryid" ).val( ui.item.categoryid );
		// 		        $( "#user_id" ).val( ui.item.userid );
		// 		        $( "#nama" ).val( ui.item.nama );
		// 		        $( "#idasetontrack" ).val( ui.item.idaset );
		// 		        $( "#email2" ).html( ui.item.email );
		// 		        $( "#nama2" ).html( ui.item.nama );
		// 		        $( "#showtype" ).html( ui.item.nama_cat );
				        
		// 		       	depar(ui.item.dept);	
		// 		       	//$('#report_name').focus();
		//             	} 
		//             	return false;
	    //     		}
		//         });
		//         // $('#hwid').click({
		//         // 	$('#report_name').focus();
		//         // });
		        
		//     });

			$(function() {
		        $( ".nonogm" ).autocomplete({
		         	source: function(request, response) {
					    $.getJSON(
					        "sourcedata.php",
					        { d:'2', term:request.term}, 
					        response
					    );
					},
		           minLength:2, 
		           select: function (event, ui) {
		            	if (ui.item != undefined) {
			                $(this).val(ui.item.value);
			                document.getElementById("nogm").readOnly = true;
			                if(($('#typereq').val()==1 && $('#trep').val()==2) || $('#typereq').val()==2 || $('#typereq').val()==4){
				                $( "#namepeople" ).val( ui.item.name );
				                document.getElementById("namepeople").readOnly = true;
						        $( "#jabatan" ).val( ui.item.jabatan );
						        $( "#mobile" ).val( ui.item.mobile );
						       	$('#depnew').val(ui.item.dept).trigger('change');
					       }
					       //	$('#locationid').val(ui.item.locid).trigger('change');     
							if(($('#typereq').val()==1 && $('#trep').val()==2) || $('#typereq').val()==4){
								$('#akunygdiminta').load("sourceakunminta.php?reload=1&d="+ui.item.peopleid+"&typereq="+$('#typereq').val());}
							if($('#typereq').val()==4){	
								$('#assetlist').load("sourceassetlist.php?reload=1&pp="+ui.item.peopleid); }
							if($('#typereq').val()==2){	
								$('#assetlist2').load("sourceassetlist.php?reload=1&pp="+ui.item.peopleid); }
							if($('#typereq').val()==1){	
								$('#assetlistreplace').load("sourceassetlist.php?reload=1&pp="+ui.item.peopleid); 
								$('#detailreplace').load("sourceformdetailreplace.php?reload=1&pp="+ui.item.peopleid); }
							$( "#peopleid" ).val( ui.item.peopleid );
							$( "#approvetype" ).val( ui.item.apptype );
		            		if($('#typereq').val()==1 && ui.item.name != ''){
		            			$('#jenispermin').val(1);
		            		} else if($('#typereq').val()==4 && ui.item.name != ''){
		            			$('#jenispermin').val(4);
		            		} else if($('#typereq').val()==2 && ui.item.name != ''){
		            			$('#jenispermin').val(2);
		            		} else {
		            			$('#jenispermin').val(0);
		            		}

		            		if($( "#peopleidreference" ).val() == ui.item.peopleid) {
								alert("no pegawai master sama dengan referensi!!");
								resetgm();
							}
		            	}
		            	
		            	return false;
	        		} 
		        });
		        // $('#hwid').click({
		        // 	$('#report_name').focus();
		        // });
		        
		    });

		function depar(id) {
			$.get('sourcedept.php?id='+id, function(data) {
						expdept = data.split("_"); 
						$('#dep').val(expdept[0]);
						$('#showdep').val(expdept[1]);
						$('#showdep2').html(expdept[1]);     
			});
			
		}

		function depar2(id) {
			$.get('sourcedept.php?id='+id, function(data) {
						expdept = data.split("_"); 
						$('#depnew').val(expdept[0]);     
			});
			
		}

		$(document).ready(function(){

			$('#report_name').blur(function(){
				if ($('#report_name').val() == ''){
					swal({
						 icon: 'error',
						 title: 'Reported By Not Found',
						 text: 'Please Fill your name',
						 timer: '2000'
				  		  
					})
					.then((willOK) => {
						if (willOK) {
							$('#report_name').focus();
						}
					});		

				}
				if ($('#hwid').val() == '0'){
					swal({
						 icon: 'error',
						 title: 'Asset ID Not Found',
						 text: 'Please Fill your Asset',
						 timer: '2000'
				  		  
					})
					.then((willOK) => {
						if (willOK) {
							$(document).on('focus', '.select2', function() {
							    $(this).siblings('select').select2('open');
							})
						}
					});		

				}
			});

		});

		$(document).ready(function(){

			$('#hwid').change(function(){
				if ($('#hwid').val() == '0'){
					swal({
						 icon: 'error',
						 title: 'Asset Not Found',
						 text: 'Please Fill your asset',
						 timer: '2000'
				  		  
					})
					.then((willOK) => {
						if (willOK) {
							$('#hwid').focus();
						}
					});		

				}
				});

		});
		
		function ucode(){
		    if(event.keyCode == 13){// => Karakter enter dikenali sebagai angka 13
		       $("#remark").focus();
		    }
		}

		function ucode2(){
		    if(event.keyCode == 13){// => Karakter enter dikenali sebagai angka 13
		       alert('tes');
		       $("#report_email").focus();
		    }
		}

		function cekapp(id){
		   if(id.checked){
		   	//alert(id);
		    	// $("#tglbutuh1").prop("checked", true);
		    	// $("#tglbutuh1").prop("checked", true);
		    	document.getElementById("tglbutuh1").readOnly = true;
		    	document.getElementById("tglbutuh1").value = '';
		    	document.getElementById("tglbutuh2").readOnly = true; 
		    	document.getElementById("tglbutuh2").value = '';
		    } else {
		    	document.getElementById("tglbutuh1").readOnly = false;
		    	document.getElementById("tglbutuh2").readOnly = false; 
		    }
				   
		}

		$(document).ready(function() {
		    $('.js-example-basic-multiple').select2();
		});

		function resetnew(){
			window.location.href = "index.php";
		}

		function resetgm(){
			if(($('#trep').val() == 2 && $('#typereq').val() == 1) || $('#typereq').val() == 2 
			|| $('#typereq').val() == 4){
				$( "#nogm2" ).val('');
				$( "#namepeople" ).val('');
				$( "#jabatan" ).val('');
				$('#depnew').val('').trigger('change');   
			}
			$( "#nogm" ).val('');
			$( "#peopleid" ).val('');
			$( "#approvetype" ).val('');
            document.getElementById("namepeople").readOnly = false; 
            document.getElementById("nogm").readOnly = false;
	        $( "#jabatan2" ).val('');
	        $( "#mobile" ).val('');
	       	$('#akunygdiminta').load("sourceakunminta.php?reload=2");  
	       	$('#assetlist').load("sourceassetlist.php?reload=1");
	       	$('#jenispermin').val('');
	       	$('#assetlistreplace').load("sourceassetlist.php?reload=1");
	   		$('#detailreplace').load("sourceformdetailreplace.php");
		}

		function typerequest(id) {
			if(id == 1) {
				$('#trep').val('1').trigger('change');
				$('#permintaanakun').show();
				$('#formakunakses').show();
				$('#submitnewreq').show();
				$('#replacement').show();
				$('#penutupanakun').hide();
				$('#izinakses').hide();
				$('#formizinakses').hide();
				$('#akunygdiminta').load("sourceakunminta.php?reload=1&d="+$('#peopleid').val()+"&typereq="+$('#typereq').val());
				$('#assetlist').load("sourceassetlist.php?reload=1");
				$( "#nogm" ).val('');
				$( "#nogm2" ).val('');
				$( "#namepeople" ).val('');
	            document.getElementById("namepeople").readOnly = false; 
	            document.getElementById("nogm").readOnly = false;
		        $( "#jabatan" ).val('');
		        $( "#jabatan2" ).val('');
		        $( "#mobile" ).val('');
		       	$('#depnew').val('').trigger('change');   
		       	$('#akunygdiminta').load("sourceakunminta.php?reload=2");  
		       	$('#jenispermin').val('');
		       	$('#nogmreplacement3').hide();
		       	$('#nogmreplacement3').load("sourceformnogm3.php?typereq="+$('#typereq').val());
		       	$('#detailreplace2').hide();
		        $('#detailreplace2').load("sourceformdetailreplace2.php");
		       	freplace(1);
			} else if(id == 4) {
				$('#penutupanakun').show();
				$('#formakunakses').show();
				$('#submitnewreq').show();
				$('#replacement').hide();
				$('#permintaanakun').hide();
				$('#izinakses').hide();
				$('#formizinakses').hide();
				$('#akunygdiminta').load("sourceakunminta.php?reload=2");
				$('#assetlist').load("sourceassetlist.php?reload=1");
				$( "#nogm" ).val('');
				$( "#nogm2" ).val('');
				$( "#namepeople" ).val('');
	            document.getElementById("namepeople").readOnly = false; 
	            document.getElementById("nogm").readOnly = false;
		        $( "#jabatan" ).val('');
		        $( "#jabatan2" ).val('');
		        $( "#mobile" ).val('');
		       	$('#depnew').val('').trigger('change');     
		       	$('#jenispermin').val('');
		        $('#nogmreplacement3').show();
		        $('#nogmreplacement3').load("sourceformnogm3.php?typereq="+$('#typereq').val());
		        $('#detailreplace2').show();
		        $('#detailreplace2').load("sourceformdetailreplace2.php");
		       	freplace(2);
		       		swal({
					  type: 'info',
					  title: 'Penutupan Akun',
					  text: '- Penutupan akun digunakan untuk melakukan penutupan pada akun user yang sudah tidak digunakan lagi atau sudah tidak bekerja di PT. Eratex Djaja, Tbk.\n - Digantikan oleh : dapat di isi oleh user yang sudah terdaftar sebagai pengganti dari user yang telah di tutup.',
					  ConfirmButtonText: 'OK',
					});
			} else if(id == 2) {
				$('#izinakses').show();
				$('#penutupanakun').hide();
				$('#formakunakses').hide();
				$('#replacement').hide();
				$('#submitnewreq').show();
				$('#formizinakses').show();
				$('#permintaanakun').hide();
				$('#assetlist').load("sourceassetlist.php?reload=1");
				$( "#nogm" ).val('');
				//$( "#nogm2" ).val('');
				$( "#namepeople" ).val('');
	            document.getElementById("namepeople").readOnly = false; 
	            document.getElementById("nogm").readOnly = false;
		        $( "#jabatan" ).val('');
		        $( "#jabatan2" ).val('');
		        $( "#mobile" ).val('');
		       	$('#depnew').val('').trigger('change');   
		       	$('#akunygdiminta').load("sourceakunminta.php?reload=2");  
		       	$('#jenispermin').val('');
		       	// $('#nogmreplacement3').hide();
		       	// $('#nogmreplacement3').load("sourceformnogm3.php");
		       	// $('#detailreplace2').hide();
		        // $('#detailreplace2').load("sourceformdetailreplace2.php");
		       	freplace(2);
			} else {
				$('#permintaanakun').hide();
				$('#penutupanakun').hide();
				$('#submitnewreq').hide();
				$('#formakunakses').hide();
				$('#izinakses').hide();
				$('#replacement').hide();
				$('#formizinakses').hide();
				$( "#nogm" ).val('');
				$( "#nogm2" ).val('');
				$( "#namepeople" ).val('');
	            document.getElementById("namepeople").readOnly = false; 
	            document.getElementById("nogm").readOnly = false;
		        $( "#jabatan" ).val('');
		        $( "#jabatan2" ).val('');
		        $( "#mobile" ).val('');
		       	$('#depnew').val('').trigger('change');   
		       	$('#akunygdiminta').load("sourceakunminta.php?reload=2");  
		       	$('#assetlist').load("sourceassetlist.php?reload=1");
		       	$('#jenispermin').val('');
		       	$('#nogmreplacement3').hide();
		       	$('#nogmreplacement3').load("sourceformnogm3.php?typereq="+$('#typereq').val());
		       	$('#detailreplace2').hide();
		        $('#detailreplace2').load("sourceformdetailreplace2.php");
			}
		}

		function freplace(val){
			if(val == 1){
		   		$('#nogmreplacement').load("sourceformnogm2.php?trep="+$('#trep').val()+"&typereq="+$('#typereq').val());
		   		$('#nogmreplacement2').show();
		   		$('#nogmreplacement2').load("sourceformnogm.php");
		   		$('#assetlistreplace').show();
		   		$('#assetlistreplace').load("sourceassetlist.php?reload=1");
		   		$('#detailreplace').show();
		   		$('#detailreplace').load("sourceformdetailreplace.php");
		   		resetgm(); 
		   		$( "#namepeople" ).val('');
				$( "#jabatan" ).val('');
				$('#depnew').val('').trigger('change');   
				if($('#typereq').val() == 1){
					swal({
						  type: 'info',
						  title: 'Replacement',
						  text: '- Penggantian/perpindahan Assets (pertanggungjawaban) maupun akun user dari user lama (pegawai lama) ke user baru (pegawai baru).\n - User baru secara otomatis melakukan permintaan pembuatan akun.\n - User lama secara otomatis akan dilakukan penutupan oleh system.',
						  ConfirmButtonText: 'OK',
						});
				}
		    } else {
		    	$('#nogmreplacement').load("sourceformnogm.php"); 
		    	$('#nogmreplacement2').hide();
		    	$('#nogmreplacement2').load("sourceformnogm2.php?trep="+$('#trep').val()+"&typereq="+$('#typereq').val());
		    	$('#assetlistreplace').hide();
		    	$('#assetlistreplace').load("sourceassetlist.php?reload=1");
		   		$('#detailreplace').hide();
		   		$('#detailreplace').load("sourceformdetailreplace.php");
		   		resetgm();
		   		if($('#typereq').val() == 1){
			   		swal({
						  type: 'info',
						  title: 'Not Replace',
						  text: '- Digunakan untuk permintaan asset dan/atau akun user baru (pegawai baru) atau permintaan akun untuk pegawai yang telah mempunyai akses (penambahan user akses pada aplikasi/email)',
						  ConfirmButtonText: 'OK',
						});
		   		}
		    }
		}

		function simpanfilefolder(){
			if($('#filefolder').val() == ''){
				alert("Please Fill File/Folder!!");
				$('#filefolder').focus();
			} else {
				var data = $('.form-user').serialize();
				$.ajax({
					type: 'POST',
					url:  "simpan3.php?p=filefolder",
					data: data,
					success: function() {
						$('#izinfilefolder').load("sourceizinakses.php?reload=1&ipad="+encodeURI($('#ipaddressreport').val()));
						$('#filefolder').val("");
						$('#lokasi').val("");
						$('#remarkfilefolder').val("");
						
					}
				});
			}
		}

		function delfilefolder(id){
			//alert(id);
			$.ajax({
				type: 'GET',
				url:  "simpan3.php?p=del&id="+id,
				success: function() {
					$('#izinfilefolder').load("sourceizinakses.php?reload=1&ipad="+encodeURI($('#ipaddressreport').val()));
					$('#filefolder').val("");
					$('#lokasi').val("");
					$('#remarkfilefolder').val("");
					
				}
			});
		}
	</script>

	</body>
</html>