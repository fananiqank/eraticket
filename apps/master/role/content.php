<?php 
	$selrole = $con->select("mtrole","*","id_role = '$_GET[d]'");
	foreach ($selrole as $role) {}

?>
			
					<!-- start: page -->
<form class="form-user" id="formku" method="post" action="content.php?p=<?=$get?>_s" enctype="multipart/form-data">
<div class="col-md-6">
	<div class="panel-body">
		<div class="form-group">
			<label class="col-sm-3 control-label">Role Name<span class="required">*</span></label>
			<div class="col-sm-9">
				<input type="text" name="rolename" id="rolename" class="form-control" value="<?=$role[nama_role]?>" onkeypress="return allvalscript(event)" required/>
				
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label"> Choose role<span class="required">*</span></label>
			<div class="col-sm-9">
				<font size="2px">
			<div class="pre-scrollable">
				<table class="table" width="100%" style="height: 30px;">
					
									                       <?php
						$query2=$con->select("mamenu","*","PARENT = 0 and STATUS = 1");
						foreach($query2 as $sel2){	
					?> 
					<tr>
						<td  colspan="2" align="center"><b><?=$sel2['NAMA'];?></b>
						<input id="id_menu[]" name="id_menu[]" value="<?=$sel2[ID]?>" type="hidden"/>
						</td>
                    </tr>
					<tbody>
					<?php 
					 	$query4=$con->select("mamenu","*","PARENT != 0 and PARENT = '$sel2[ID]' and STATUS = 1","ID ASC");
						foreach($query4 as $sel4){	
				
					?>
					<tr>
						<td align="center">
                        	<input type="checkbox" class="control-primary" name="hak[]" id="hak[]" value="<?=$sel4['ID']?>"
					<?php 	
						$sat=$con->select("mtrole a JOIN mtrole_dtl b on a.id_role=b.id_role","*","a.id_role='$role[id_role]'");
						foreach($sat as $val){
				
							if($sel4['ID'] == $val['id_menu']){echo "checked";} 
					}
					?>
					>
					    </td>		
						<td><?=$sel4['NAMA'];?></td>
					</tr>
					<?php }} ?>

					</tbody>

				</table>
				</div>
			</font>
			</div>
		</div>	
		<div class="form-group">

			
        </div> 
	</div>
	<footer class="panel-footer">
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
	</footer>
</div>
<div class="col-md-6">
	<div class="panel-body">
		<div class="form-group">
			<table class="table table-bordered table-striped pre-scrollable" id="datatable-ajax" width="100%">
				<thead>
					<tr>
						<th>No</th>
						<th>Role Name</th>
						<th>Edit</th>
						
					</tr>
				</thead>
				<tbody>
					
				</tbody>
			</table>
		</div>
	</div>	
</div>
<input class="form-control" name="jenis" id="jenis" value="<?=$jenis?>" type="hidden" />
<input class="form-control" name="kode" id="kode" value="<?=$kode?>" type="hidden" />
<input class="form-control" name="peg" id="peg" value="<?=$idpegawai?>" type="hidden" />
<input class="form-control" name="getp" id="getp" value="<?=$_GET[p]?>" type="hidden" />
</form>