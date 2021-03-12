<html>
<body onload="javascript:window.print()">
<?php
include('config.php');
$sql= "SELECT * FROM data_servis ORDER BY id DESC"; 
$hasil = $dbconnect->query($sql);
$data = $hasil->fetch_array();
?>
 <table  width="100%" cellpadding="0" cellspacing="0" border=1>
	<tr>
		<td>
	<table  width="100%" cellpadding="0" cellspacing="0" border=0>
	
	<tr>
		<td colspan=10 align=center style="font-weight:bold;font-size:15pt; font-family:Times New Roman;"><strong>TEKINFO (2138)</strong></td>
	</tr>
	
	</table>
	
	<table  width="100%" cellpadding="0" cellspacing="0" border=0>
	<tr>
		<td colspan=15 align=center><hr></td>
	</tr>
	<tr>
		<td colspan=15 align=center style="font-weight:bold;font-size:12pt; font-family:Times New Roman;"><strong>Tanda Terima Servis</strong></td>
	</tr>
	<tr>
		<td colspan=15 align=center><hr></td>
	</tr>
	</table>
	<table  width="100%" cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td>
				<table  width="" cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td>&nbsp;</td><td style="font-size:10pt;"><strong>&nbsp;NAMA</strong></td><td>&nbsp;:&nbsp;</td>
						<td style="font-size:10pt;"><?php echo $data['nama']; ?></td>
					</tr>
					<tr>
						<td>&nbsp;</td><td style="font-size:10pt;"><strong>&nbsp;Tlp</strong></td><td>&nbsp;:&nbsp;</td>
						<td style="font-size:10pt;"><?php echo $data['tlp']; ?></td>
					</tr>
					
					<tr>
						<td></td><td style="font-size:10pt;"><strong>&nbsp;BAGIAN</strong></td><td>&nbsp;:&nbsp;</td>
						<td style="font-size:10pt;"><?php echo $data['bagian']; ?></td>
					</tr>
				</table>
			</td>
			<td >
				<table  width="" cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td>&nbsp;</td><td style="font-size:10pt;"><strong>&nbsp;No Asset</strong></td>
						<td>&nbsp;:&nbsp;</td><td style="font-size:10pt;"><?php echo $data['asset']; ?></td>
					</tr>
					<tr>
						<td>&nbsp;</td><td style="font-size:10pt;"><strong>&nbsp;SPEK</strong></td><td>&nbsp;:&nbsp;</td>
						<td style="font-size:10pt;"><?php echo $data['jenis']; ?></td>
					</tr>
					
					<tr>
						<td></td><td style="font-size:10pt;"><strong>&nbsp;KELUHAN</strong></td><td>&nbsp;:&nbsp;</td>
						<td style="font-size:10pt;"><?php echo $data['kerusakan']; ?></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	
	<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td colspan=18 align=center><hr></td>
	</tr>
	<tr>
		<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
		<td colspan="7" align="center" style="font-size:10pt;"></td>
	</tr>
	<tr>
		<td></td><td></td><td></td>
		<td width="100" colspan="2" align="center" style="font-size:10pt;"></td><td></td><td></td><td  width=200></td><td></td><td></td><td></td>
		<td width="100" colspan="2" align="center" style="font-size:10pt;">Penerima</td><td></td><td></td><td></td><td></td><td></td>
	</tr>
	<tr>
		<td></td><td></td><td></td><td  height="50"  colspan="2" align="center" valign="bottom" style="font-size:10pt;"></td><td></td><td></td>
		<td></td><td></td><td></td><td></td><td colspan="2" align="center" style="font-size:10pt;"></td><td></td><td></td><td></td><td></td><td></td>
	</tr>
	<tr>
		<td>&nbsp;&nbsp;</td><td></td><td></td><td colspan="2" align="center" style="font-size:10pt;"></td><td></td><td></td>
		<td></td><td></td><td></td><td></td><td colspan="2" align="center" style="font-size:10pt;"><hr></td><td>&nbsp;&nbsp;</td><td></td><td></td><td></td><td></td>
	</tr>
