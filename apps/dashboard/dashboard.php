<?php 
session_start();
include "../../../funlibs.php";
$con = new Database;
?>
<h4 align="center">View Request <?php echo $nama['namedept']?> Dept</h4>
<table class="table table-bordered table-hover pre-scrollable" id="datatable-ajax2">
<thead>
	<tr>
		<th width="5%">No</th>
		<th width="12%">Type</th>
		<th width="8%">Nopeg</th>
		<th width="15%">Nama</th>
		<th width="10%">Dept</th>
		<th width="10%">Jabatan</th>
		<th width="10%">Phone</th>
		<th width="10%">Status</th>	
		<th width="10%">Act</th>	
	</tr>
</thead>

<tbody style="overflow-x: auto" id="colik">

	<input name="isiass2" id="isiass2" value="<?=$_GET[d]?>" type="hidden">
</tbody>

</table>

