
<?php 
	$selktopik = $con->select("mtkategoritopik","nama_kattopik,jenis_kattopik","id_kattopik = '$_GET[sub]'"); 
	foreach ($selktopik as $ktopik) {}
	$seltopik = $con->select("mttopik","*","id_topik = '$_GET[d]'"); 
	foreach ($seltopik as $topik) {}
?>	
<div class="form-group">
		<div class="col-md-12">
			<div class="col-md-6" align="left">
				<a href="content.php?p=to1&sub=<?=$_GET[sub]?>" id="back">
					<img src="assets/images/go-back.png" width="8%" alt="Back" />
		      	</a> &ensp;
			    <!-- <a href="javascript:void(0)"onClick="window.open('cetak.php?page=wo&id=<?=$_GET[d]?>')"  style="cursor:pointer">
					<img src="assets/images/print-icon.png" alt="Print PDF" width="10%" />
				</a> -->
	    	</div>
	    	<div class="col-md-6" align="right">
				<h3><b><?=$add?> FAQ</b><br>
					<h5><?php echo $isijam ?><br>
						<?php echo $prio ?>
					</h5>
				</h3>
			</div>
		</div>
</div>
<div class="form-group" style="border-top: medium;">
	<label class="col-md-2 control-label" for="profileAddress"><b>Category</b></label>
	<div class="col-md-6">
		<?=$ktopik['nama_kattopik'];?>
	</div>
	<label class="col-md-1 control-label" for="profileAddress"><b>Tips</b></label>
	<div class="col-md-3">
		<label class="switch">
  			<input type="checkbox" id="tips" name="tips" onclick="coba(this.value)" value="1" <?php if($topik['tips'] == 1){echo "checked";} ?>  /> 
  				<span class="slider round"></span>
        </label>
        (Click)
	</div>
</div>

<hr>
 <div class="form-group" style="border-top: medium;">
	
</div>
<div class="form-group" style="border-top: medium;">
	<label class="col-md-2 control-label" for="profileAddress"><b>Problem</b></label>
	<div class="col-md-10">
		<textarea class="summernote" data-plugin-summernote data-plugin-options='{ "height": 300, "codemirror": { "theme": "ambiance" } }' id="problem" name="problem"><?php
  if($topik['problem']) echo $topik['problem'];?></textarea>
	</div>
</div>
<!-- <div class="form-group" style="border-top: medium;">
	<label class="col-md-2 control-label" for="profileAddress"><b>Analysis</b></label>
	<div class="col-md-10">
		<textarea class="ckeditor" id="analisis" name="analisis"><?=$topik['analisis']?></textarea>
	</div>
</div> -->
<div class="form-group" style="border-top: medium;">
	<label class="col-md-2 control-label" for="profileAddress"><b>Solution</b></label>
	<div class="col-md-10">
		<textarea class="summernote" data-plugin-summernote data-plugin-options='{ "height": 300, "codemirror": { "theme": "ambiance" } }' id="solusi" name="solusi"><?=$topik['solusi']?></textarea>
	</div>
</div>
		
<div class="form-group" align="center">
		<div class="col-md-12">
			<?php if($mg['status_data'] != '4') { ?>
			<button id="btn-simpan" class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')">
			  Submit
			</button>
			<?php } ?>
			<a href="content.php?p=to2&sub=<?=$_GET[sub]?>" id="back" class="btn btn-default">
			  Back 
			</a>
		</div>
</div>
<div>
	<p>&nbsp;</p>
</div>