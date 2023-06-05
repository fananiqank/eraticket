<?php

$bulan_data=array("Januari","Februari","Maret","April","Mei","Juni","Juli",
			"Agustus","September","Oktober","Nopember","Desember");

$thnsaiki=date("Y");
?>
<!-- Display Bulan -->


  <select name="bulan" id="bulan" class="select green-gradient">
			<option value="all">-all-</option>
<?php
	for($i=0;$i<count($bulan_data);$i++)
	{
		if  ((int)($_POST['bulan'])==$i+1)
		{
			?>
			<option value=<?php printf("%02d",$i+1)?> selected><?php echo $bulan_data[$i];?></option>		
			<?php
		}
		else
		{
			//default jika pertama kali loading, maka buat now
			if  ($_POST['bulan']=="")
			{ 
				if ((int)$blnsaiki==$i+1) 
				{
				?>
				<option value=<?php printf("%02d",$i+1)?> selected><?php echo $bulan_data[$i];?></option>		
				<?php
				}
				else
				{
				?>
				<option value=<?php printf("%02d",$i+1)?>><?php echo $bulan_data[$i];?></option>		
				<?php
				}
			}
			else
			{
				?>
				<option value=<?php printf("%02d",$i+1)?>><?php echo $bulan_data[$i];?></option>		
				<?php
			}
		}
	}
	?>
  </select>
  
  <!-- Display Tahun -->
  <select name="tahun" id="tahun" class="select-search" onchange="changeData(bulan.value,tahun.value)" >
  <?php
  for($j=2000;$j<=2100;$j++)
  {
	if ($_POST['tahun']==$j)
	  {
	  ?>
		<option value=<?php echo $j;?> selected><?php echo $j;?></option>
	  <?php
	  }
	else
		{
			//default jika pertama kali loading, maka buat now
			if  ($_POST['tahun']=="")
			{ 
				if ((int)$thnsaiki==$j) 
				{
				?>
				<option value=<?php echo $j;?> selected><?php echo $j;?></option>
				<?php 
				}
				else
				{
				?>
				<option value=<?php echo $j;?>><?php echo $j;?></option>
				<?php
				}
			}
			else
			{
				?>
				<option value=<?php echo $j;?>><?php echo $j;?></option>
				<?php
			}
		}
  } // end for

?>
</select>





