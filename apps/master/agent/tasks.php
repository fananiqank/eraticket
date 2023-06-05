<?php
include "../../../funlibs.php";
$con = new Database();
$monnow = date("m");
if ($_GET[bul] != 'A') {
	$wbul = "and MONTH(b.created_date_tasks) = '$_GET[bul]'";
} else {
	$wbul = "";
}

$seljmltop = $con->select("trtasks", "count(b.id_tasks) as jmlop", "id_agent = '$_GET[id]' and status_tasks = '1' $wbul");
foreach ($seljmltop as $jmltop) {
}
$seljmlton = $con->select("trtasks", "count(b.id_tasks) as jmlon", "id_agent = '$_GET[id]' and status_tasks = '2' $wbul");
// echo "select count(b.id_wo) as jmlon from trwo b left join trdata c on b.id_data=c.id_data where b.id_agent = '$_GET[id]' and c.status_data = '2' $wbul";
foreach ($seljmlton as $jmlton) {
}
$seljmlthl = $con->select("trtasks", "count(b.id_tasks) as jmlon", "id_agent = '$_GET[id]' and status_tasks = '3' $wbul");
foreach ($seljmlthl as $jmlthl) {
}
$seljmltcl = $con->select("trtasks", "count(b.id_tasks) as jmlon", "id_agent = '$_GET[id]' and status_tasks = '4' $wbul");
foreach ($seljmltcl as $jmltcl) {
}
?>

<ul class="simple-card-list mb-xlg">
	<li class="primary">
		<h3><?= $jmltop['jmltop'] ?></h3>
		<p>Open</p>
	</li>
	<li class="primary">
		<h3><?= $jmlton['jmlton'] ?></h3>
		<p>On Progress</p>
	</li>
	<li class="primary">
		<h3><?= $jmlthl['jmlthl'] ?></h3>
		<p>Hold</p>
	</li>
	<li class="primary">
		<h3><?= $jmltcl['jmltcl'] ?></h3>
		<p>Closed</p>
	</li>
</ul>