<?php
$id_user= $_SESSION['sess_id'];
	$showkaryawan =mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM users 
				Left join data_karyawan ON users.username=data_karyawan.nik 
				WHERE id_user= '$id_user'"));
								 
?>
<section class="content">
          <!-- Content -->
            <div id="webui">
          
<div class="row">
<div class="col-md-8 col-md-offset-2">
	 
						<h4 class="title3">Profile</h4>
						<div class="profile-top">
							<img src="images/img1.png" alt="">
							<h4>Wikolia smith</h4>
							<h5>Lorem Ipsum is simply dummy</h5>
						</div>
						<div class="profile-text">
							<div class="profile-row">
								<div class="profile-left">
									<i class="fa profile-icon">E-Mail</i>
								</div>
								<div class="profile-right">
									<h4>Username@example.com </h4>
									<p>Email</p>
								</div> 
								<div class="clearfix"> </div>	
							</div>
							<div class="profile-row row-middle">
								<div class="profile-left">
									<i class="fa profile-icon">Telp</i>
								</div>
								<div class="profile-right">
									<h4>222-555-111</h4>
									<p>Contact Number</p>
								</div> 
								<div class="clearfix"> </div>	
							</div>
							<div class="profile-row">
								<div class="profile-left">
									<i class="fa profile-icon">Dep.</i>
								</div>
								<div class="profile-right">
									<h4>facebook.com/user</h4>
									<p>Facebook</p>
								</div> 
								<div class="clearfix"> </div>	
							</div>
							<div class="profile-row row-middle">
								<div class="profile-left">
									<i class="fa profile-icon">Bagian</i>
								</div>
								<div class="profile-right">
									<h4>222-555-111</h4>
									<p>Contact Number</p>
								</div> 
								<div class="clearfix"> </div>	
							</div> 
						</div> 
</div>
</div></div></div>
