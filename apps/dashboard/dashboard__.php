<?php 
include "../../../funlibs.php";
$con = new Database;
?>
					<!-- Simple panel -->
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h5 class="panel-title">Dashboard</h5>
							<div class="heading-elements">
								<ul class="icons-list">
			                		<li><a data-action="collapse"></a></li>
			                		<li><a data-action="close"></a></li>
			                	</ul>
		                	</div>
						</div>

							<!-- Traffic sources -->
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Traffic sources</h6>
									<div class="heading-elements">
										<form class="heading-form" action="#">
											<div class="form-group">
												<label class="checkbox-inline checkbox-switchery checkbox-right switchery-xs">
													<input type="checkbox" class="switch" checked="checked">
													Live update:
												</label>
											</div>
										</form>
									</div>
								</div>

								<div class="container-fluid">
									<div class="row">
										<div class="col-lg-4">
											<ul class="list-inline text-center">
												<li>
													<a href="#" class="btn border-teal text-teal btn-flat btn-rounded btn-icon btn-xs valign-text-bottom"><i class="icon-plus3"></i></a>
												</li>
												<li class="text-left">
													<div class="text-semibold">Total Request</div>
                                                    <?php 
													$selrequset = $con->select("trrequest a join trdata b on a.id_data=b.id_data","COUNT(id_req) as jmlreq","b.status_data != ''");
													foreach ($selrequset as $sreq){}
													?>
													<div class="text-muted"><?=$sreq['jmlreq']?></div>
												</li>
											</ul>

											<div class="col-lg-10 col-lg-offset-1">
												<div class="content-group" id="new-visitors"></div>
											</div>
										</div>

										<div class="col-lg-4">
											<ul class="list-inline text-center">
												<li>
													<a href="#" class="btn border-warning-400 text-warning-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom"><i class="icon-watch2"></i></a>
												</li>
												<li class="text-left">
                                                    <?php 
														$selwo = $con->select("trwo a join trdata b on a.id_data=b.id_data","COUNT(id_wo) as jmlwo","b.status_data != ''");
														foreach ($selwo as $swo){}
													?>                               
													<div class="text-semibold">Total Work Order</div>
													<div class="text-muted"><?=$swo['jmlwo']?></div>
												</li>
											</ul>

											<div class="col-lg-10 col-lg-offset-1">
												<div class="content-group" id="new-sessions"></div>
											</div>
										</div>

										<div class="col-lg-4">
											<ul class="list-inline text-center">
												<li>
													<a href="#" class="btn border-indigo-400 text-indigo-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom"><i class="icon-people"></i></a>
												</li>
												<li class="text-left">
                                                
                                                    <?php 
														$seltasks = $con->select("trtasks","COUNT(id_tasks) as jmltasks","status_tasks != ''");
														foreach ($seltasks as $stasks){}
													?>
                                                    													
                                                    <div class="text-semibold">Total Tasks</div>
													<div class="text-muted"><span class="status-mark border-success position-left"></span> <?=$stasks['jmltasks']?></div>
												</li>
											</ul>

											<div class="col-lg-10 col-lg-offset-1">
												<div class="content-group" id="total-online"></div>
											</div>
										</div>
									</div>
								</div>

								<div class="position-relative" id="traffic-sources"> 
                               	</div>
							</div>   
							<!-- /traffic sources -->

                           
					</div>
					<!-- /simple panel -->
                    
                 <div class="panel panel-flat" style="height:400px">     
                    <div class="form-group">                             
                                    <?php
                                    include('chart_jual1.php');	
                                    ?>                      
                       		<div class="form-group">
	<div class="col-lg-6">
		<div id="container1" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
    </div>
	<div class="col-lg-6">
		<div id="container2" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
    </div>
</div>
                     </div>  
                    
                </div>          
 
                        
              