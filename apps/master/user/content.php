<?php 

	$selmg = $con->select("mauser_login a JOIN mtpegawai b on a.ID_PEGAWAI=b.id_pegawai
JOIN mtrole c on a.ID_ROLE=c.id_role","a.*,b.nama_pegawai,c.nama_role","ID = '$_GET[d]'");
	foreach ($selmg as $mg) {}

	if($_GET[d]){
		$requ = "";
	} else {
		$requ = "required";
	}

?>
			
					<!-- start: page -->
<form class="form-user" id="formku" method="post" action="content.php?p=<?=$get?>_s" enctype="multipart/form-data">

<div class="col-md-6">
	<div class="panel-body">
		<div class="form-group">
			<label class="col-sm-3 control-label">Pegawai<span class="required">*</span></label>
			<div class="col-sm-9">
				<select data-plugin-selectTwo class="form-control populate"  placeholder="None Selected" name="pegawai" id="pegawai" required>
					<option value=""></option>
					<?php 
					if($_GET[d]){
						$selpeg = $con->select("mtpegawai","id_pegawai,nama_pegawai","id_status=1 and id_pegawai = $mg[ID_PEGAWAI]");
					} else{
						$selpeg = $con->select("mtpegawai","id_pegawai,nama_pegawai","id_status=1 and id_pegawai NOT IN (select ID_PEGAWAI from mauser_login where STATUS = 1)");
					}
						foreach ($selpeg as $peg) { 
						  if($mg['ID_PEGAWAI'] == $peg['id_pegawai']){
						  	$s="selected";
						  } else{
						  	$s="";
						  }

					?>
						<option value="<?=$peg[id_pegawai]?>" <?=$s?>><?=$peg['nama_pegawai']?></option>
					<?php } ?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Role<span class="required">*</span></label>
			<div class="col-sm-9">
				<select data-plugin-selectTwo class="form-control populate"  placeholder="None Selected" name="role" id="role" required>
					<option value=""></option>
					<?php 
						$selrole = $con->select("mtrole","id_role,nama_role","id_role != 3");
						foreach ($selrole as $role) { 
						  if($mg['ID_ROLE'] == $role['id_role']){
						  	$s="selected";
						  } else{
						  	$s="";
						  }
					?>
						<option value="<?=$role[id_role]?>" <?=$s?>><?=$role['nama_role']?></option>
					<?php } ?>
				</select>
				
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Username<span class="required">*</span></label>
			<div class="col-sm-9">
				<input type="text" name="username" id="username" class="form-control" value="<?=$mg[USERNAME]?>" onkeypress="return allvalscript(event)" required/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Password<span class="required">*</span></label>
			<div class="col-sm-9">
				<input type="password" name="password" id="password" class="form-control" <?=$requ?>/>
				
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Confirm Password<span class="required">*</span></label>
			<div class="col-sm-9">
				<input type="password" name="password2" id="password2" class="form-control" onblur="cekpas(this.value)" <?=$requ?>/>
				
			</div>
		</div>
		<?php if ($_GET[d]){ ?>
		<div class="form-group">
			<label class="col-sm-3 control-label">Active<span class="required">*</span></label>
			<div class="col-sm-9">
				<label class="switch">
  					<input type="checkbox" id="setatus" name="setatus" value="1" <?php if($mg['STATUS'] == 1){echo "checked";} ?>  /> 
  					<span class="slider round"></span>
        		</label>
			</div>
		</div>
	<?php } ?>
		<div class="form-group">
		</div> 
	</div>
	
		<div class="row">
			<div class="col-sm-9 col-sm-offset-3">
				
				<button id="btn-simpan" class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')">Submit</button>
				<?php if($_GET[d]){ ?>
				<a href="content.php?p=<?=$get?>" class="btn btn-default">Back</a>
				<?php } else { ?>
				<button type="reset" class="btn btn-default">Reset</button>
				<?php } ?>
			</div>
		</div>
</div>
<div class="col-md-6">
	<div class="panel-body">
		<div class="form-group">
			<table class="table table-bordered table-striped pre-scrollable" id="datatable-ajax" width="100%">
				<thead>
					<tr>
						<th>No</th>
						<th>Name</th>
						<th>Role</th>
						<th>Username</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>	
</div>
<input class="form-control" name="sub" id="sub" value="<?=$_GET[sub]?>" type="hidden" />
<input class="form-control" name="jenis" id="jenis" value="<?=$jenis?>" type="hidden" />
<input class="form-control" name="kode" id="kode" value="<?=$kode?>" type="hidden" />
<input class="form-control" name="peg" id="peg" value="<?=$idpegawai?>" type="hidden" />
<input class="form-control" name="getp" id="getp" value="<?=$_GET[p]?>" type="hidden" />
</form>
<!-- <?php 
if($_POST['aksi']=='hapus'){
	$data = array( 
			'STATUS' => $_POST['setatus'],
		);
		$exec= $con->update($tabel, $data,"ID = '$_POST[kode]'");
	
	echo "<script>window.location='index.php?x=cam'</script>";
}
?> -->