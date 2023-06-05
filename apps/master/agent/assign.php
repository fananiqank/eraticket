<?php 
//echo $_GET[id];
include "../../../funlibs.php";
$con = new Database();
$monnow = date("m");
if($_GET[id]) {
	if ($_GET[bul] != 'A'){
		$wbul = "and MONTH(b.created_date_wo) = '$_GET[bul]'";
	}else {
		$wbul = "";
	}
} else {
	$wbul="";
}
$seljmlon = $con->select("trwo b left join trdata c on b.id_data=c.id_data","count(b.id_wo) as jmlon","b.id_agent = '$_GET[id]' and c.status_data = '2' $wbul");
 // echo "select count(b.id_wo) as jmlon from trwo b left join trdata c on b.id_data=c.id_data where b.id_agent = '$_GET[id]' and c.status_data = '2' $wbul";
foreach ($seljmlon as $jmlon) {}
$seljmlhl = $con->select("trwo b left join trdata c on b.id_data=c.id_data","count(b.id_wo) as jmlhl","b.id_agent = '$_GET[id]' and c.status_data = '3' $wbul");
foreach ($seljmlhl as $jmlhl) {}
$seljmlcl = $con->select("trwo b left join trdata c on b.id_data=c.id_data","count(b.id_wo) as jmlcl","b.id_agent = '$_GET[id]' and c.status_data = '2' $wbul");
foreach ($seljmlcl as $jmlcl) {}
?>
<ul class="simple-card-list mb-xlg">
	<li class="primary">
		<h3><?=$jmlon['jmlon']?></h3>
		<p>On Progress</p>
	</li>
	<li class="primary">
		<h3><?=$jmlhl['jmlhl']?></h3>
		<p>Hold</p>
	</li>
	<li class="primary">
		<h3><?=$jmlcl['jmlcl']?></h3>
		<p>Closed</p>
	</li>
</ul>