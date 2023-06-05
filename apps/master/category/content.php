<?php 

	$selkategori = $con->select("mtkategori","*","id_kategori = '$_GET[d]'");
	foreach ($selkategori as $kategori) {}
	$selkategoriSub = $con->select("mtkategori a join mtkategori_sub b on a.id_kategori=b.id_kategori","*","a.id_kategori = '$_GET[sub]'");
	foreach ($selkategoriSub as $kategoriSub) {}
	if ($_GET[d]){
		$isisub = $kategoriSub['nama_kategori_sub'];
	} else {
		$isisub = "";
	}
?>
			
					<!-- start: page -->
<form class="form-user" id="formku" method="post" action="content.php?p=<?=$get?>_s" enctype="multipart/form-data">
<?php if($_GET['sub']){ ?>

<div class="col-md-6">
	<div class="panel-body">
		<div class="form-group">
			<label class="col-sm-3 control-label">Category<span class="required">*</span></label>
			<div class="col-sm-9">
				<?=$kategoriSub[nama_kategori]?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Sub Category<span class="required">*</span></label>
			<div class="col-sm-9">
				<input type="text" name="nama" id="nama" class="form-control" value="<?=$isisub?>" onkeypress="return allvalscript(event)" required/>
				
			</div>
		</div>
		
		<div class="form-group">
		</div> 
	</div>
	
		<div class="row">
			<div class="col-sm-9 col-sm-offset-3">
				<a href="content.php?p=<?=$get?>"><img src="assets/images/up.png" width="10%"></a>&ensp;
				<button id="btn-simpan" class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')">Submit</button>
				<?php if($_GET[d]){ ?>
				<a href="content.php?p=<?=$get?>&sub=<?=$_GET[sub]?>" class="btn btn-default">Back</a>
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
						<th>Category</th>
						<th>Action</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>	
</div>
<input class="form-control" name="sub" id="sub" value="<?=$_GET[sub]?>" type="hidden" />
<?php } else { ?>

<div class="col-md-6">
	<div class="panel-body">
		<div class="form-group">
			<label class="col-sm-3 control-label">Name<span class="required">*</span></label>
			<div class="col-sm-9">
				<input type="text" name="nama" id="nama" class="form-control" value="<?=$kategori[nama_kategori]?>" onkeypress="return allvalscript(event)" required/>
				
			</div>
		</div>
		
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
						<th>Category</th>
						<th>Detail</th>
						<th>Action</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>	
</div>

<?php } ?>
<input class="form-control" name="jenis" id="jenis" value="<?=$jenis?>" type="hidden" />
<input class="form-control" name="kode" id="kode" value="<?=$kode?>" type="hidden" />
<input class="form-control" name="peg" id="peg" value="<?=$idpegawai?>" type="hidden" />
<input class="form-control" name="getp" id="getp" value="<?=$_GET[p]?>" type="hidden" />
</form>