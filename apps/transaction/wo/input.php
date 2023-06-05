<?php 
$selmodreq = $con->select("trwo c left join trdata a on c.id_data=a.id_data
	left join trrequest g on c.id_req =g.id_req 
	left join mtdept b on a.departemen_data=b.id_dept
	left join mtkategori d on c.id_kategori = d.id_kategori
	left join mtagent e on c.id_agent = e.id_agent
	left join mtpegawai f on e.id_pegawai = f.id_pegawai","a.*,b.nama_dept,c.note_agent,c.*,DATEDIFF(CURDATE(),c.sla_date_wo) as sla,d.nama_kategori,f.nama_pegawai,g.id_req,g.note_user","c.id_wo = '$_GET[d]'");

$seljmlwo = $con->select("trwo","count(id_wo) as jmlwo");
foreach ($seljmlwo as $jmlwo) {}

$selagent = $con->select("mtagent a join mtpegawai b on a.id_pegawai=b.id_pegawai","id_agent,nama_pegawai","id_status = 1");
$selcat = $con->select("mtkategori","*","status_kategori = '1'");
$selkattop = $con->select("mtkategoritopik","*","status_kattopik = '1' and jenis_kattopik = 2");

$selsla1= $con->select("trsla","dateupdate_sla as sla1","id_wo = '$_GET[d]' and jenis_sla = 2","id_sla ASC","1");
foreach ($selsla1 as $sla1) {}
$selsla2= $con->select("trsla","dateupdate_sla as sla2","id_wo = '$_GET[d]' and jenis_sla = 3","id_sla DESC","1");
foreach ($selsla2 as $sla2) {}
$selsla3= $con->select("trsla","dateupdate_sla as sla3","id_wo = '$_GET[d]' and jenis_sla = 2","id_sla DESC","1");
foreach ($selsla3 as $sla3) {}
//echo "Select id_agent,nama_pegawai from mtagent a join mtpegawai b on a.id_pegawai=b.id_pegawai where status_agent = 1";
foreach ($selmodreq as $mg) {}
	

	if($mg['status_data'] == '1'){
		$isijam = "<a href='javascript:void(0)' class='label label-danger'>Open</a>";
		$color = "style='color:#B22222'";
	} else if ($mg['status_data'] == '2') {
		$isijam = "<a href='javascript:void(0)' class='label label-info' style='font-size:14px;padding-bottom:4%;'>On Progress</a>";
		$color = "style='color:#20B2AA'"; 
		$history = "<a class='btn btn-info' style='margin-bottom: 2%;' data-toggle='collapse' data-target='#demo'>Remark History</a>";
	} else if ($mg['status_data'] == '3') {
		$isijam = "<a href='javascript:void(0)' class='label label-warning' style='font-size:14px;padding-bottom:4%;'>Hold</a>";
		$color = "style='color:#DAA520'";
		$history = "<a class='btn btn-warning' style='margin-bottom: 2%;' data-toggle='collapse' data-target='#demo'>Remark History</a>";
	} else if ($mg['status_data'] == '4') {
		$isijam = "<a href='javascript:void(0)' class='label label-success' style='font-size:14px;padding-bottom:4%;'>Closed</a>";
		$color = "style='color:#50C54B'";
		$history = "<a class='btn btn-success' style='margin-bottom: 2%;' data-toggle='collapse' data-target='#demo'>Remark History</a>";
	} else if ($mg['status_data'] == '0') {
		$isijam = "<a href='javascript:void(0)' class='label label-default'>Reject</a>";
		$color = "style='color:#696969'";
	} else if ($mg['status_data'] == '5') {
		$isijam = "<a href='javascript:void(0)' class='label label-info' style='color:#000000;'>Hold Request</a>";
		$color = "style='color:#20B2AA;'";
	} else if ($mg['status_data'] == '6') {
		$isijam = "<a href='javascript:void(0)' class='label label-warning' style='font-size:14px;background-color:#0000FF;padding-bottom:4%;'>Assigned</a>";
		$color = "style='color:#0000FF;'";
			$selcekfb = $con->select("trfeedback","count(id_feedback) as idf","id_wo = '$_GET[d]'");	
				foreach ($selcekfb as $cekfb) {}
				if ($cekfb['idf'] > 0) {
					$history = "<a class='btn btn-info' style='margin-bottom: 2%;' data-toggle='collapse' data-target='#demo'>Remark History</a>";
				}
		
	} 

	if ($mg['priority_wo'] == 1){
		$priok = "<a href='javascript:void(0)' class='label label-success' style='font-size:14px;'>Low</a>";
		$prio = "<a href='javascript:void(0)' class='label label-success' >Low</a>";
	} else if ($mg['priority_wo'] == 2){
		$priok = "<a href='javascript:void(0)' class='label label-warning' style='font-size:14px;'>Medium</a>";
		$prio = "<a href='javascript:void(0)' class='label label-warning' style='color:#000000'>Medium</a>";
	} else if ($mg['priority_wo'] == 3){
		$priok = "<a href='javascript:void(0)' class='label label-danger' style='font-size:14px;'>High</a>";
		$prio = "<a href='javascript:void(0)' class='label label-danger'>High</a>";
	}
 ?>	
<div class="form-group">
		<div class="col-md-12">
			<div class="col-md-6" align="left">
				<a href="content.php?p=wo2" id="back">
					<img src="assets/images/go-back.png" width="8%" alt="Back" />
		      	</a> &ensp;
			    <a href="javascript:void(0)"onClick="window.open('cetak.php?page=wo&id=<?=$_GET[d]?>')"  style="cursor:pointer">
					<img src="assets/images/print-icon.png" alt="Print PDF" width="10%" />
				</a>
	       	</div>
			<div class="col-md-6" align="right">
				<h3 <?php echo $color; ?>><b><?php echo $mg['no_ticket']?></b>
					<input id="notiket" name="notiket" value="<?=$mg['no_ticket']?>" type="" >

					<h5><?php echo $isijam ?><br>
						<?php echo $prio ?>
					</h5>
				</h3>
			</div>
		</div>

</div>
<hr>
<div class="form-group">
		<label class="col-md-2 control-label" for="profileLastName"><b>Name</b></label>
		<div class="col-md-2">
			<?php echo $mg['nama_data']?>
		</div>
		<label class="col-md-2 control-label" for="profileLastName"><b>Created Date</b></label>
		<div class="col-md-2">
			<?=date("d-m-Y H:i:s",strtotime($mg['created_date_data']));?>
		</div>
		<label class="col-md-2 control-label" for="profileLastName"><b>Assign to</b></label>
		<div class="col-md-2">
		<?php if($_SESSION['ID_ROLE'] != 2) {?>
			<div id="agentub" style="display: none">
			<select data-plugin-selectTwo class="form-control populate" name="assign" id="assign">
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
			<div id="agentubt" style="display: block">
			<a href='javascript:void(0)' class='label label-default' style="font-size:12px;" onclick="sharewo('1')"><?php echo $mg['nama_pegawai']?></a>
			</div>
		<?php } else { ?>
				<?php echo $mg['nama_pegawai']?>
		<?php } ?>
		</div>
		
</div>
<div class="form-group">
		<label class="col-md-2 control-label" for="profileLastName"><b>Department</b></label>
		<div class="col-md-2">
			<?php echo $mg['nama_dept']?>
		</div>
		<label class="col-md-2 control-label" for="profileAddress"><b>Last Update</b></label>
		<div class="col-md-2">
			<?=date("d-m-Y H:i:s",strtotime($mg['dateupdate_data']));?>
		</div>
		<label class="col-md-2 control-label" for="profileLastName"><b>Days</b></label>
		<div class="col-md-2">
			<?php 
			$hasil = $mg[sla] - 2;
				if ($hasil > 0){
				echo "<font style='font-size:14px;color:#FF0000'><b>+ $hasil days</b></font>";
			} else if ($hasil == 0){
				echo "<font style='font-size:14px;color:#0AB84D'><b>$hasil days</b></font>";
			} else if ($hasil < 0){
				echo "<font style='font-size:14px;color:#0A98B8'><b>$hasil days</b></font>";
			}
			?>
			<!-- <?php
			if ($sla1[sla1] != '' ){
			$firstonprogress = new Datetime($sla1[sla1]);
			$endhold = new Datetime($sla2[sla2]);
			$endonprogress = new Datetime($sla3[sla3]);
			$now = date('Y-m-d H:i:s');
			$closed = new Datetime($mg[closed_date_data]);
			$nowd = new Datetime($now);
			// calculates the difference between DateTime objects 
			$intervalhold = date_diff($firstonprogress, $endhold);
			$intervalprogress = date_diff($firstonprogress, $endonprogress);
			$intervalclose = date_diff($endonprogress, $closed);
			$intervalprognow = date_diff($firstonprogress, $nowd);
			// printing result in days format
			//$interval->format('%R%a days');
			$datehold = $intervalhold->format('%a');
			$dateprogress = $intervalprogress->format('%a');
			$dateprognow = $intervalprognow->format('%a');
			$dateclose = $intervalclose->format('%a');
			if($mg[closed_date_data] != ''){
				$allprog = $dateprogress+$dateclose;
				
			} else {
				$allprog = $dateprognow;
				
			}
			if($sla2[sla2] != ''){
				$dhold = $datehold;
			} else {
				$dhold = $dateprognow;
			}
			//$allprog = $dateprogress+$dateclose;
			$jml = $allprog - $datehold;
			$hasil = $jml;
			if ($hasil > 0){
				echo "<font style='font-size:14px;color:#FF0000'><b>+ $hasil days</b></font>";
			} else if ($hasil == 0){
				echo "<font style='font-size:14px;color:#0AB84D'><b>$hasil days</b></font>";
			} else if ($hasil < 0){
				echo "<font style='font-size:14px;color:#0A98B8'><b>$hasil days</b></font>";
			}
			 
		}

			?> -->
		</div>
<div class="form-group">
	
</div>
</div>
<div class="form-group">
		<label class="col-md-2 control-label" for="profileLastName"><b>Hardware ID</b></label>
		<div class="col-md-2">
			<span style="cursor:pointer" data-toggle="collapseticket" data-target="#detailasetticket"><b><?php echo $mg['namaaset_data']?></b></span>
		</div>
		<label class="col-md-2 control-label" for="profileAddress"><b>Complete On</b></label>
		<div class="col-md-2">
			<?php if($mg['closed_date_data'] != ''){ ?>
				<?=date("d-m-Y H:i:s",strtotime($mg["closed_date_data"]))?>
			<?php
				} else {echo "-";}
			?>

		</div>
		<div id="detailasetticket" class="col-md-12 collapseticket"><?php include "request/detailaset.php";?></div>
</div>
<hr>
<div class="form-group" style="border-top: medium;">
		<label class="col-md-2 control-label" for="profileAddress"><b>Problem</b></label>
		<div class="col-md-10">
			<?php echo $mg['remark_data']?>
		</div>
</div>
<div class="form-group" style="border-top: medium;">
		<label class="col-md-2 control-label" for="profileAddress"><b>Note from Approve</b></label>
		<div class="col-md-10">
			<?php echo $mg['note_agent']?>
		</div>
</div>
<hr>
<div class="form-group">
	<label class="col-md-2 control-label"><b>Status</b></label>
	<div class="col-md-3">
		<?php if($mg['status_data'] != '4'){ ?>
	<!-- 	<select data-plugin-selectTwo class="form-control populate"  placeholder="None Selected" name="status_wo" id="status_wo" onchange="stclose(this.value)"> -->
		<select data-plugin-selectTwo class="form-control populate"  placeholder="None Selected" name="status_wo" id="status_wo">
				<option value=""></option>
				<?php if ($mg['status_data'] == 6){ ?>
				<option value="6" <?php if($mg['status_data'] == 6){echo "selected";}?>>Assigned</option>
				<?php } ?>
				<option value="2" <?php if($mg['status_data'] == 2){echo "selected";}?>>On Progress</option>
				<option value="3" <?php if($mg['status_data'] == 3){echo "selected";}?>>Hold</option>
				<option value="4" <?php if($mg['status_data'] == 4){echo "selected";}?>>Closed</option>
		</select>
		<input type="hidden" name="stsla1" id="stsla1" value="<?=$mg['status_data']?>">
		<input type="hidden" name="stsla2" id="stsla2">
		<?php } else { echo $isijam; } ?>
	</div>
	
</div>
<div class="form-group">
	<label class="col-md-2 control-label"><b>Priority</b></label>
	<div class="col-md-3">
		<?php if($mg['status_data'] != '4'){ ?>
		<select data-plugin-selectTwo class="form-control populate"  placeholder="None Selected" name="priority" id="priority" >
				<option value=""></option>
				<option value="1" <?php if($mg['priority_wo'] == 1){echo "selected";}?>>Low</option>
				<option value="2" <?php if($mg['priority_wo'] == 2){echo "selected";}?>>Medium</option>
				<option value="3" <?php if($mg['priority_wo'] == 3){echo "selected";}?>>High</option>
		</select>
		<?php } else { echo $priok; } ?>
	</div>
	
</div>
<div class="form-group" style="border-top: medium;">
		<label class="col-md-2 control-label" for="profileAddress"><b>Progress</b></label>
		<div class="col-md-10">

			 <?php echo $history; ?>

			<div id="demo" class="collapse">
				<ul>
				<?php $selfb = $con->select("trfeedback","*","id_wo = '$_GET[d]'");
				
				foreach ($selfb as $fb) { ?>
					<li>
						<b><i><?=date('d-m-Y H:i:s',strtotime($fb['dateupdate_feedback']))?></i></b>
						<br>
						<?=$fb['remark_feedback']?>
					</li>	
				<?php } ?>
				
				</ul>
			</div> 
			<?php if($mg['status_data'] != '4') { ?>
			<div id="prog" style="display: block;"> 
				<textarea class="summernote" data-plugin-summernote data-plugin-options='{ "height": 300, "codemirror": { "theme": "ambiance" } }' id="remark_feedback" name="remark_feedback"></textarea>
			</div>
			<!-- <div id="topi" class="row" style="display: none;">
			<div class="col-md-12">
				<div class="form-group" style="border-top: medium;">
					<label class="col-md-2 control-label" for="profileAddress"><b>
Topic Category</b></label>
					<div class="col-md-6">
						<div id="ktp" style="display: block">
							<select data-plugin-selectTwo class="populate" style="width:70%;  border-radius:4px; -moz-border-radius:4px; height:35px;" placeholder="None Selected" name="katop" id="katop">
							<?php 
							  foreach ($selkattop as $ktp) { 
							?>
								<option value="<?=$ktp[id_kattopik]?>"><?=$ktp['nama_kattopik']?></option>
							<?php } ?>
							</select>
							<a class='btn btn-info' onclick="addcat(1)">Add</a>
							
						</div>
						<div id="addktp" style="display: none">
							<input type="text" id="addkatop" name="addkatop" style="width:70%;  border-radius:4px; -moz-border-radius:4px; height:35px;" placeholder="new Category" />
							&emsp;
							<a class='btn btn-info' onclick="addcat(2)">Exist</a>
						</div>
					</div>
					
				</div>
				<div class="form-group" style="border-top: medium;">
					<label class="col-md-2 control-label" for="profileAddress"><b>Problem</b></label>
					<div class="col-md-10">
						<textarea class="ckeditor" id="problem" name="problem"></textarea>
					</div>
				</div>
				<div class="form-group" style="border-top: medium;">
					<label class="col-md-2 control-label" for="profileAddress"><b>Analysis</b></label>
					<div class="col-md-10">
						<textarea class="ckeditor" id="analisis" name="analisis"></textarea>
					</div>
				</div>
				<div class="form-group" style="border-top: medium;">
					<label class="col-md-2 control-label" for="profileAddress"><b>Solution</b></label>
					<div class="col-md-10">
						<textarea class="ckeditor" id="solusi" name="solusi"></textarea>
					</div>
				</div>
			</div>
		</div> -->
			<?php } ?>
		</div>
</div>


<!-- <div class="form-group">
	<label class="col-md-1 control-label">Photo</label>
		<div class="col-md-4">
			<?php if(empty($_GET[d])) { ?>
			<input type="file" id="gambar" name="file_img" onchange="showFileSize(this.value)" />
			<?php }?>
			
                                            			<img  src="assets/img/pegawai/<?=$data[image]?>" width="180" height="180" id="gambar_nodin" alt="Preview_gambar" />
                                            			<input type="hidden" id="nm_gambar" name="nm_gambar" value="" />
		</div>
		<div class="col-md-2">
			&nbsp;
		</div>
		
</div> -->
<div class="form-group" align="center">
		<div class="col-md-12">
			<?php if($mg['status_data'] != '4') { ?>
			<button id="btn-simpan" class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')">
			  Submit
			</button>
			<?php } ?>
			<a href="content.php?p=wo2" id="back" class="btn btn-default">
			  Back 
			</a>
		</div>
</div>
<div>
	<p>&nbsp;</p>
</div>
<input class="form-control" name="kode" id="kode" value="<?=$_GET[d]?>" type="hidden" />
<input class="form-control" name="req" id="req" value="<?=$mg[id_req]?>" type="hidden" />
<input class="form-control" name="getp" id="getp" value="<?=$_GET[p]?>" type="hidden" />
<input class="form-control" name="jenis" id="jenis" value="edit" type="hidden" />
<input class="form-control" name="iddata" id="iddata" value="<?=$mg[id_data]?>" type="hidden" />