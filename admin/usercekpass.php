<?php
$input = $_GET['input']; //menangkap password yang diinput oleh user
$cek = $_GET['password']; //menangkap nilai apakah untuk input password atau konfirmasi
$pass = $_GET['pass']; //menangkap nilai dari form password yang diisi
$error="";
if ( $cek == 1 ) //untuk melakukan pengecekan kekuatan password
{
	if( strlen($input) > 20 ) { $error .= "Password too long! "; }
	if( strlen($input) < 6 ) { $error .= "Password too short! "; } 
	if( !preg_match("#[0-9]+#", $input) ) { $error .= "Password must include at least one number! "; } 
	if( !preg_match("#[A-Za-z]+#", $input) ) { $error .= " at least one letter! "; } 
	//if( !preg_match("#[A-Z]+#", $input) ) { $error .= " at least one CAPS!"; } 
	//if( !preg_match("#\W+#", $input) ) { $error .= " at least one symbol! "; } 
	if($error){ echo  $error; } else { echo "Your password is strong."; }
	 
}

else if ( $cek == 2 ) //untuk melakukan pengecekan konfirmasi password
{
if ($pass == $input) echo "Cocok";
else echo "Tidak Cocok";
}
?>