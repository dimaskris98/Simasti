		
		<!-- header-starts -->
		<div class="sticky-header header-section ">
		
			<div class="header-left">
	
				<!--logo -->
				<div class="logo">
					<a href=".">
						<h1>TEKINFO</h1>
						<span>AdminPanel</span>
					</a>
				</div>
				<!--//logo-->
				
			</div>
			<div class="header-right">
				<div class="profile_details_left"><!--notifications of menu start -->
					<ul class="nofitications-dropdown">
						<li class="dropdown head-dpdn">
								 
									<a href="servis-add">
									   <div ><i class="fa fa_plus nav_icon"></i>Input Perbaikan </div>
									   <div class="clearfix"></div>
									</a>
							 
						</li> 
						<li class="dropdown head-dpdn">
							<a href="servis" class="dropdown-toggle"  >
							<i class="fa fa-book nav_icon"></i><span>Daftar Komp Servis</span></a>
						</li>
					</ul>
					<div class="clearfix"> </div>
				</div>
				<!--notification menu end -->
				<div class="profile_details">		
					<ul>
						<li class="dropdown profile_details_drop">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
								<div class="profile_img">	
									<span class="prfil-img">
										<?php if ($showuser['img']==""){$poto="default-sm.png";}else{$poto= $showuser['img'];} ?>
									<img style="width:40px; border-radius: 50%;" src="images/karyawan/<?php echo $poto; ?>" alt=""> </span> 
									<div class="user-name">
										<p><?php echo $showuser['nama'];?></p>
										<span><?php echo $showuser['level_user'];?></span>
									</div>
									<i class="fa fa-angle-down lnr"></i>
									<i class="fa fa-angle-up lnr"></i>
									<div class="clearfix"></div>	
								</div>	
							</a>
							<ul class="dropdown-menu drp-mnu">
								<li> <a href="#"><i class="fa fa-cog"></i> Settings</a> </li> 
								<li> <a href="Profile"><i class="fa fa-user"></i> Profile</a> </li> 
								<li> <a href="../logout.php"><i class="fa fa-sign-out"></i> Logout</a> </li>
							</ul>
						</li>
					</ul>
				</div>
				<div class="clearfix"> </div>				
			</div>
			<div class="clearfix"> </div>	
			
			
		</div>
						

		<!-- //header-ends -->
		<!-- main content start-->
		<div id="page-wrapper"> 
 <section class="content-header" ></section>