	<?php
	
		
	?>
			<li class="<?php if($_GET['p']==''){echo 'active';}?>"><a href="content.php" id="dash"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
	                             
			<?php
			//echo $data;
				 $idp = substr($_GET[p],-1,1);
	             $main_m=$con->select("mamenu","*","PARENT=0 AND STATUS=1 AND ID IN(select PARENT from mamenu where ID IN ($akses_menu))");
	             //echo "select * from mamenu where PARENT=0 AND STATUS=1 and ID IN (select PARENT from mamenu where ID IN ($akses_menu))";
	             foreach($main_m as $main_me){ 
	             	if($main_me['ID'] == $idp){
	             		$act = "nav-expanded";
	             	} else {echo $act = "";
	             	}
	 	    ?>		
					<li class="nav-parent <?php echo $act; ?>">	
							<a <?php echo $dest ?>><i class="<?php echo $main_me['ICON'] ?>"></i> <span><?php echo $main_me['NAMA'];?></span></a>
							<ul class="nav nav-children">
							<?php 
									$main_men=$con->select("mamenu","*","(PARENT='$main_me[ID]' and PARENT_SUB='') AND STATUS=1 AND ID IN($akses_menu)");
									//echo "select * from mamenu where (PARENT='$main_me[ID]' and PARENT_SUB='') AND STATUS=1 AND ID IN($akses_menu)";
									foreach($main_men as $main_menu){
										$cl="";
										if($main_menu['SLUG']==''){$cl="nav-expanded";}
							?>
								<li <?php if($pagesub==$main_menu['SLUG']){echo "class='nav-active'";}?>><a href="content.php?p=<?php echo $main_menu['SLUG'].$main_menu['PARENT'];?>" id="<?php echo $main_menu['SLUG'];?>" <?php if($main_menu['SLUG']!='xxx'){}?>><?php echo $main_menu['NAMA'];?></a>
									<?php 
										$main_men_sub=$con->select("mamenu","*","PARENT_SUB='$main_menu[ID]' AND STATUS=1 AND ID IN($akses_menu)");
										//echo "select * from mamenu where PARENT_SUB='$main_menu[ID]' AND STATUS=1 AND ID IN($akses_menu)";
										foreach($main_men_sub as $main_menu_sub){
										?>
									<ul>
										<li <?php if($pagesub==$main_menu_sub['SLUG']){echo "class='active'";}?>><a href="content.php?p=<?php echo $main_menu['SLUG'];?>" id="<?php echo $main_menu_sub['SLUG'];?>"><?php echo $main_menu_sub['NAMA'];?></a></li>
									</ul>
									<?php } ?>
								</li>
							<?php 
									}
							?>
							</ul>
					</li>

			<?php
				}
			?>
									<!-- /main -->
									
										<!-- <li class="nav-active">
											<a href="/eraticket/wo">
												<i class="fa fa-home" aria-hidden="true"></i>
												<span>Work Order</span>
											</a>
										</li>
										<li class="nav-active">
											<a href="index.html">
												<i class="fa fa-home" aria-hidden="true"></i>
												<span>Request</span>
											</a>
										</li>
										<li class="nav-active">
											<a href="index.html">
												<i class="fa fa-home" aria-hidden="true"></i>
												<span>Task</span>
											</a>
										</li>
										<li>
											<a href="mailbox-folder.html">
												<span class="pull-right label label-primary">182</span>
												<i class="fa fa-envelope" aria-hidden="true"></i>
												<span>Mailbox</span>
											</a>
										</li>
								      <li class="nav-parent"> <a> <i class="fa fa-copy" aria-hidden="true"></i> <span>Pages</span> </a>
									      <ul class="nav nav-children">
									        <li> <a href="pages-signup.html"> Sign Up </a> </li>
									        <li> <a href="pages-signin.html"> Sign In </a> </li>
									        <li> <a href="pages-recover-password.html"> Recover Password </a> </li>
									        <li> <a href="pages-lock-screen.html"> Locked Screen </a> </li>
									        <li> <a href="pages-user-profile.html"> User Profile </a> </li>
									        <li> <a href="pages-session-timeout.html"> Session Timeout </a> </li>
									        <li> <a href="pages-calendar.html"> Calendar </a> </li>
									        <li> <a href="pages-timeline.html"> Timeline </a> </li>
									        <li> <a href="pages-media-gallery.html"> Media Gallery </a> </li>
									        <li> <a href="pages-invoice.html"> Invoice </a> </li>
									        <li> <a href="pages-blank.html"> Blank Page </a> </li>
									        <li> <a href="pages-404.html"> 404 </a> </li>
									        <li> <a href="pages-500.html"> 500 </a> </li>
									        <li> <a href="pages-log-viewer.html"> Log Viewer </a> </li>
									        <li> <a href="pages-search-results.html"> Search Results </a> </li>
								        </ul>
								      </li> -->