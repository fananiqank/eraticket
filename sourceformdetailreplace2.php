<?php 
require_once "funlibs.php";
$con = new Database();
foreach ($con->select("locations a join clients b on a.clientid=b.id","a.name as locationname, b.name as deptname","a.id = $_GET[loc]") as $nd) {}
?>
<table class="table" >
	<tr>
		<td colspan="4" align="center"> <b>Digantikan oleh</b></td>
	</tr>
	<tr>
		<td width="20%">Nama</td>
		<td width="80%"><span name="showdep2" id="showdep2"><?=$_GET['name']?></span></td>
	</tr>
	<tr>
		<td width="20%">Dept</td>
		<td width="80%"><span name="showtype" id="showtype"><?=$nd['deptname']." - ".$nd['locationname']?></span></td>
		
	</tr>

</table>