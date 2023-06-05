<section class="panel">
		<header class="panel-heading">
				<a href="content.php?p=<?=$get?>" class="btn btn-success" style="float: right" data-toggle="confirmation"><?=$nametag?></a>
					<h2 class="panel-title">&nbsp;</h2>
		</header>
	<div class="panel-body">
		
		<form class="form-user" id="formku" method="post" action="content.php?p=<?=$get?>_s" enctype="multipart/form-data">
				<?php 
						$isuk = substr($_GET[p], 0,1);
					  if($isuk == "v") { 
						include "input.php";
					  }else {
				?>

						<div class="form-group">
							<table class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" id="datatable-ajax" width="100%">
								<thead>
									<tr>
										<th width="5%">No</th>
										<th width="20%">Name</th>
										<th width="15%">Email</th>
										<th width="15%">Phone</th>
										<th width="15%">Position</th>
										<th width="15%">Job Category</th>
										<th width="10%">Location</th>
										<th width="5%">Detail</th>		
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
				<?php } ?>
				<input type="hidden" id="hal" name="hal" value="<?=$get?>">
		</form>
	</div>
</section>
	
		
		
