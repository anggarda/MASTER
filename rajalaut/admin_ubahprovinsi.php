<?php
require('pustaka.php');
connectDB();
isValidSession();
pgHeader('PT.Tomo Lestari Citra | Ubah Provinsi');

if (isset($_GET['id']))
{
	$provid = $_GET['id'];
	$_SESSION['provid'] = $provid;
}
else
{
	$provid = $_SESSION['provid'];
}

echo '<form method="post" action="admin_ubahprovinsi1.php">
	<table width="250" align="center" cellpadding="3">
		<tr>
			<td align="center" colspan="2"><p align="center" style="font-size:24px">Ubah Provinsi</p><br/><br/></td>
		</tr>';

$sql    = "SELECT * FROM t_province WHERE Province = '$provid'";
$result = mysql_query($sql);

while ($type = mysql_fetch_array($result))
{
echo '<tr>
		<td width="80">Provinsi :</td>
		<td width="170">'.$type[Province].'</td>
	</tr>
	<tr>
		<td width="80">Harga :</td>
		<td width="170"><input type="text" name="delprice" size="10" value="'.$type[DelPrice].'"></td>
	</tr>
	<tr>
		<td width="80">Durasi :</td>
		<td width="170"><input type="text" name="duration" size="10" value="'.$type[Duration].'"> hari</td>
	</tr>			
	<tr>
		<td colspan="2" align="center">
			<br/>
			<input type="hidden" name="provid" value="'.$type[Province].'"/>
			<input type="submit" value="Update" name="update" style="background:url(picture/background1.gif); border:outset; color:#000000"/>
			<input type="reset" value="Reset" style="background:url(picture/background1.gif); border:outset; color:#000000"/>
		</td>		
												
	</tr>';
}

echo '<tr>
		<td colspan="2">';
			$err   = $_SESSION['err'];
			$alert = $_SESSION['alert'];
			if ($err)
			{
				echo "<div class='error'><ul>$err</ul></div>";
			}
			else
			{
				echo $alert;
			}
echo '</td>
	</tr>
	<tr>
		<td colspan="2" align="center"><br /><a href="admin_lihatprovinsi.php">Kembali</a></td>
	</tr>
	</table>
	</form>';

session_unregister('err');
session_unregister('alert');
mysql_close();
pgFooter();
?>