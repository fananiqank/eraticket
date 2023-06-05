
<?php 
//error_reporting(0); 
require_once "funlibs.php";
$con = new Database;
require_once "funlibs2.php";
$con2 = new Database2;
require ('UserInfo.php');

$seldep = $con->select("mtdept","*");

if($_GET[x] == 'view'){
	$judulmod = "Request Order";
} else {
	$judulmod = "Tips & Tricks";
}
?>
<!Doctype html>
<html class="fixed">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">

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
				font-size: 16px;
				transition: width 10s, height 4s;
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
							<input type="text" style="height:38px;" name="check" id="check" class="form-control" placeholder="androidcheck">
							<div class="form-control-feedback">
								<i class="icon-user text-muted"></i>
							</div>
					</div>
					<div class="panel-body" style="background-image: linear-gradient(to bottom, rgba(0,0,0,0) 0%,rgba(0,0,0,0) 100%), url('assets/images/bgcurve3.jpg');background-position: center;">
						<a href="index.php" class="logo pull-left">
							<img src="assets/images/logo-eratex-djaja.png" height="80" width="120%" alt="Eratex Djaja" />
						</a>
						<div class="panel-title-sign mt-xl text-right">
								<?php if($_GET[x]){ ?>
								<a href="index.php" id="back">
									<img src="assets/images/go-back.png" width="2%" alt="Back" />
						      	</a> &ensp;
						      	<?php } ?>
						      	<a href="http://192.168.51.30/form-it.html" class="btn btn-primary shadowback" style="background-color: #FF4500;" target="_blank"><b>Form IT</b></a>
						      	&emsp;|&emsp;
								<a href="http://192.168.51.30/it-portal.html" class="btn btn-primary shadowback" style="background-color: #0000CD;" target="_blank"><b>Portal IT</b></a>
								&emsp;&emsp;&emsp;
								<a href="login.php" class="btn hidden-xs shadowback" style="border-color: #218CE6;"><b>Sign In</b></a>
								<a href="login.php" class="btn btn-primary btn-block btn-lg visible-xs mt-lg">Sign In</a>
							</a>
						</div>
						<p style="margin-bottom: 3%;">&nbsp;</p>
						<form action="simpan.php" method="post" id="form1" name="form1" enctype="multipart/form-data">
						<input id="getx" name="getx" value="<?=$_GET[x]?>" type="hidden">
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
								
								<table class="table table-bordered table-hover pre-scrollable" id="datatable-ajax">
								<thead>
									<tr>
										<th width="5%">No</th>
										<th width="15%">No Ticket</th>
										<th width="10%">HW ID</th>
										<th width="10%">HW User</th>
										<th width="10%">Reported by</th>
										<th width="15%">Department</th>
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
								
								<table class="table table-bordered table-hover pre-scrollable" id="datatable-ajax">
								<thead>
									<tr>
										<th style="text-align: center;" width="5%">No</th>
										<th style="text-align: center;">Problem</th>
										<th style="text-align: center;" width="35%">Detail</th>
									</tr>
								</thead>
								
								<tbody style="overflow-x: auto">
								</tbody>
							
							</table>
							
					</div>
					<?php } else { ?>
					<div class="col-sm-12">
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
									<strong style="font-size: 14px;">Hardware ID</strong>
								</div>
								<div class="col-sm-8"  id="coldepas">
									<div class="input-group input-group-icon">
										<input name="hwid" id="hwid" type="text" class="form-control" required/>
									</div>
								</div>
							</div>
							<div class="form-group mb-lg">
								<div class="col-sm-1">
									&nbsp;
								</div>
								<div class="col-sm-3" style="vertical-align: middle;">
									<strong style="font-size: 14px;">Department</strong>
								</div>
								<div class="col-sm-8"  id="coldepas">
									<div class="input-group input-group-icon">
										<input type="hidden" name="dep" id="dep" class="form-control" readonly>
										<input type="text" name="showdep" id="showdep" class="form-control" readonly>
									</div>
								</div>
								
							</div>

							<div class="form-group mb-lg">
								<div class="col-sm-1">
									&nbsp;
								</div>
								<div class="col-sm-3" style="vertical-align: middle;">
									<strong style="font-size: 14px;">Email</strong>
								</div>
								<div class="col-sm-8">
									<div class="input-group input-group-icon">
										<input type="text" class="form-control" id="email" name="email" placeholder="use your eratex email" readonly required>
                                        <input type="hidden" class="form-control" id="bs" name="bs" required>
                                        <input type="hidden" class="form-control" id="isibs" name="isibs" required>
                                        <span id="feedback"></span>
									</div>
								</div>
							</div>
							<div class="form-group mb-lg">
								<div class="col-sm-1">
									&nbsp;
								</div>
								<div class="col-sm-3" style="vertical-align: middle;">
									<strong style="font-size: 14px;">User</strong>
								</div>
								<div class="col-sm-8">
									<div class="input-group input-group-icon">
										<input name="nama" id="nama" type="text" class="form-control" readonly required/>
										<input name="compid" id="compid" type="hidden" class="form-control" value="<?php echo gethostbyaddr($_SERVER['REMOTE_ADDR']); ?>" readonly/>
									</div>
								</div>
							</div>
							<div class="form-group mb-lg">
								<div class="col-sm-1">
									&nbsp;
								</div>
								<div class="col-sm-3" style="vertical-align: middle;">
									<strong style="font-size: 14px;">Reported By</strong>
								</div>
								<div class="col-sm-8">
									<div class="input-group input-group-icon">
										<input name="report_name" id="report_name" type="text" class="form-control" onkeyup="ucode()" required/>
									</div>
								</div>
							</div>
							<div class="form-group mb-lg">
								<div class="col-sm-1">
									&nbsp;
								</div>
								<div class="col-sm-3" style="vertical-align: middle;">
									<strong style="font-size: 14px;">Problem</strong>
								</div>
								<div class="col-sm-8">
									<div class="input-group input-group-icon">
										<textarea name="remark" id="remark" type="text" class="form-control" required></textarea>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6" align="center">
								<h1 class="title text-uppercase text-weight-bold m-none">IT Ticketing</h1>
						
						</div>
						<div class="col-sm-2">
							&nbsp;
						</div>

						<div class="col-sm-2" align="center" style="margin-top:5%;">
							
							<div class="row" style="margin-bottom: 5%">
								
								<a href="index.php?x=view" class="btn btn-primary hidden-xs" style="padding: 8%;width: 75%"><b>View Request</b></a>
								<a href="index.php?x=view" class="btn btn-primary btn-block btn-lg visible-xs mt-lg" style="padding: 3%">View Request</a>
							</div>
							<div class="row" style="margin-bottom: 5%">
								<a href="index.php?x=tips" class="btn btn-success hidden-xs" style="padding: 4%;width: 60%;border-radius: 34px;background-color: #DC143C;">Tips & Tricks</a>
								<a href="index.php?x=tips" class="btn btn-primary btn-block btn-lg visible-xs mt-lg" style="padding: 3%">Tips & Tricks</a>
							</div>
							
						</div>
					</div>
							<div class="row" style="padding: 3%">
								<div class="col-sm-4" align="right">
									<button type="submit" class="btn btn-warning hidden-xs">Submit</button>
									<button type="submit" class="btn btn-warning btn-block btn-lg visible-xs mt-lg">Submit</button>
									
								</div>
							</div>
					<?php } ?>
							

							

							<!-- <div class="mb-xs text-center">
								<a class="btn btn-facebook mb-md ml-xs mr-xs">Connect with <i class="fa fa-facebook"></i></a>
								<a class="btn btn-twitter mb-md ml-xs mr-xs">Connect with <i class="fa fa-twitter"></i></a>
							</div>

							<p class="text-center">Don't have an account yet? <a href="pages-signup.html">Sign Up!</a>
 -->
						</form>
					</div>
				</div>

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
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
			function validate(email){

			$.post('validate_email.php', { email: email }, function(data){
				//alert(data);
				if (data == 1){
				$('#feedback').text('Email valid');
				$('#bs').val(data);
				$('#isibs').val(email);
				}
				else if (data == 2) {
				$('#feedback').text('Email not valid!!');
				$('#bs').val(data);
				$('#isibs').val(email);
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
				 	"order": [[ 7, "desc" ]]
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
				        targets: 2,
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

		$(function() {  
		    	$('#hwid').focus();
		        $( "#hwid" ).autocomplete({
		         source: "sourcedata.php",  
		           minLength:2, 
		           select: function (event, ui) {
		            if (ui.item != undefined) {

		            	//alert('as');

		                $(this).val(ui.item.value);
		                //$('#selected_id').val(ui.item.id);
				        $( "#email" ).val( ui.item.email );
				        $( "#nama" ).val( ui.item.nama );
				       	depar(ui.item.dept);	
				       	$('#report_name').focus();
		            	} 
		            	return false;
	        		}
		        });
		        
		    });

		function depar(id) {
			$.get('sourcedept.php?id='+id, function(data) {
						expdept = data.split("_"); 
						$('#dep').val(expdept[0]);
						$('#showdep').val(expdept[1]);     
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
				});

		});

		function ucode(){
		    if(event.keyCode == 13){// => Karakter enter dikenali sebagai angka 13
		       $("#remark").focus();
		    }
		}
		</script>

	</body>
</html>