</table>
</td>
	</tr>
</table>

<hr>

<table  width="100%" cellpadding="0" cellspacing="0" border=1>
	<tr>
		<td>
	<table  width="100%" cellpadding="0" cellspacing="0" border=0>
	
	<tr>
		<td colspan=10 align=center style="font-weight:bold;font-size:15pt; font-family:Times New Roman;"><strong>TEKINFO (2138)</strong></td>
	</tr>
	
	</table>
	
	<table  width="100%" cellpadding="0" cellspacing="0" border=0>
	<tr>
		<td colspan=15 align=center><hr></td>
	</tr>
	<tr>
		<td colspan=15 align=center style="font-weight:bold;font-size:12pt; font-family:Times New Roman;"><strong>Tanda Terima Servis</strong></td>
	</tr>
	<tr>
		<td colspan=15 align=center><hr></td>
	</tr>
	</table>
	<table  width="100%" cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td>
				<table  width="" cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td>&nbsp;</td><td style="font-size:10pt;"><strong>&nbsp;NAMA</strong></td><td>&nbsp;:&nbsp;</td>
						<td style="font-size:10pt;"><?php echo $data['nama']; ?></td>
					</tr>
					<tr>
						<td>&nbsp;</td><td style="font-size:10pt;"><strong>&nbsp;Tlp</strong></td><td>&nbsp;:&nbsp;</td>
						<td style="font-size:10pt;"><?php echo $data['tlp']; ?></td>
					</tr>
					
					<tr>
						<td></td><td style="font-size:10pt;"><strong>&nbsp;BAGIAN</strong></td><td>&nbsp;:&nbsp;</td>
						<td style="font-size:10pt;"><?php echo $data['bagian']; ?></td>
					</tr>
				</table>
			</td>
			<td >
				<table  width="" cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td>&nbsp;</td><td style="font-size:10pt;"><strong>&nbsp;No Asset</strong></td>
						<td>&nbsp;:&nbsp;</td><td style="font-size:10pt;"><?php echo $data['asset']; ?></td>
					</tr>
					<tr>
						<td>&nbsp;</td><td style="font-size:10pt;"><strong>&nbsp;SPEK</strong></td><td>&nbsp;:&nbsp;</td>
						<td style="font-size:10pt;"><?php echo $data['jenis']; ?></td>
					</tr>
					
					<tr>
						<td></td><td style="font-size:10pt;"><strong>&nbsp;KELUHAN</strong></td><td>&nbsp;:&nbsp;</td>
						<td style="font-size:10pt;"><?php echo $data['kerusakan']; ?></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	
	<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td colspan=18 align=center><hr></td>
	</tr>
	<tr>
		<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
		<td colspan="7" align="center" style="font-size:10pt;"></td>
	</tr>
	<tr>
		<td></td><td></td><td></td>
		<td width="100" colspan="2" align="center" style="font-size:10pt;"></td><td></td><td></td><td  width=200></td><td></td><td></td><td></td>
		<td width="100" colspan="2" align="center" style="font-size:10pt;">Penerima</td><td></td><td></td><td></td><td></td><td></td>
	</tr>
	<tr>
		<td></td><td></td><td></td><td  height="50"  colspan="2" align="center" valign="bottom" style="font-size:10pt;"></td><td></td><td></td>
		<td></td><td></td><td></td><td></td><td colspan="2" align="center" style="font-size:10pt;"></td><td></td><td></td><td></td><td></td><td></td>
	</tr>
	<tr>
		<td>&nbsp;&nbsp;</td><td></td><td></td><td colspan="2" align="center" style="font-size:10pt;"></td><td></td><td></td>
		<td></td><td></td><td></td><td></td><td colspan="2" align="center" style="font-size:10pt;"><hr></td><td>&nbsp;&nbsp;</td><td></td><td></td><td></td><td></td>
	</tr>
</table>
</td>
	</tr>
</table>


</body>
</html>






