<section class="content-header" style="padding-bottom: 30px;">
<h1 class="pull-left"><?php echo $mod;?></h1>
<div class="pull-right">
<li class="dropdown head-dpdn">
							 
							<a href="#"  class="btn btn-primary" data-toggle="dropdown" ><span >Aset Status</span></a>
							<ul class="dropdown-menu">
							<li>
									<a href="All">
									   <div >Semua Aset</div>
									   <div class="clearfix"></div>	
									</a>
								</li>	 
							 
					
<?php 
											$res = $conn->query("SELECT * FROM status_labels");
											while($row = $res->fetch_assoc()){
												echo '
												<li>
									<a href="hardware?status='.$row['name'].'">
									   <div > Aset ' .$row['name'].'</div>
									   <div class="clearfix"></div>	
									</a>
								</li> 
													';
												 
											}
												
											?>
		</ul>
						</li>											
<li class="dropdown head-dpdn">											
    <a href="CheckOut" class="btn btn-primary ">Check Out</a>
    <a href="CheckIn" class="btn btn-primary t">Check In</a>
	<a href="registrasi" class="btn btn-primary ">Registrasi Asset</a>
	</li>
</div>
						

        </section>
		
<?php

if (isset($mod)){
		switch($mod){
			case "models" :
			include ("model/a.php");
			break; 
	}
}

?>