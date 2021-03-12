
<div class="col-md-8 col-md-offset-2">
				<div class="box box-default">
					 
										<?php 
											$res = $conn->query("SELECT * FROM data_karyawan where organik='organik'");
											while($row = $res->fetch_assoc()){
											$nik=$row['nik'];
												echo "UPDATE data_karyawan SET where nik='$nik'";
											}
											?>	
									</select>
								</div> 
							</div>   

 
