<?php
session_start();
require_once("funlibs.php");
$con=new Database();

if ($_GET['d'] == 1){
    $term = trim(strip_tags($_GET['term'])); 
    $dat=$con->select("assets a join people b on a.userid=b.id join assetcategories c on a.categoryid=c.id","a.id as idaset,a.nodenumber as serial,a.tag,a.clientid as iditassets,b.name as nama_user,b.email,c.name as nama_category,a.categoryid,a.userid","a.nodenumber like '%$term%' and b.statusid != 'Nonactive'");
     // echo "select id,serial,tag,clientid,b.name as nama_user from assets a join people b on a.userid=b.id where serial like '%$term%'";
    foreach($dat as $row)
    {
    	//$row=htmlentities(stripslashes($row['account']." - ".$row['description']));
    	
        // $row_set[] = array("nama_pegawai" => $row[nama_pegawai],
    				// 	   "email" => $row[email],
    				// );
        $row['value']=htmlentities(stripslashes($row['serial']));
        $row['id']=(int)$row['email'];
        $row['dept']=$row['iditassets'];
        $row['nama']=$row['nama_user'];
        $row['nama_cat']=$row['nama_category'];
        $row['categoryid']=$row['categoryid'];
        $row['userid']=$row['userid'];
        $row['idaset']=$row['idaset'];

    //buat array yang nantinya akan di konversi ke json
        $row_set[] = $row;
    }
} else if ($_GET['d'] == 2){

    $term = trim(strip_tags($_GET['term'])); 
    $dat=$con->select("(select a.name,a.id,a.email,a.nogm,case when IFNULL(b.clientid,'0')<>'0' and b.created_date > IFNULL(a.modify_date,'1970-01-01 01:01:01')  then b.clientid else a.clientid end clientid,case when IFNULL(b.title,'0')<>'0' and b.created_date > IFNULL(a.modify_date,'1970-01-01 01:01:01') then b.title else a.title end as title,case when IFNULL(b.mobile,'0')<>'0' and b.created_date > IFNULL(a.modify_date,'1970-01-01 01:01:01') then b.mobile else a.mobile end as mobile,case when IFNULL(b.locationid,'0')<>'0' and b.created_date > IFNULL(a.modify_date,'1970-01-01 01:01:01') then b.locationid else a.locationid end as locationid,approval_type,c.name as clientname
from people a left join (select clientid,title,mobile,locationid,a.peopleid,a.created_date from people_dtl_request a join (select peopleid,max(id) as id from people_dtl_request GROUP BY peopleid) b on a.id=b.id) b on a.id=b.peopleid
    left join clients c on a.clientid=c.id
where a.nogm like '%$term%' OR a.name like '%$term%' OR c.name like '%$term%' and a.statusid = 'Active') a","*","");
    foreach($dat as $row)
    {
        //$row=htmlentities(stripslashes($row['account']." - ".$row['description']));
        
        // $row_set[] = array("nama_pegawai" => $row[nama_pegawai],
                    //     "email" => $row[email],
                    // );
    $row['value']=htmlentities(stripslashes($row['nogm']).'-'.$row['name'].' - ['.$row['clientname'].']');
    $row['nogmid']=htmlentities(stripslashes($row['nogm']));
    $row['email']=$row['email'];
    $row['dept']=$row['locationid'];
    $row['locid']=$row['clientid'];
    $row['nama']=$row['name'];
    $row['jabatan']=$row['title'];
    $row['mobile']=$row['mobile'];
    $row['peopleid']=$row['id'];
    $row['apptype']=$row['approval_type'];

    //buat array yang nantinya akan di konversi ke json
        $row_set[] = $row;
    }
}

if ($_GET['g'] == 1){
    //$term = trim(strip_tags($_GET['term'])); 
    $row_set=$con->select("assets a left join people b on a.userid=b.id left join assetcategories c on a.categoryid=c.id","a.id as idaset,a.nodenumber as serial,a.tag,a.clientid as iditassets,b.name as nama_user,b.email,c.name as nama_category,a.categoryid,a.userid","a.id = $_GET[id]");
     // echo "select a.id as idaset,a.nodenumber as serial,a.tag,a.clientid as iditassets,b.name as nama_user,b.email,c.name as nama_category,a.categoryid,a.userid from assets a join people b on a.userid=b.id join assetcategories c on a.categoryid=c.id where a.id = $_GET[id]";
    //foreach($dat as $row){}
}
//data hasil query yang dikirim kembali dalam format json
echo json_encode($row_set);
?>