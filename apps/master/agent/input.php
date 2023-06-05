<?php 
 $selpos = $con->select("mtjabatan","*","status_jabatan = 1");
 $seljob = $con->select("mtjobcat","id_jobcat,nama_jobcat,status_jobcat,jenis_jobcat,
 	CASE jenis_jobcat
   		WHEN 1 THEN 'Software'
   		WHEN 2 THEN 'Hardware' 
   	END as jenis","status_jobcat = 1 GROUP BY jenis_jobcat");
 $selloc = $con->select("mtcabang","*","STATUS_CABANG = 1");
 if($_GET[d]){
 	$seldata = $con->select("mtpegawai a join mtagent b on a.id_pegawai=b.id_pegawai","*","id_agent = '$_GET[d]'");
 	foreach ($seldata as $data) {}
 		$nama1 = $data['nama_awal'];
 		$nama2 = $data['nama_akhir'];
 		$email = $data['email'];
 		$phone = $data['phone'];
 		$idpegawai = $data['id_pegawai'];
 		$images = $data['image'];
 } 
 if($_GET[ph]){
 	$seldata = $con->select("mtpegawai a join mtagent b on a.id_pegawai=b.id_pegawai","*","id_agent = '$_GET[ph]'");
 	foreach ($seldata as $data) {}
 		$nama1 = $data['nama_awal'];
 		$nama2 = $data['nama_akhir'];
 		$email = $data['email'];
 		$phone = $data['phone'];
 		$idpegawai = $data['id_pegawai'];
 		$images = $data['image'];
 }
?>										
										<?php if(empty($_GET[ph])) { ?>
											<div class="form-group">
												<label class="col-md-1 control-label">Name</label>
												<div class="col-md-2">
													<input class="form-control" name="nama1" id="nama1" placeholder="First Name" value="<?=$nama1?>" onkeypress="return allvalscript(event)" />
													<input type="hidden" id="jenis" name="jenis" value="<?=$jenis?>" onkeypress="return allvalscript(event)" required/>
												</div>
												<div class="col-md-2">
													<input class="form-control" name="nama2" id="nama2" placeholder="Last Name" value="<?=$nama2?>" onkeypress="return allvalscript(event)" />
												</div>
												<label class="col-md-2 control-label">Position</label>
												<div class="col-md-4">
													<select data-plugin-selectTwo class="form-control populate"  placeholder="None Selected" name="position" id="position" required>
															 <option value=""></option>
															<?php foreach ($selpos as $pos) {
																  if($data[id_jabatan] == $pos[id_jabatan]){
																  	$s="selected";
																  } else{
																  	$s="";
																  }
															 ?>
																<option value="<?=$pos[id_jabatan]?>"<?=$s?>><?=$pos['nama_jabatan']?></option>
															<?php } ?>
													</select>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-1 control-label">Email</label>
												<div class="col-md-4">
													<input class="form-control" name="email" id="email" placeholder="eratex@eratex.co.id" value="<?=$email?>" onkeypress="return allvalscript(event)" required/>
												</div>
												<label class="col-md-2 control-label">Job Category</label>
												<div class="col-md-4">
													<select data-plugin-selectTwo class="form-control populate" placeholder="None Selected" name="jobcat" id="jobcat">
														<option value=""></option>
															<?php foreach ($seljob as $job) { ?>
															<optgroup label="<?=$job[jenis]?>">
																<?php 
																$seljobdet = $con->select("mtjobcat","*","jenis_jobcat = '$job[jenis_jobcat]'");
																	 foreach ($seljobdet as $jobdet) {
																	 if($data[id_jobcat] == $jobdet[id_jobcat]){
																	  	$s="selected";
																	 } else{
																	  	$s="";
																	 }
																?>
																		<option value="<?=$jobdet[id_jobcat]?>" <?=$s?>><?=$jobdet['nama_jobcat']?></option>
																<?php } ?>
															</optgroup>
														<?php } ?>
													</select>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-1 control-label">Phone</label>
												<div class="col-md-4">
													<input class="form-control" name="phone" id="phone" placeholder="081xxxx" value="<?=$phone?>" required />
												</div>
												<label class="col-md-2 control-label">Location</label>
												<div class="col-md-4">
													<select data-plugin-selectTwo class="form-control populate"  placeholder="None Selected" name="location" id="location" >
															<option value=""></option>
															<?php 
																  foreach ($selloc as $loc) { 
																  if($data[id_cabang] == $loc[ID_CABANG]){
																  	$s="selected";
																  } else{
																  	$s="";
																  }
															?>
																<option value="<?=$loc[ID_CABANG]?>" <?=$s?>><?=$loc['NAMA_CABANG']?></option>
															<?php } ?>
													</select>
												</div>												
											</div>
											
											<div class="form-group">
													<label class="col-sm-1 control-label">Active<span class="required">*</span></label>
													<div class="col-sm-4">
														<label class="switch">
										  					<input type="checkbox" id="setatus" name="setatus" value="1" <?php if($data['id_status'] == 1){echo "checked";} ?>  /> 
										  					<span class="slider round"></span>
										        		</label>
													</div>
													<div class="col-md-2">
														&nbsp;
													</div>
													<div class="col-md-4">
														<button id="btn-simpan" class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')">
														 Simpan 
				                                        </button>
													</div>
											</div>
											<div class="form-group">
												<label class="col-md-1 control-label">Photo</label>
													<div class="col-md-4">
														<?php if(empty($_GET[d])) { ?>
														<input type="file" id="gambar" name="file_img" onchange="showFileSize(this.value)" />
														<?php }?>
														<!-- <img height="70px" width="70px" src="assets/img/pegawai/<?=$data[image]?>" /> -->
                                    					<br /> 
                                            			<img  src="assets/img/pegawai/<?=$data[image]?>" width="180" height="180" id="gambar_nodin" alt="Preview_gambar" />
                                            			<input type="hidden" id="nm_gambar" name="nm_gambar" value="" />
													</div>
											</div>
											<?php } else {?>
											<div class="form-group">
												<label class="col-md-1 control-label">Name</label>
												<div class="col-md-11">
													<?php echo $data['nama_pegawai'] ?>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-1 control-label">Photo</label>
													<div class="col-md-4">
														
														<input type="file" id="gambar" name="file_img" onchange="showFileSize(this.value)" />
														
														<!-- <img height="70px" width="70px" src="assets/img/pegawai/<?=$data[image]?>" /> -->
                                    					<br /> 
                                            			<img  src="assets/img/pegawai/<?=$data[image]?>" width="180" height="180" id="gambar_nodin" alt="Preview_gambar" />
                                            			<input type="hidden" id="jenis" name="jenis" value="image" />
                                            			<input type="hidden" id="nm_gambar" name="nm_gambar" value="<?=$data[image]?>" />
													</div>
													<div class="col-md-2">
														&nbsp;
													</div>
													
											</div>
											<div class="form-group">
												<div class="col-md-4" align="center">
														<button id="btn-simpan" class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')">
														 Simpan 
				                                        </button>
												</div>
											</div>
											<?php } ?>

											<input class="form-control" name="kode" id="kode" value="<?=$kode?>" type="hidden" />
											<input class="form-control" name="peg" id="peg" value="<?=$idpegawai?>" type="hidden" />
											<input class="form-control" name="getp" id="getp" value="<?=$_GET[p]?>" type="hidden" />