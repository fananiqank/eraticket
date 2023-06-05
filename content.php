<?php
// $actual_link = "http://$_SERVER[HTTP_HOST]/";
// $eraticket ="eraticket";
// echo "$actual_link";
//error_reporting(0);

session_start();
require_once "funlibs.php";
$con=new Database();

// require_once "funlibs2.php";
// $con2=new Database2();

//echo $_SESSION['ID_ROLE'];
if(empty($_SESSION['ID_LOGIN'])){
    include"login.php";	
} else {
	include "assets/layout/page.php";	
	$selnama = $con->select("people a join clients b on a.clientid = b.id","a.*,b.name as namedept","a.id = '$_SESSION[ID_PEG]'");
	//echo "select * from mtpegawai where id_pegawai = $_SESSION[ID_PEG]";
	foreach($selnama as $nama){}
	$ahuruf=substr($_GET[p], 0,1);
?>
<!DOCTYPE html>
<html class="fixed">

	<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<title>EraTickets</title>
		<meta name="keywords" content="HTML5 Admin Template" />
		<meta name="description" content="EraTickets">
		<meta name="author" content="okler.net">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<link h
		ref="assets/stylesheets/fontstyle.css" rel="stylesheet" type="text/css">

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
		<style type="text/css">
			@media only screen and (max-width: 1030px) {
				.ft11 {
					font-size: 12px;
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
		<!-- <script type="text/javascript" src="datatables_basic.js"></script> -->
		
	</head>
	<body>
		<section class="body">

			<!-- start: header -->
			<header class="header">
				<div class="logo-container">
					<a href="content.php" class="logo">
						<img src="assets/images/logo-eratex-djaja.png" height="50" width="100%" alt="Eratex Djaja" />
					</a>
					<div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
						<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
					</div>
				</div>

				<!-- start: search & user box -->
				<div class="header-right">


					<span class="separator"></span>

					<div id="userbox" class="userbox">
						<a href="#" data-toggle="dropdown">
							<figure class="profile-picture">
								<img src="assets/images/!logged-user.jpg" alt="Joseph Doe" class="img-circle" data-lock-picture="assets/images/!logged-user.jpg" />
							</figure>
							<div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@okler.com">
								<span class="name"><?php echo $nama['name']; ?></span>
								<span class="role"><?php echo $nama['namedept']?></span>
								<span class="role"><?php echo $nama['title']?></span>
							</div>

							<i class="fa custom-caret"></i>
						</a>

						<div class="dropdown-menu">
							<ul class="list-unstyled">
								<li class="divider"></li>
								<!-- <li>
									<a role="menuitem" tabindex="-1" href="pages-user-profile.html"><i class="fa fa-user"></i> My Profile</a>
								</li> -->
								<!-- <li>
									<a role="menuitem" tabindex="-1" href="#" data-lock-screen="true"><i class="fa fa-lock"></i> Lock Screen</a>
								</li> -->
								<li>
									<a role="menuitem" tabindex="-1" href="logout.php"><i class="fa fa-power-off"></i> Logout</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- end: search & user box -->
			</header>
			<!-- end: header -->

			<div class="">
				<!-- start: sidebar -->
				<!-- <aside id="sidebar-left" class="sidebar-left">

					<div class="sidebar-header">
						<div class="sidebar-title">
							Menu
						</div>
						<div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
							<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
						</div>
					</div>

					<div class="nano">
						<div class="nano-content">
							<nav id="menu" class="nav-main" role="navigation">
								<ul class="nav nav-main">
									<?php include "assets/layout/menu.php"; ?>
									
								</ul>
						</div>

					</div>

				</aside> -->
				<!-- end: sidebar -->

				<section role="main" style="margin-top: 3%;">
					<div class="row">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
							<section class="panel">
								<div class="panel-body">
									<h4 align="center">View Request <?php echo $nama['namedept']?> Dept</h4>
									<table class="table table-bordered table-hover pre-scrollable" id="datatable-ajax">
									<thead>
										<tr>
											<th width="5%">No</th>
											<th width="12%">Type</th>
											<th width="8%">Nopeg</th>
											<th width="15%">Nama</th>
											<th width="10%">Dept</th>
											<th width="10%">Jabatan</th>
											<th width="10%">Createdate</th>
											<th width="10%">Status</th>	
											<th width="10%">Act</th>	
										</tr>
									</thead>

									<tbody style="overflow-x: auto">

										<input name="isiass2" id="isiass2" value="<?=$_GET[d]?>" type="hidden">
									</tbody>

									</table>
								</div>
							</section>
						</div>
					</div>
					<!-- end: page -->
				</section>
			</div>


		</section>

		<div class="modal fade" id="funModal3" tabindex="-1" role="dialog" aria-labelledby="funModalLabel" aria-hidden="true">
		  <div class="modal-dialog" style="width: 90%" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="funModalLabel">Approve Request</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		       		<div id="modalapprove"> 
		                       
		            </div>    
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <!-- <button type="button" class="btn btn-primary">Send message</button> -->
		      </div>
		    </div>
		  </div>
		</div>
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
        	(function( $ ) {

				'use strict';

				var datatableInit = function() {

				var $table = $('#datatable-ajax');
				$table.dataTable({
					"autoWidth": false,
			        "columnDefs": [{ 
			            orderable: false,
			            targets: [ 1 ]
			        }],
			       	
					"processing": true,
		         	"serverSide": true,
		        	"ajax": "data4.php",
		        	"fnRowCallback": function (nRow, aData, iDisplayIndex) {
						     var info = $(this).DataTable().page.info();
						     $("td:nth-child(1)", nRow).html(info.start + iDisplayIndex + 1);
						     return nRow;
						 },
					 "order": [[6, 'desc']], 
		        },

			);
				    

		    	
			};
			
			$(function() {
				datatableInit();
			});

		 }).apply( this, [ jQuery ]);

        	function showFileSize() {
			    var input, file;

			    // (Can't use `typeof FileReader === "function"` because apparently
			    // it comes back as "object" on some browsers. So just see if it's there
			    // at all.)
			    if (!window.FileReader) {
			        bodyAppend("p", "The file API isn't supported on this browser yet.");
			        return;
			    }

			    input = document.getElementById('gambar');
			    if (!input) {
			        bodyAppend("p", "Um, couldn't find the fileinput element.");
			    }
			    else if (!input.files) {
			        bodyAppend("p", "This browser doesn't seem to support the `files` property of file inputs.");
			    }
			    else if (!input.files[0]) {
			        bodyAppend("p", "Please select a file before clicking 'Load'");
			    }
			    else if (input.files[0].type != 'application/pdf' ) { 
					if (input.files[0].size > 2044070) {
						file = input.files[0];
						var ses = file.size;
						//alert(input.files[0].size);
						alert("File Terlalu Besar Max 2 MB");
						$('#gambar').val("");
			    	} 
				}
				else if (input.files[0].type == 'application/pdf' ) { 
					if (input.files[0].size > 10044070) {
						file = input.files[0];
						var ses = file.size;
						//alert(input.files[0].size);
						alert("File Terlalu Besar Max 10 MB");
						$('#file').val("");
			    	}
				}
				// else  {
			       
			 //    }

			}

			function bodyAppend(tagName, innerHTML) {
			    var elm;

			    elm = document.createElement(tagName);
			    elm.innerHTML = innerHTML;
			    document.body.appendChild(elm);
				alert(innerHTML);
			}

        	function bacaGambar(input) {
                 if (input.files && input.files[0]) {
                     var reader = new FileReader();                        
                     reader.onload = function (e) {
                           $('#gambar_nodin').attr('src', e.target.result);
                     }
                     reader.readAsDataURL(input.files[0]);
                 	}
            }
                                            
            $("#gambar").change(function(){
                 bacaGambar(this);
            });
            
            function hanyaAngka(evt) {
			  var charCode = (evt.which) ? evt.which : event.keyCode
			   if (charCode > 31 && (charCode < 48 || charCode > 57))
	 
				return false;
			  return true;
	  		}
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
			
			function model3(id,typereq,idizin){
				$("#funModal3").show();
				isix = $("#getx").val();
				pg = $("#hal").val();
				$.get('modindex3.php?id='+id+"&type="+typereq+"&idizin="+idizin, function(data) {
							$('#modalapprove').html(data);    
					});
			}
			
        </script>
	</body>
</html>
<?php } ?>