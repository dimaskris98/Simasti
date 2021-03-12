<?php
include ("../konekdb.php");
	 	 
	if(isset($_POST["isi_status"]) && strlen($_POST["isi_status"])>0) 
	{ 
		$contentToSave = filter_var($_POST["isi_status"],FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
		$type =filter_var($_POST["isi_type"],FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
		$id_user=$_SESSION['sess_id']; 
	
	 
			$sql = "INSERT INTO status_labels  VALUES ('', '$contentToSave','$id_user', '$type','')";
	 
		
		
		if(mysqli_query($conn,$sql))
		{
			
			$jsArray = "var dtstatus = new Array();\n";        
							  
									  
										   
		$my_id = mysqli_insert_id($conn);
		echo'<option value="'.$my_id.'" selected="selected">'.$contentToSave.' </option>
		';	
		$jsArray .= "dtstatus['" .$my_id. "'] = {deployable:'".addslashes($contentToSave)."'};\n"; 
	}
	}	 
	
if(isset($_POST["content_sup"]) && strlen($_POST["content_sup"])>0) 
	{ 
		$contentToSave = filter_var($_POST["content_sup"],FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
		$sql = "INSERT INTO data_pemasok  VALUES ('', '$contentToSave', ' ', ' ')"; 
	 
		if(mysqli_query($conn,$sql))
		{
		$my_id = mysqli_insert_id($conn);
		echo'<option value="'.$my_id.'" selected="selected">'.$contentToSave. ' </option>';  
		}
	}

if(isset($_POST["content_kat"]) && strlen($_POST["content_kat"])>0) 
	{ 
		

		$contentToSave = filter_var($_POST["content_kat"],FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
		$sql = "INSERT INTO kategori  VALUES ('', '$contentToSave', 'aset')";
	 
		if(mysqli_query($conn,$sql))
		{
		$my_id = mysqli_insert_id($conn);
		echo'<option value="'.$my_id.'" selected="selected">'.$contentToSave.' </option>';  
	}
	}

if(isset($_POST["kat_consum"]) && strlen($_POST["kat_consum"])>0) 
	{ 
		

		$contentToSave = filter_var($_POST["kat_consum"],FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
		$sql = "INSERT INTO kategori  VALUES ('', '$contentToSave', 'consumable')";
	 
		if(mysqli_query($conn,$sql))
		{
		$my_id = mysqli_insert_id($conn);
		echo'<option value="'.$my_id.'" selected="selected">'.$contentToSave.' </option>';  
	}
	}
	
if(isset($_POST["content_manufaktur"]) && strlen($_POST["content_manufaktur"])>0) 
	{ 
		

		$contentToSave = filter_var($_POST["content_manufaktur"],FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
		$sql = "INSERT INTO manufaktur  VALUES ('', '$contentToSave')";
		if(mysqli_query($conn,$sql))
		{
		$my_id = mysqli_insert_id($conn);
		echo'<option value="'.$my_id.'" selected="selected">'.$contentToSave.' </option>';  
	}
	}
	
if(isset($_POST["content_status"]) && strlen($_POST["content_status"])>0) 
	{ 
		$contentToSave = filter_var($_POST["content_status"],FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
		$type =filter_var($_POST["content_type"],FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
		$created_at=date("Y-m-d h:i:sa");
		$id_user=$_SESSION['sess_id']; 
	
		if ($_POST["content_type"]=="deployable") 
		{
			$sql = "INSERT INTO status_labels  VALUES ('', '$contentToSave','$id_user','created_at','1','','','')";
		}else if($_POST["content_type"]=="pending") 
		{
			$sql = "INSERT INTO status_labels  VALUES ('', '$contentToSave','$id_user','created_at','','1','','')";
		}else
		{
			$sql = "INSERT INTO status_labels  VALUES ('', '$contentToSave','$id_user','created_at','','','1','')";
		}
		
		
		
		if(mysqli_query($conn,$sql))
		{
		$my_id = mysqli_insert_id($conn);
		echo'<option value="'.$my_id.'" selected="selected">'.$contentToSave.' </option>';  
	}
	}	 
	
if (isset($_GET['q'])){
$q = intval($_GET['q']);
$shownote =mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM status_labels WHERE id = '$q'")); 
 
		echo $shownote['notes'];
	 
	 
} 
if (isset($_POST['column'])){
	$result = mysqli_query($conn,"UPDATE kebutuhan set " . $_POST["column"] . " = '".$_POST["editval"]."' WHERE  id=".$_POST["id"]);
	
}

?>