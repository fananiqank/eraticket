<?php
//echo "Select * from mtagent a join mtpegawai b on a.id_pegawai=b.id_pegawai where id_agent = '$_GET[id]'";
session_start();
include "funlibs.php";
$con = new Database();

if($_GET['type'] == 1) {
	$judul = "Permintaan Akun";
} else if($_GET['type'] == 2) {
	$judul = "Izin Akses Data";
} else if($_GET['type'] == 4) {
	$judul = "Penutupan Akun";
}

foreach($con->select("people_dtl_request a join people b on a.peopleid=b.id left join clients c on a.clientid=c.id left join locations d on a.locationid=d.id",
"a.*,b.nogm,b.name as namepeople,c.name as namedept,d.name as locationname,b.email as emailuser","a.id = '$_GET[id]'") as $mg){}

foreach($con->select("people","*","id = '$_SESSION[ID_LOGIN]'") as $ms){}

foreach($con->select("people_dtl_request a join people b on a.peopleid=b.id left join clients c on a.clientid=c.id left join locations d on a.locationid=d.id",
"a.*,b.nogm,b.name as namepeople,c.name as namedept,d.name as locationname","a.peopledtlidparent = '$_GET[id]'") as $mp){}

foreach($con->select("people_dtl_request a join people b on a.peopleid=b.id left join clients c on a.clientid=c.id left join locations d on a.locationid=d.id",
"a.*,b.nogm,b.name as namepeople,c.name as namedept,d.name as locationname","a.id = '$mg[peopledtlidparent]'") as $md){}

?>

