<?php 

	$selkattopik = $con->select("mtkategoritopik","*","id_kattopik = '$_GET[d]'");
	foreach ($selkattopik as $kattopik) {}
	$selkategoriSub = $con->select("mttopik a join mtkategoritopik b on a.id_kattopik=b.id_kattopik","*","a.id_kattopik = '$_GET[sub]'");
	foreach ($selkategoriSub as $kategoriSub) {}
	
?>
			
					<!-- start: page -->
<form class="form-user" id="formku" name="formku" method="post" action="content.php?p=<?=$get?>_s" enctype="multipart/form-data">
<?php if($_GET['sub']){ ?>
	<input class="form-control" name="sub" id="sub" value="<?=$_GET[sub]?>" type="hidden" />
<?php
		if ($_GET['t'] == 'A') {
			
			$add = "Add New";
			include "input.php";
		 } else if ($_GET['d']){
		 	$add = "Edit";
			include "input.php";
		 } else
{?>

<div class="col-md-12">
	<header class="panel-heading">
		<a href="content.php?p=<?=$get?>" style="float:left"><img src="assets/images/up.png" width="13%"></a>
				<a href="content.php?p=<?=$get?>&sub=<?=$_GET['sub']?>&t=A" class="btn btn-success" style="float: right" data-toggle="confirmation"><?=$nametag?></a>
					<h2 class="panel-title">&nbsp;</h2>
		</header>
	<div class="panel-body">
		<div class="form-group">
			<table class="table table-bordered table-striped pre-scrollable" id="datatable-ajax" width="100%">
				<thead>
					<tr>
						<th width="5%">No</th>
						<th>Problem</th>
						<th width="15%">Detail</th>
						<th width="10%">Tips</th>
						<th width="5%">Action</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>	
</div>
<?php 
	}
} else { 
?>

<div class="col-md-6">
	<div class="panel-body">
		<div class="form-group">
			<label class="col-sm-3 control-label">Topic Category<span class="required">*</span></label>
			<div class="col-sm-9">
				<input type="text" name="nama" id="nama" class="form-control" value="<?=$kattopik[nama_kattopik]?>" onkeypress="return allvalscript(event)" required/>
				
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