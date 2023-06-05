<?php 

include "../../../funlibs.php";

$con = new Database();
$selmg = $con->select("mttopik a join mtkategoritopik b on a.id_kattopik=b.id_kattopik","a.*,b.nama_kattopik","id_topik = $_GET[id]");
//echo "select a.*,b.nama_kattopik from mttopik a join mtkategoritopik b on a.id_kattopik=b.id_kattopik where id_topik = $_GET[id]";
foreach ($selmg as $mg) {}

 ?>	
<div class="form-group">
		<label class="col-md-2 control-label" for="profileLastName"><b>Category Topic</b></label>
		<div class="col-md-9">
			<?php echo $mg['nama_kattopik']?>
		</div>
		<div class="col-md-1">
			<a href="content.php?p=to1&sub=<?=$_GET[sb]?>&d=<?=$_GET[id]?>" id="edit" class="btn btn-primary">Edit</a>
		</div>
</div>
<div class="form-group">
		<label class="col-md-2 control-label" for="profileLastName"><b>Tips</b></label>
		<div class="col-md-2">
			<?php if($mg['tips'] == 1){
				echo "Yes";
			} else {
				echo "No";
			}
			?>
		</div>
</div>
<hr>
<div class="form-group" style="border-top: medium;">
		<label class="col-md-2 control-label" for="profileAddress"><b>Problem</b></label>
		<div class="col-md-10">
			<?php echo $mg['problem']?>
		</div>
</div>

<!-- <div class="form-group" style="border-top: medium;">
		<label class="col-md-2 control-label" for="profileAddress"><b>Analisis</b></label>
		<div class="col-md-10">
			<?php echo $mg['analisis']?>
		</div>
</div> -->
<div class="form-group" style="border-top: medium;">
		<label class="col-md-2 control-label" for="profileAddress"><b>Solution</b></label>
		<div class="col-md-10 pre-scrollable">
			<?php echo $mg['solusi']?>
		</div>
</div>

<div>
	<p>&nbsp;</p>
</div>
<input class="form-control" name="kode" id="kode" value="<?=$_GET[d]?>" type="hidden" />
<input class="form-control" name="iddata" id="iddata" value="<?=$mg[id_data]?>" type="hidden" />
<input class="form-control" name="getp" id="getp" value="<?=$_GET[p]?>" type="hidden" />
<input class="form-control" name="jenis" id="jenis" value="edit" type="hidden" />