<span class="separator"></span>
	
		<div class="row">
        	<div class="col-md-12">
				
                <div class="col-md-10">
            	<h2><strong><?=$judul;?></strong> &ensp;
            		<font style="font-size: 16px;vertical-align: middle;"><?php echo $isijam; ?></font> 
            	</h2> 
            	
                </div>
                <div class="col-md-2" style="padding: 1%;">
            		<!-- <a href="javascript:void(0)"onClick="window.open('cetak.php?page=request&id=<?=$_GET[id]?>')"  style="cursor:pointer">
            			<img src="assets/images/print-icon.png" alt="Print PDF" />
            		</a> -->
                </div>
            </div>
			<form class="form-user ft11" id="formid" method="post" >
				<div class="col-md-6 col-lg-6">
					<div class="tabs">
							<div id="overview" class="tab-pane active">
								<!-- <h4 class="mb-xlg">Personal Information</h4> -->
								<div id="edit" class="tab-pane">

									<fieldset>
										<div class="form-group">
											<label class="col-md-4 control-label" for="profileFirstName">No. Pegawai</label>
											<div class="col-md-8">
												<?php echo $mg['nogm']?>
												<input type="hidden" id="peopleid" name="peopleid" value="<?=$_SESSION[ID_LOGIN]?>">
												<input type="hidden" id="peopledtlid" name="peopledtlid" value="<?=$_GET[id]?>">
												<input type="hidden" id="typerequest" name="typerequest" value="<?=$_GET[type]?>">
												<input type="hidden" id="idizin" name="idizin" value="<?=$_GET[idizin]?>">
												<input type="hidden" id="useremail" name="useremail" value="<?=$mg[emailuser]?>">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-4 control-label" for="profileFirstName">Name</label>
											<div class="col-md-8">
												<?php echo $mg['namepeople']?>
												<input type="hidden" name="namepeoplex" id="namepeoplex" value="<?php echo $mg['namepeople']?>">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-4 control-label" for="profileFirstName">Dept</label>
											<div class="col-md-8">
												<?php echo $mg['namedept']." - ".$mg['locationname']?>
												<input type="hidden" name="departx" id="departx" value="<?php echo $mg['namedept']." - ".$mg['locationname']?>">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-4 control-label" for="profileFirstName">Jabatan</label>
											<div class="col-md-8">
												<?php echo $mg['title']?>
												<input type="hidden" name="jabatanx" id="jabatanx" value="<?php echo $mg['title']?>">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-4 control-label" for="profileLastName">Created Date</label>
											<div class="col-md-8">
												<?php echo $mg['created_date']?>
												<input type="hidden" name="createddatex" id="createddatex" value="<?php echo $mg['created_date']?>">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-4 control-label" for="profileAddress">Alasan Kebutuhan</label>
											<div class="col-md-8">
												<?php echo $mg['alasanbutuh']?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-4 control-label" for="profileAddress">Notes</label>
											<div class="col-md-8">
												<textarea id="headnotes" name="headnotes"></textarea>
											</div>
										</div>
										
									</fieldset>
									
								</div>
							</div>
					</div>

				</div>
				<div class="col-md-6 col-lg-6">
									<fieldset>
					<?php if($_GET['type'] == 1){ ?>
										<div class="form-group">
											<label class="col-md-4 control-label" for="profileFirstName">Tgl Kebutuhan</label>
											<div class="col-md-8">
												<?php if($mg['tgl_butuh2'] == ''){echo "Selama Menjabat";} 
												else {echo $mg['tgl_butuh1'].' - '.$mg['tgl_butuh2'];}?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-4 control-label" for="profileAddress">Website Akses</label>
											<div class="col-md-8">
												<?php echo $mg['websiteakses']?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-4 control-label" for="profileLastName">Akun Akses</label>
											<div class="col-md-8">
												<?php 
												$expakun = explode(';',$mg['akunakses']);
								                $jmlexp = count($expakun);
								                
								              for($i=0;$i<=$jmlexp;$i++){
								                  foreach($con->select("akunminta","*","idakunminta=$expakun[$i]") as $aks){
								                  	if($i % 1 == 0){$br = "<br>";}else{$br="";} 
								                  	echo "- ".$aks['namaakunminta']."&emsp;".$br;
								              	  }
								              }
								              ?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-4 control-label" for="profileAddress">Replacement</label>
											<div class="col-md-8">
											<?php if($mp['nogm'] == ''){ echo "Not Replace"; } else { ?>
											  	<table class="table">
												  	<tr>
														<td>No Peg</td>
														<td>: <?=$mp['nogm']?>
															<input type="hidden" id="peopledtlidparent" name="peopledtlidparent" value="<?=$mp['id']?>">
														</td>
													</tr>
													<tr>
														<td>Name</td>
														<td>: <?=$mp['namepeople']?></td>
													</tr>
													<tr>
														<td>Dept</td>
														<td>: <?=$mp['namedept']." - ".$mp['locationname']?></td>
													</tr>
													<tr>
														<td>Jabatan</td>
														<td>: <?=$mp['title']?></td>
													</tr>
												</table>
											<?php } ?>
											</div>
										</div>
					<?php } else if ($_GET['type'] == 2) {?>
										<div class="form-group">
											<label class="col-md-12 control-label" for="profileFirstName" style="text-align: center;"><b>Informasi File/Folder</b></label>
											<div class="col-md-12">
												<table cellpadding="0" cellspacing="0" style="width:98%;padding-top: 6pt;padding-bottom: 6pt;margin-left: 20px;font-size: 12px;" border="1">
											      <tr>
											        <th style="width:5%; vertical-align: top;">No</th>
											        <th style="width:25%; vertical-align: top;">File/Folder/Server</th>
											        <th style="width:25%; vertical-align: top;">Lokasi</th>
											        <th style="width:25%; vertical-align: top;">Dept Tujuan</th>
											        <th style="width:15%; vertical-align: top;">Hak Akses</th>
											        <th style="width:25%; vertical-align: top;">Keterangan</th>
											      </tr>
											      <?php
											        $na = 1; 
											        if($_GET[idizin]){$idizi = "and a.id='$_GET[idizin]'";} else {$idizi = "";}
											        foreach($con->select("people_izinakses a left join locations c on a.locationid=c.id left join clients d on c.clientid=d.id","*,case when hak_akses = 1 then 'Full Akses' when hak_akses=2 then 'Read Only' end hakakses,c.name as locationname,d.name as clientname","peopledtlid = '$_GET[id]' $idizi") as $inf){ ?>
											      <tr>
											          <td><?=$na;?></td>
											          <td><?=$inf['filefolder'];?></td>
											          <td><?=$inf['lokasi'];?></td>
											          <td><?=$inf['clientname']." - ".$inf['locationname'];?></td>
											          <td><?=$inf['hakakses'];?></td>
											          <td><?=$inf['remark'];?></td>
											      </tr>
											    <?php } ?>
											    </table>
											    <hr>
											</div>
										
											<label class="col-md-4 control-label" for="profileFirstName">Node </label>
											<div class="col-md-8">
												<?php foreach ($con->select("people_izinakses a left join assets b on a.assetid=b.id","b.name as nameaset,a.assetid","peopledtlid = $_GET[id] group by b.name,a.assetid") as $nd) {

									                echo "- ".$nd['nameaset']."<br>";
									            } ?>
											</div>
										</div>
										
					<?php } else if ($_GET['type'] == 4) {?>
										<div class="form-group">
											<label class="col-md-4 control-label" for="profileAddress">Digantikan oleh</label>
											<div class="col-md-8">
											  	<table class="table">
												  	<tr>
														<td>No Peg</td>
														<td>: <?=$md['nogm']?></td>
													</tr>
													<tr>
														<td>Name</td>
														<td>: <?=$md['namepeople']?></td>
													</tr>
													<tr>
														<td>Dept</td>
														<td>: <?=$md['namedept']." - ".$md['locationname']?></td>
													</tr>
													
												</table>
											</div>
										</div>
					<?php } ?>
										<div class="form-group">
											<label class="col-md-4 control-label" for="profileAddress">Approve</label>
											<div class="col-md-8">
												<a href="javascript:void(0)" onclick="simpanapprove(1)" class="btn btn-primary btn-sm">Approve</a> &emsp;&ensp;
												<a href="javascript:void(0)" onclick="simpanapprove(2)" class="btn btn-danger btn-sm">Reject</a>
											</div>
										</div>
										
									</fieldset>
					
				</div>
			
			</form>
		</div>
		<!-- end: page -->
	</section>
</div>
<script type="text/javascript">
	
	function simpanapprove(id){
		//alert($('#typerequest').val());
		if($('#typerequest').val() == 2){
			if($('#idizin').val() != ''){
				var data = $('.form-user').serialize();
				$.ajax({
					type: 'POST',
					url:  "simpan6.php?p=hd&id="+id,
					data: data,
					success: function() {
						window.location.reload();
						
					}
				});
			} else {
				var data = $('.form-user').serialize();
				$.ajax({
					type: 'POST',
					url:  "simpan5.php?p=hd&id="+id,
					data: data,
					success: function() {
						window.location.reload();
						
					}
				});
			}
			
		} else {
			var data = $('.form-user').serialize();
			$.ajax({
				type: 'POST',
				url:  "simpan2.php?p=hd&id="+id,
				data: data,
				success: function() {
					window.location.reload();
					
				}
			});
		}
			
	}

</script>