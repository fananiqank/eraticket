<style>
.noprint {display:none;}
</style>

<div align="right"><!-- <a href="apps/wo/modal2.php?st=tambah" type="button" class="simple-ajax-modal btn btn-warning" ><i class="fa fa-cloud"></i>Tambah Request</a> --></div><br>
<header class="panel-heading">
  <a class='btn btn-warning' style='margin-bottom: 0%;' data-toggle='collapse' data-target='#demo'>Filter Data</a>

  <?php 
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
<?php if ($_GET['c'] || $_GET['s'] || $_GET['y'] || $_GET['t'] || $_GET['tg'] || $_GET['tg2']){ ?>
  <div id="demo" class="collapse in" >
<?php } else {?>
  <div id="demo" class="collapse" >
<?php } ?>
<hr>
<div class="form-group">
    <label class="col-md-1 control-label" for="profileLastName"><b>Category</b></label>
    <div class="col-md-3">
      <select data-plugin-selectTwo class="form-control populate"  placeholder="None Selected" name="kategori" id="kategori" onchange="kate(this.value)">
          <option value="">All</option>
          <?php 
              $selcat = $con->select("mtkategori","*","status_kategori = 1");
              foreach ($selcat as $cat) { 
              if($_GET['c'] == $cat['id_kategori']){
                $s="selected";
              } else{
                $s="";
              }
          ?>
            <option value="<?=$cat[id_kategori]?>" <?=$s?>><?=$cat['nama_kategori']?></option>
          <?php } ?>
      </select>
     </div>
     <label class="col-md-2 control-label" for="profileLastName"><b>Sub Category</b></label>
     <div class="col-md-3">
      <select data-plugin-selectTwo class="form-control populate"  placeholder="None Selected" name="subkategori" id="subkategori" required>
        <?php $selsbc = $con->select("mtkategori_sub","*","status_kategori_sub = '1' and id_kategori_sub = $_GET[s]");
              foreach ($selsbc as $sbc) {}  ?>
        <option value="<?=$sbc[id_kategori_sub]?>"><?=$sbc['nama_kategori_sub']?></option>

      </select>
     </div>
     <label class="col-md-1 control-label" for="profileLastName"><b>Priority</b></label>
    <div class="col-md-2">
      <select data-plugin-selectTwo class="form-control populate"  placeholder="None Selected" name="priority" id="priority">
            <option value="">All</option>
            <option value="1" <?php if($_GET['y'] == '1'){echo "selected";} ?>>Low</option>
            <option value="2" <?php if($_GET['y'] == '2'){echo "selected";} ?>>Medium</option>
            <option value="3" <?php if($_GET['y'] == '3'){echo "selected";} ?>>High</option>
      </select>
     </div>
</div>
<div class="form-group">
  <label class="col-md-1 control-label" for="profileLastName"><b>Status</b></label>
    <div class="col-md-3">
      <select data-plugin-selectTwo class="form-control populate"  placeholder="None Selected" name="lstatus" id="lstatus">
          <option value="">All</option>
          <option value="1" <?php if($_GET['t'] == '1'){echo "selected";} ?>>Open</option>
          <option value="2" <?php if($_GET['t'] == '2'){echo "selected";} ?>>On Progress</option>
          <option value="3" <?php if($_GET['t'] == '3'){echo "selected";} ?>>Hold</option>
          <option value="4" <?php if($_GET['t'] == '4'){echo "selected";} ?>>Closed</option>
          <option value="5" <?php if($_GET['t'] == '5'){echo "selected";} ?>>Hold Request</option>
          <option value="6" <?php if($_GET['t'] == '6'){echo "selected";} ?>>Assign</option>
          <option value="0" <?php if($_GET['t'] == '0'){echo "selected";} ?>>Reject</option>
      </select>
     </div>
  <!--    <label class="col-md-2 control-label" for="profileLastName"><b>Assets ID</b></label>
    <div class="col-md-3">
      <select data-plugin-selectTwo class="form-control populate"  placeholder="None Selected" name="laset" id="laset">
          <option value="">All</option> -->
          <!-- <?php 
              foreach ($selcat as $cat) { 
              if($mg['id_kategori'] == $cat['id_kategori']){
                $s="selected";
              } else{
                $s="";
              }
          ?>
            <option value="<?=$cat[id_kategori]?>" <?=$s?>><?=$cat['nama_kategori']?></option>
          <?php } ?> -->
      <!-- </select>
     </div> -->
