<?php

//error_reporting(0);
require( 'funlibs.php' );
//echo "bik";

$con=new Database;
// header("Content-type: application/octet-stream");
// header("Content-Disposition: attachment; filename=Ticket_Report.xls");//ganti nama sesuai keperluan
// header("Pragma: no-cache");
// header("Expires: 0");


// if($_GET['aksi']=="xls")
// {
// 	header("Content-Type: application/vnd.ms-excel");
	
// 	}


 if ($_GET['tg'] && $_GET['tg2']){
      if ($_GET['tg'] != 'A' && $_GET['tg2'] != 'A'){
      $a=explode('-',$_GET['tg']);
      $gg=$a[1]."/".$a[2]."/".$a[0];
      $jtg=$a[2]."-".$a[1]."-".$a[0];
      $b=explode("-",$_GET['tg2']);
      $wp=$b[1]."/".$b[2]."/".$b[0];
      $jtg2=$b[2]."-".$b[1]."-".$b[0];
      }
    }
?>
  <table class="tableku datatables-basic" id="datatable-ajax1" width="150%">
      <thead>
          <tr>
              <th colspan="11" style="text-align:center" ><h4>REQUEST REPORT<br />
               PERIODE <?php echo "$jtg s/d $jtg2"; ?></h4></th>
          </tr>
          <tr>
              <th width="5%">No</th>
              <th width="10%">No Ticket</th>
              <th width="10%">Name</th>
              <th width="10%">Department</th>
              <!-- <th width="10%">Asset ID</th> -->
              <th width="10%">Category</th> 
              <th width="10%">Sub_Category</th>
              <th width="5%">Created Date Request</th>
              <th width="5%">Priority</th>
              <th width="15%">Status</th> 
              <th width="20%">Problem</th>     
          </tr>
      </thead>
      
      <tbody style="overflow-x: auto">
        <?php
        if ($_GET['tg']) {
          if($_GET['c']!=''){
            $cat="and d.id_kategori = $_GET[c]";
          }else{
            $cat="";
          }

          if($_GET['s']!=''){
            $sub="and d.id_kategori_sub='$_GET[s]'";
          }else{
            $sub="";
          }

          if($_GET['y']!=''){
            $pri="and d.priority_wo='$_GET[y]'";
          }else{
            $pri="";
          }

          if($_GET['t']!=''){
            $sta="and a.status_data='$_GET[t]'";
          }else{
            $sta="";
          }

          // if($_GET['a']!=''){
          //   $ase="and a.asetid_data='$_GET[a]'";
          // }else{
          //   $ase="";
          // }

          if($_GET['tg']!= 'A' && $_GET['tg2']!= 'A'){
            $tgl="and DATE(a.created_date_data) BETWEEN '$_GET[tg]' AND '$_GET[tg2]'";
          }else{
            $tgl=""; 
          }
        } else {
          $cat = "";
          $sub = "";
          $pri = "";
          $sta = "";
          $ase = "";
          $tgl = "";
        }

            $no = 1;
            $selectall = $con->select("trrequest b left join trdata a on a.id_data=b.id_data
            left join mtdept c on a.departemen_data=c.id_dept
            left join trwo d on b.id_req=d.id_req
            left join mtkategori e on d.id_kategori=e.id_kategori
            left join mtkategori_sub f on d.id_kategori_sub=f.id_kategori_sub", 
            "a.no_ticket,a.nama_data,c.nama_dept,a.asetid_data,e.nama_kategori,f.nama_kategori_sub,a.created_date_data,
            a.status_data,d.priority_wo,a.remark_data",
            "b.id_req like '%' $cat $sub $pri $sta $tgl");
            // echo "select b.no_ticket,b.nama_data,b.asetid_data,f.nama_pegawai,d.nama_kategori,h.nama_kategori_sub,a.created_date_wo,b.created_date_data,b.closed_date
            // b.status_data,a.jenis_wo,concat((DATEDIFF(CURDATE(),a.sla_date_wo) - 2),'_',b.status_data) as stla,a.priority_wo,j.problem,j.analisis,j.solusi,
            // b.remark_data
            // from trwo a left join trdata b on a.id_data=b.id_data
            // left join trrequest g on a.id_req=g.id_req 
            // left join mtdept c on b.departemen_data=c.id_dept
            // left join mtkategori d on a.id_kategori = d.id_kategori
            // left join mtkategori_sub h on a.id_kategori_sub=h.id_kategori_sub
            // left join mtagent e on a.id_agent = e.id_agent
            // left join mtpegawai f on e.id_pegawai = f.id_pegawai
            // left join mttopik j on a.id_wo = j.id_wo
            //   where b.status_data != '' $cat $sub $pri $sta $jen $asi $ase $tgl";
            foreach($selectall as $all) {
            
            if ($all['status_data'] == 1 ){
            	$sta = "Open";
            } else if ($all['status_data'] == 2 ){
            	$sta = "On Progress";
            } else if ($all['status_data'] == 3 ){
            	$sta = "Hold";
            } else if ($all['status_data'] == 4 ){
            	$sta = "Closed";
            } else if ($all['status_data'] == 5 ){
            	$sta = "Hold Request";
            } else if ($all['status_data'] == 6 ){
            	$sta = "Assigned";
            } else if ($all['status_data'] == 0 ){
            	$sta = "Reject";
            } 

            if ($all['priority_wo'] == 1 ){
            	$pri = "Low";
            } else if ($all['priority_wo'] == 2 ){
            	$pri = "Middle";
            } else if ($all['priority_wo'] == 3 ){
            	$pri = "High";
            } 
        ?>
        <tr>
              <td align="center" valign="top"><?=$no?></td>
              <td valign="top"><?=$all['no_ticket']?></td>
              <td valign="top"><?=$all['nama_data']?></td>
              <td valign="top"><?=$all['nama_dept']?></td>
              <!-- <td><?=$all['asetid_data']?></td> -->
              <td valign="top"><?=$all['nama_kategori']?></td>
              <td valign="top"><?=$all['nama_kategori_sub']?></td>
              <td align="left" valign="top"><?=$all['created_date_data']?></td>
              <td align="center" valign="top"><?=$pri?></td>
              <td align="center" valign="top"><?=$sta?></td>
              <td valign="top"><?=$all['remark_data']?></td>
        </tr>
        <?php $no++; } ?>
      </tbody>
      <input type="hidden" name="hal" id="hal" value="<?=$_GET[p]?>">
  </table>

<script>
	   window.close();
</script>
