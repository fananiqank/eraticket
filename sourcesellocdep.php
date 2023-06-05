<?php 
if($_GET['deps']){
	require_once("funlibs.php");
	$con=new Database();
}
?>
<option value=""></option>
<option <?php if($_GET['locid'] == 1){echo "selected";}else{"";} ?> value="1">PRB</option>
<option <?php if($_GET['locid'] == 2){echo "selected";}else{"";} ?> value="2">SBY</option>
<option <?php if($_GET['locid'] == 3){echo "selected";}else{"";} ?> value="3">JKT</option>
