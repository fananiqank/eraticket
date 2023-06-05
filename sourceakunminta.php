<?php 
if($_GET[reload]){
	require_once("funlibs.php");
	$con=new Database();
	
	if($_GET['typereq'] != 4){$checked = "checked onclick='return false;' disabled";}else{$checked = "";}

	foreach($con->select("people","*","id = '$_GET[d]'") as $su){}
	$expakas = explode(';',$su['akunakses']);
	$jml = count($expakas);
	$nu = 1;
	foreach($expakas as $key => $value){

		foreach($con->query("select idakunminta,namaakunminta from akunminta where idakunminta = $value") as $coc){}
			if($coc[idakunminta] != ''){
	?>
		<div class="col-sm-6" align="left">
			<input type="checkbox" value="<?=$coc[idakunminta]?>" id="akun<?=$nu?>" name="akun<?=$nu?>" <?=$checked?>>&nbsp;<?=$coc['namaakunminta']?><br>
		</div>
	<?php 
			}
	$vm[].=$value;
	$nu ++;
	}
	$ck = implode(',',$vm);
	if($_GET[typereq] != 4){	
		if($ck != ''){$ckmin = "idakunminta not in ($ck)";}else{$ckmin = "statusakunminta = 1";}
		$na = 1;
		foreach($con->query("select idakunminta,namaakunminta from akunminta where $ckmin") as $coc2){
	?>
			<div class="col-sm-6" align="left">
				<input type="checkbox" value="<?=$coc2[idakunminta]?>" id="akun<?=$na?>" name="akun<?=$na?>">&nbsp;<?=$coc2['namaakunminta']?><br>
			</div>

<?php 	
	$na ++;
		}
	}
		

} else{
	foreach($con->query("select idakunminta,namaakunminta from akunminta where statusakunminta = 1") as $coc3){
	?>
		<div class="col-sm-6" align="left">
			<input type="checkbox" value="<?=$coc3[idakunminta]?>" id="akun<?=$coc3[idakunminta]?>" name="akun<?=$coc3[idakunminta]?>">&nbsp;<?=$coc3['namaakunminta']?><br>
		</div>

<?php
		}
}
?>