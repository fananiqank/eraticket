<?php 
if($_GET['deps']){
	require_once("funlibs.php");
	$con=new Database();
}
?>
<option value=""></option>
<?php 
$depts=$con->select("clients a left join locations b on a.id=b.clientid","a.id,b.id as locationid,a.name,b.name as locationname");
foreach ($depts as $dep) { 
	if($dep['locationid'] == $_GET['deps']){$s = 'selected';}else{$s='';}
	echo "<option value='$dep[locationid]' $s>$dep[name] - $dep[locationname]</option>";
}
?> 