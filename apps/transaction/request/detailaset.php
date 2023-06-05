<?php

//echo $_SESSION['ID_PEG'];
include "../../../funlibs2.php";
$con2 = new Database2();

$userid = $mg['namaaset_data'];

$selhw = $con2->select("assets a join people b on a.userid=b.id 
LEFT JOIN licenses_assets c on a.id=c.assetid
LEFT JOIN licenses d on c.licenseid=d.id","a.id idaset,a.serial,a.tag,a.name as nama_hw,b.name as nama_user,d.name as nama_os","a.serial = '$userid'");
//echo "select a.id idaset,a.serial,a.tag,a.name as nama_hw,b.name as nama_user,b.email from assets a join people b on a.userid=b.id where serial = '$userid'";
$html = '';
foreach($selhw as $hw){
  $html .= "
             <div class='col-md-2'>Name</div>
             <div class='col-md-10'>:".$hw[nama_hw]."</div>
             ";
  $html .= "
             <div class='col-md-2'>User</div>
             <div class='col-md-10'>:".$hw[nama_user]."</div>
             ";
  $html .= " 
             <div class='col-md-2'>Tag</div>
             <div class='col-md-10'>:".$hw[tag]."</div>
             ";                                
  $html .= " 
             <div class='col-md-2'>OS</div>
             <div class='col-md-10'>:".$hw[nama_os]."</div>
             ";
}
$html .= '';

echo $html;