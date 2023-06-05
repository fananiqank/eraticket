<?php 
if($_GET[reload]){
	require_once("funlibs.php");
	$con=new Database();
}
	$nom = 0;
	$nu = 1;
	foreach($con->query("select b.id,b.machine_id,nodenumber,c.name as categoryname from people a join assets b on a.id=b.userid join assetcategories c on b.categoryid=c.id where a.id = '$_GET[pp]' and b.categoryid in (1,2,7)") as $coc){
?>
		<div class="col-sm-12" align="left">
			<input type="checkbox" value="<?=$coc[id]?>" id="idaset<?=$nu?>" name="idaset<?=$nu?>" checked onclick="return false;" />&nbsp;<?=$coc['nodenumber']." - ".$coc['categoryname']?><br>
		</div>
<?php 
	$nu ++;
	$jum = $nom + 1;
	}
?>
	<input type="hidden" value="<?=$jum?>" id="jumaset" name="jumaset" >