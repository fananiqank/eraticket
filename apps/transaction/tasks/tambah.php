<?php 

$seljmlwo = $con->select("trwo a join trdata b on a.id_data=b.id_data","count(a.id_wo) as jmlwo","b.status_data != 4");
foreach ($seljmlwo as $jmlwo) {}

if($_SESSION['ID_ROLE'] == 1){
	$selagent = $con->select("mtagent a join mtpegawai b on a.id_pegawai=b.id_pegawai","id_agent,nama_pegawai","id_status = 1");
} else {
	$selagent = $con->select("mtagent a join mtpegawai b on a.id_pegawai=b.id_pegawai","id_agent,nama_pegawai","id_status = 1 and a.id_agent = '$_SESSION[ID_PEG]'");
}
$selcat = $con->select("mtkategori","*","status_kategori = '1'");
//echo "Select id_agent,nama_pegawai from mtagent a join mtpegawai b on a.id_pegawai=b.id_pegawai where status_agent = 1";
	
 ?>	
<div class="form-group">
	<div class="col-md-12">
			<div class="col-md-6" align="left">
				<a href="content.php?p=ta2" id="back">
					<img src="assets/images/go-back.png" width="8%" alt="Back" />
		       	</a> &ensp;
		   	</div>
			<div class="col-md-6" align="right">
				<h3 <?php echo $color; ?>><b>New Tasks</b><br>
					<h5><?php echo $isijam ?></h5>
				</h3>
			</div>
	</div>
</div>
<hr>
<div class="col-md-12">&nbsp;</div>
<div class="form-group">
		<label class="col-md-2 control-label" for="profileLastName"><b>Name</b></label>
		<div class="col-md-3">
			<input type="text" name="nama" id="nama" class="form-control" >
		</div>
		<label class="col-md-2 control-label" for="profileLastName"><b>Priority</b></label>
		<div class="col-md-3">
		<select data-plugin-selectTwo class="form-control populate" name="priority" placeholder="None Selected" id="priority">
				<option value=""></option>
				<?php 
					
					  // $selwoag = $con->select("trwo a join trdata b on a.id_data=b.id_data","count(a.id_wo) as jmlwoag","a.id_agent = '$age[id_agent]' and b.status_data != 4");
					  // foreach ($selwoag as $woag) {}
					  // 	if ($woag['jmlwoag'] > 0){
					  // 		$persen1 = (($woag['jmlwoag']/$jmlwo['jmlwo'])*100);
					  // 		$persen = number_format($persen1);

					  // 	} else {
					  // 		$persen = '0';
					  // 	}
				?>
				<option value="1">Low</option>
				<option value="2">Medium</option>
				<option value="3">High</option>
			</select>
		</div>
</div>
<div class="form-group">
		<label class="col-md-2 control-label" for="profileLastName"><b>Assign to</b></label>
		<div class="col-md-3">
		<select data-plugin-selectTwo class="form-control populate" name="assign" placeholder="None Selected" id="assign">
				<option value=""></option>
				<?php 
					  foreach ($selagent as $age) { 
					  if($data[id_agent] == $age[id_agent]){
					  	$s="selected";
					  } else{
					  	$s="";
					  }
					  // $selwoag = $con->select("trwo a join trdata b on a.id_data=b.id_data","count(a.id_wo) as jmlwoag","a.id_agent = '$age[id_agent]' and b.status_data != 4");
					  // foreach ($selwoag as $woag) {}
					  // 	if ($woag['jmlwoag'] > 0){
					  // 		$persen1 = (($woag['jmlwoag']/$jmlwo['jmlwo'])*100);
					  // 		$persen = number_format($persen1);

					  // 	} else {
					  // 		$persen = '0';
					  // 	}
				?>
					<option value="<?=$age[id_agent]?>" <?=$s?>><?=$age['nama_pegawai']?></option>
				<?php } ?>
			</select>
		</div>
        <label class="col-md-2 control-label" for="profileLastName"><b>Category</b></label>
		<div class="col-md-3">
		<select data-plugin-selectTwo class="form-control populate"  placeholder="None Selected" name="kategori" id="kategori">
				<option value=""></option>
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
<div class="form-group" style="border-top: medium;">
		<label class="col-md-2 control-label" for="profileLastName"><b>Start Date</b></label>
		<div class="col-md-3">
			<input type="text" id="start_date" name="start_date" data-plugin-datepicker class="form-control">
		</div>
        <label class="col-md-2 control-label" for="profileLastName"><b>Estimate End Date</b></label>
		<div class="col-md-3">
			<input type="text" id="end_date" name="end_date" data-plugin-datepicker class="form-control">
		</div>
</div>
<hr>
<div class="form-group" style="border-top: medium;">
		<label class="col-md-2 control-label" for="profileAddress"><b>Tasks</b></label>
		<div class="col-md-10" >
			<textarea class="summernote" data-plugin-summernote data-plugin-options='{ "height": 300, "codemirror": { "theme": "ambiance" } }' id="remark_tasks" name="remark_tasks" style="height: 50px;"></textarea>
		</div>
</div>
<hr>

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
			
			<button id="btn-simpan" class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')">
			  Submit
		    </button>
			<a href="content.php?p=ta2" id="back" class="btn btn-default">
			  Back 
		    </a>
		</div>
</div>
<div>
	<p>&nbsp;</p>
</div>
<input class="form-control" name="kode" id="kode" value="<?=$_GET[d]?>" type="hidden" />
<input class="form-control" name="getp" id="getp" value="<?=$_GET[p]?>" type="hidden" />
<input class="form-control" name="jenis" id="jenis" value="tambah" type="hidden" />