<?php 
$selmodreq = $con->select("trtasks a
left join mtkategori d on a.id_kategori = d.id_kategori
left join mtagent e on a.id_agent = e.id_agent
left join mtpegawai f on e.id_pegawai = f.id_pegawai","a.*,DATEDIFF(CURDATE(),a.end_date_tasks) as overdue,d.nama_kategori,f.nama_pegawai","a.id_tasks = '$_GET[d]'");

$selagent = $con->select("mtagent a join mtpegawai b on a.id_pegawai=b.id_pegawai","id_agent,nama_pegawai","id_status = 1");
$selcat = $con->select("mtkategori","*","status_kategori = '1'");
//echo "Select id_agent,nama_pegawai from mtagent a join mtpegawai b on a.id_pegawai=b.id_pegawai where status_agent = 1";
foreach ($selmodreq as $mg) {}

	if($mg['status_tasks'] == '1'){
		$isijam = "<a href='javascript:void(0)' class='label label-danger'>Open</a>";
		$color = "style='color:#B22222'";
	} else if ($mg['status_tasks'] == '2') {
		$isijam = "<a href='javascript:void(0)' class='label label-info' style='font-size:14px;padding-bottom:4%;'>On Progress</a>";
		$color = "style='color:#20B2AA'"; 
		$history = "<a class='btn btn-info' style='margin-bottom: 2%;' data-toggle='collapse' data-target='#demo'>Remark History</a>";
	} else if ($mg['status_tasks'] == '3') {
		$isijam = "<a href='javascript:void(0)' class='label label-warning' style='font-size:14px;padding-bottom:4%;'>Hold WO</a>";
		$color = "style='color:#DAA520'";
		$history = "<a class='btn btn-warning' style='margin-bottom: 2%;' data-toggle='collapse' data-target='#demo'>Remark History</a>";
	} else if ($mg['status_tasks'] == '4') {
		$isijam = "<a href='javascript:void(0)' class='label label-success' style='font-size:14px;padding-bottom:4%;'>Closed</a>";
		$color = "style='color:#90EE90'";
		$history = "<a class='btn btn-success' style='margin-bottom: 2%;' data-toggle='collapse' data-target='#demo'>Remark History</a>";
	} else if ($mg['status_tasks'] == '0') {
		$isijam = "<a href='javascript:void(0)' class='label label-default'>Reject</a>";
		$color = "style='color:#696969'";
	} else if ($mg['status_tasks'] == '5') {
		$isijam = "<a href='javascript:void(0)' class='label label-warning' style='color:#000000;'>Hold Request</a>";
		$color = "style='color:#DAA520;'";
	} 

	if ($mg['priority_tasks'] == 1){
		$prio = "<a href='javascript:void(0)' class='label label-success' >Low</a>";
	} else if ($mg['priority_tasks'] == 2){
		$prio = "<a href='javascript:void(0)' class='label label-warning' style='color:#000000'>Medium</a>";
	} else if ($mg['priority_tasks'] == 3){
		$prio = "<a href='javascript:void(0)' class='label label-danger'>High</a>";
	}

	if ($mg['end_date_tasks'] == '00-00-0000' || $mg['end_date_tasks'] == ''){
		$enddate = "";
	} else {
		$enddate = date("m/d/Y",strtotime($mg[end_date_tasks]));
	}

	if ($mg['start_date_tasks'] == '00-00-0000' || $mg['start_date_tasks'] == ''){
		$startdate = "";
	} else {
		$startdate = date("m/d/Y",strtotime($mg[start_date_tasks]));
	}
 ?>	
<div class="form-group">
		<div class="col-md-12">
			<div class="col-md-6" align="left">
				<a href="content.php?p=ta2" id="back">
					<img src="assets/images/go-back.png" width="8%" alt="Back" />
				</a> &ensp;
				<a href="javascript:void(0)"onClick="window.open('cetak.php?page=tasks&id=<?=$_GET[d]?>')"  style="cursor:pointer">
					<img src="assets/images/print-icon.png" alt="Print PDF" />
				</a>
			</div>
			<div class="col-md-6" align="right">
				<h3 <?php echo $color; ?>><b><?php echo $mg['no_tasks']?></b><br>
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
		<div class="col-md-3">
			<?php echo $mg['nama_tasks']?>
		</div>
		<label class="col-md-2 control-label" for="profileLastName"><b>Start Date</b></label>
		<div class="col-md-3">
			<?php 
			if ($mg['start_date_tasks'] == '00-00-0000' || $mg['start_date_tasks'] == ''){
				echo "-";
			} else {
				echo date("d-m-Y",strtotime($mg['start_date_tasks']));
			}
			?>
		</div>
		
</div>
<div class="form-group">
		<label class="col-md-2 control-label" for="profileLastName"><b>Agent</b></label>
		<div class="col-md-3">
			<?php echo $mg['nama_pegawai']?>
		</div>
		<label class="col-md-2 control-label" for="profileAddress"><b>Estimate End Date</b></label>
		<div class="col-md-3">
			<?php 
			if ($mg['end_date_tasks'] == '00-00-0000' || $mg['end_date_tasks'] == ''){
				echo "-";
			} else {
				echo date("d-m-Y",strtotime($mg['end_date_tasks']));
			}?>
		</div>
		<div class="form-group">
	
</div>
</div>
<div class="form-group">
		<label class="col-md-2 control-label" for="profileAddress"><b>Complete On</b></label>
		<div class="col-md-3">
			<?php if($mg['closed_date_data'] != ''){ ?>
				<?=date("d-m-Y H:i:s",strtotime($mg["closed_date_tasks"]))?>
			<?php
				} else {echo "-";}
			?>
		</div>
		<label class="col-md-2 control-label" for="profileLastName"><b>Over Due</b></label>
		<div class="col-md-3">
			<?php 
			if ($mg['status_tasks'] != 1) {
				if ($mg['overdue'] > 0){
					echo "<font style='font-size:14px;color:#FF0000'><b>+ $mg[overdue] days</b></font>";
				} else if ($mg['overdue'] == 0){
					echo "<font style='font-size:14px;color:#0AB84D'><b>$mg[overdue] days</b></font>";
				} else if ($mg['overdue'] < 0){
					echo "<font style='font-size:14px;color:#0A98B8'><b>$mg[overdue] days</b></font>";
				}
			} else {
				echo "-";
			}
			?>
		</div>
</div>
<hr>
<div class="form-group" style="border-top: medium;">
		<label class="col-md-2 control-label" for="profileAddress"><b>Tasks</b></label>
		<div class="col-md-10">
			<?php echo $mg['remark_tasks']?>
		</div>
</div>

<hr>
<div id="startdate" class="form-group" style="border-top: medium;display: none">
	<?php if ($mg['status_tasks'] != 2) { ?>
 		<label class="col-md-2 control-label" for="profileLastName"><b>Start Date</b></label>
		<div class="col-md-3">
			<input type="text" id="start_date" name="start_date" data-plugin-datepicker class="form-control" value="<?=$startdate?>" required>
		</div>
	<?php } ?>
        <label class="col-md-2 control-label" for="profileLastName"><b>Estimate End Date</b></label>
		<div class="col-md-3">
			<input type="text" id="end_date" name="end_date" data-plugin-datepicker class="form-control" value="<?=$enddate?>" required>
		</div>
</div>

<div class="form-group">
	<label class="col-md-2 control-label"><b>Status</b></label>
	<div class="col-md-3">
		<?php if($mg['status_tasks'] != '4'){ ?>
		<select data-plugin-selectTwo class="form-control populate"  placeholder="None Selected" name="status_tasks" id="status_tasks" onchange="stubah(this.value)" >
				<option value=""></option>
				<option value="2" <?php if($mg['status_tasks'] == 2){echo "selected";}?>>On Progress</option>
				<option value="3" <?php if($mg['status_tasks'] == 3){echo "selected";}?>>Hold</option>
				<option value="4" <?php if($mg['status_tasks'] == 4){echo "selected";}?>>Closed</option>
		</select>
		<input type="hidden" id="stopen" name="stopen" value="<?=$mg[status_tasks]?>" >
		<?php } else { echo $isijam; } ?>
	</div>
	
</div>
<div class="form-group">
	<label class="col-md-2 control-label"><b>Priority</b></label>
	<div class="col-md-3">
		<?php if($mg['status_tasks'] != '4'){ ?>
		<select data-plugin-selectTwo class="form-control populate"  placeholder="None Selected" name="priority" id="priority" >
				<option value=""></option>
				<option value="1" <?php if($mg['priority_tasks'] == 1){echo "selected";}?>>Low</option>
				<option value="2" <?php if($mg['priority_tasks'] == 2){echo "selected";}?>>Medium</option>
				<option value="3" <?php if($mg['priority_tasks'] == 3){echo "selected";}?>>High</option>
		</select>
		<?php } else { echo $prio; } ?>
	</div>
	
</div>
<div class="form-group" style="border-top: medium;">
		<label class="col-md-2 control-label" for="profileAddress"><b>Progress</b></label>
		<div class="col-md-10">

			 <?php echo $history; ?>

			<div id="demo" class="collapse">
				<ul>
				<?php $selfb = $con->select("trfeedback","*","id_tasks = '$_GET[d]'");
				
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
			<?php if($mg['status_tasks'] != '4') { ?>
			<textarea class="summernote" data-plugin-summernote data-plugin-options='{ "height": 300, "codemirror": { "theme": "ambiance" } }' id="remark_tasks" name="remark_tasks"></textarea>
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
			<?php if($mg['status_tasks'] != '4') { ?>
			<button id="btn-simpan" class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')">
			  Submit
			</button>
			<?php } ?>
			<a href="content.php?p=ta2" id="back" class="btn btn-default">
			  Back 
			</a>
		</div>
</div>
<div>
	<p>&nbsp;</p>
</div>
<input class="form-control" name="kode" id="kode" value="<?=$_GET[d]?>" type="hidden" />
<input class="form-control" name="iddata" id="iddata" value="<?=$mg[id_data]?>" type="hidden" />
<input class="form-control" name="getp" id="getp" value="<?=$_GET[p]?>" type="hidden" />
<input class="form-control" name="jenis" id="jenis" value="edit" type="hidden" />