</div>   
<hr>
<div class="form-group">
    <label class="col-md-1 control-label" for="profileLastName"><b>Periode</b></label>
    <div class="col-md-3">
      <i class="fa fa-calendar" style="height:30px;"></i>
      <input type="text" id="tgl" name="tgl" data-plugin-datepicker style="border-radius:4px; -moz-border-radius:4px; height:30px;" value="<?=$gg?>" required>
      <input id="tglsatu" name="tglsatu" value="<?=$_GET['tg']?>" type="hidden">
    </div>
    <label class="col-md-2 control-label" for="profileLastName" style="text-align: center"><b>s / d</b> </label>
    <div class="col-md-3">
      <i class="fa fa-calendar" style="height:30px;"></i>
      <input type="text" id="tgl2" name="tgl2" data-plugin-datepicker style="border-radius:4px; -moz-border-radius:4px; height:30px;" value="<?=$wp?>" required>
      <input id="tgldua" name="tgldua" value="<?=$_GET['tg2']?>" type="hidden">
    </div>

    <div class="col-md-12">
      <a href="content.php?p=<?=$_GET[p]?>" style="height:30px; line-height: 0;float: right; padding: 2%;" type="button" class="btn btn-default">Reset</a>
      <input style="height:30px; line-height: 0;float: right; padding: 2%;" type="button" class="btn btn-info" value="Search" onClick="pindahData2(kategori.value,subkategori.value,priority.value,lstatus.value,tgl.value,tgl2.value)">
      
    </div>
</div>
</div>
</header>
<div >
<!-- <a href="javascript:void(0)"onClick="window.open('cetak.php?page=wo&id=<?=$_GET[d]?>')"  style="cursor:pointer">
    <img src="assets/images/print-icon.png" alt="Print PDF" width="4%" style="margin-top: 2%" />
</a> -->
<!-- <a href="javascript:void(0)" onclick="tableToExcel('datatable-ajax')"  style="cursor:pointer">
    <img src="assets/images/excel_icon_50.gif" alt="Print PDF" width="4%" style="margin-top: 2%" /> </a> -->
    <a href="javascript:void(0)" onClick="window.open('spk.php?page=lapreq&c=<?=$_GET[c]?>&s=<?=$_GET[s]?>&a=<?=$_GET[a]?>&y=<?=$_GET[y]?>&t=<?=$_GET[t]?>&tg=<?=$_GET[tg]?>&tg2=<?=$_GET[tg2]?>')"  style="cursor:pointer">
    <img src="assets/images/excel_icon_50.gif" alt="Excel" width="4%" style="margin-top: 2%" />
</a>
<hr>
<table class="table table-bordered table-hover pre-scrollable" id="datatable-ajax" width="150%">
      <thead>
          <tr>
              <th colspan="11" style="text-align:center" ><h4>REQUEST ORDER REPORT<br />
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
              <th width="10%">Created_Date</th>
              <th width="10%">Priority</th>
              <th width="15%">Status</th> 
              <th width="15%">Problem</th> 
          </tr>
      </thead>
      
      <tbody style="overflow-x: auto">
      </tbody>
      <input type="hidden" name="hal" id="hal" value="<?=$_GET[p]?>">
  </table>

<script>
function kate(id){
    $.get('apps/report/request/subcat.php?id='+id, function(data) {
        $('#subkategori').html(data);    
    });
    
  } 

  var tableToExcel = (function() {
    
  var uri = 'data:application/vnd.ms-excel;base64,'
    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
    , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
  return function(table, name) {
    if (!table.nodeType) table = document.getElementById(table)
    var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
    window.location.href = uri + base64(format(template, ctx))

  }
})()


</script>  