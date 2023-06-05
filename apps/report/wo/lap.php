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
              <th colspan="12" style="text-align:center" ><h4>TICKET REPORT<br />
               PERIODE <?php echo "$jtg s/d $jtg2"; ?></h4></th>
          </tr>
          <tr>
              <th width="5%">No</th>
              <th width="10%">No Ticket</th>
              <th width="10%">Name</th>
              <!-- <th width="10%">Asset ID</th> -->
              <th width="10%">Assign</th>
              <th width="10%">Category</th> 
              <th width="10%">Sub_Category</th>
              <th width="10%">Jenis Ticket</th>
              <th width="5%">Created Date Request</th>
              <th width="5%">Created Date Ticket</th>
              <th width="5%">Closed Date</th>
              <th width="5%">Priority</th>
              <th width="15%">Status</th> 
              <th width="10%">Days</th>
              <th width="5%">Problem</th>
			        <th width="5%">Remarks</th>
			        <!-- <th width="5%">Solution</th>    -->           
          </tr>
      </thead>
      
      <tbody style="overflow-x: auto">
        <?php 
        if ($_GET['tg']){
            if($_GET['c']==''){
              $cat="";
            }else{
              $cat="and a.id_kategori = $_GET[c]";
            }

            if($_GET['s']==''){
              $sub="";
            }else{
              $sub="and a.id_kategori_sub='$_GET[s]'";
            }

            if($_GET['y']==''){
              $pri="";
            }else{
              $pri="and a.priority_wo='$_GET[y]'";
            }

            if($_GET['t']==''){
              $sta="";
            }else{
              $sta="and b.status_data='$_GET[t]'";
            }

            if($_GET['j']==''){
              $jen="";
            }else{
              $jen="and a.jenis_wo='$_GET[j]'";
            }

            if($_GET['g']==''){
              $asi="";
            }else{
              $asi="and a.id_agent='$_GET[g]'";
            }

            // if($_GET['a']==''){
            //   $ase="";
            // }else{
            //   $ase="and b.asetid_data='$_GET[a]'";
            // }

            if($_GET['tg']== 'A' && $_GET['tg2']== 'A'){
              $tgl="";
            }else{
              $tgl="and DATE(a.created_date_wo) BETWEEN '$_GET[tg]' AND '$_GET[tg2]'";
            }

          } else {
            $cat = "";
            $sub = "";
            $pri = "";
            $sta = "";
            $jen = "";
            $asi = "";
            $ase = "";
            $tgl = "";
          }

            $no = 1;
            $selectall = $con->select("trwo a left join trdata b on a.id_data=b.id_data
            left join trrequest g on a.id_req=g.id_req 
            left join mtdept c on b.departemen_data=c.id_dept
            left join mtkategori d on a.id_kategori = d.id_kategori
            left join mtkategori_sub h on a.id_kategori_sub=h.id_kategori_sub
            left join mtagent e on a.id_agent = e.id_agent
            left join mtpegawai f on e.id_pegawai = f.id_pegawai
            left join mttopik j on a.id_wo = j.id_wo
            left join (select * from trfeedback order by id_feedback DESC) as k on a.id_wo = k.id_wo", 
            "b.no_ticket,b.nama_data,b.asetid_data,f.nama_pegawai,d.nama_kategori,h.nama_kategori_sub,a.created_date_wo,b.created_date_data,b.closed_date_data,
            b.status_data,a.jenis_wo,concat((DATEDIFF(CURDATE(),a.sla_date_wo) - 2),'_',b.status_data,'_',IFNULL((DATEDIFF(b.closed_date_data,a.sla_date_wo) - 2),0)) as stla,a.priority_wo,j.problem,j.analisis,j.solusi,
            b.remark_data,k.remark_feedback",
            "a.id_wo like '%' $cat $sub $pri $sta $jen $asi $tgl GROUP BY b.id_data");
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
            if ($all['jenis_wo'] == 1 ){
            	$jeniswo = "Request";
            } else {$jeniswo = "Non Request"; }

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

            $exsla = explode('_', $all['stla']);
            $sla = $exsla[0];
            $st = $exsla[1];
            $clo = $exsla[2]; 
            if ($st == 4) {
              if ($sla > 0){
                $isijum = "<b>+ $clo</b>";
              } else if ($clo == 0){
                $isijum = "<b>$clo</b>";
              } else if ($clo < 0){
                $isijum = "<b>$clo</b>";
              }
            } else {
              if ($sla > 0){
                $isijum = "<b>+ $sla</b>";
              } else if ($sla == 0){
                $isijum = "<b>$sla</b>";
              } else if ($sla < 0){
                $isijum = "<b>$sla</b>";
              }
            }

        ?>
        <tr>
              <td valign="top"><?=$no?></td>
              <td valign="top"><?=$all['no_ticket']?></td>
              <td valign="top"><?=$all['nama_data']?></td>
              <!-- <td><?=$all['asetid_data']?></td> -->
              <td valign="top"><?=$all['nama_pegawai']?></td>
              <td valign="top"><?=$all['nama_kategori']?></td>
              <td valign="top"><?=$all['nama_kategori_sub']?></td>
              <td valign="top"><?=$jeniswo?></td>
              <td valign="top"><?=$all['created_date_data']?></td>
              <td valign="top"><?=$all['created_date_wo']?></td>
              <td valign="top"><?=$all['closed_date_data']?></td>
              <td valign="top"><?=$pri?></td>
              <td valign="top"><?=$sta?></td>
              <td valign="top"><?=$isijum?></td>
              <td valign="top">
              	<?php
              		if($all['problem'] != ''){
              			echo $all['problem'];
              		} else {
              			echo $all['remark_data'];
              		}
              	?>
              </td>
              <td valign="top"><?=$all['remark_feedback']?></td>
              <!-- <td><?=$all['solusi']?></td> -->
        </tr>
        <?php $no++; } ?>
      </tbody>
      <input type="hidden" name="hal" id="hal" value="<?=$_GET[p]?>">
  </table>

<script>
	   window.close();
</script>
