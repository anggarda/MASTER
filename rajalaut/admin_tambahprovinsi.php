<?php
require('pustaka.php');
isValidSession();
pgHeader('PT.Tomo Lestari Citra | Tambah Provinsi');
?>

<form id="addnews" name="addnews" method="post" action="admin_tambahprovinsi1.php">
<table width="300" align="center">
<tr>
	<td>
		<table>
			<tr>
				<td colspan="2" align="center"><img src="picture/tambahprovinsi.gif" width="250" height="50" /><br/><br/></td>
			</tr>
			<tr>
				<td width="100" valign="top">Provinsi :</td>
				<td width="200"><input type="text" name="province" size="20"></td>
			</tr>
			<tr>
				<td width="100" valign="top">Harga :</td>
				<td width="200"><input type="text" name="delprice" size="15"></td>
			</tr>
			<tr>
				<td width="100" valign="top">Durasi :</td>
				<td width="200"><input type="text" name="duration" size="15"> &nbsp;day</td>
			</tr>
		</table>
	</td>
</tr>
<tr>
	<td colspan="2" align="center">
		<br/>
		<input type="submit" value="Simpan" name="save" style="background:url(picture/background1.gif); border:outset; color:#000000"/>
		<input type="reset" value="Reset" style="background:url(picture/background1.gif); border:outset; color:#000000"/>
	</td>												
</tr>
<tr><td  align="center"><br/><a href="admin_lihatprovinsi.php">Kembali</a></td></tr>	
</table>
</form>
<table width="300" align="center">
<tr>
	<td>
		<?php
		$err = $_SESSION['err'];
		$alert = $_SESSION['alert'];
		if ($err)
		{
			echo "<div class='error'><ul>$err</ul></div>";
		}
		else
		{
			echo "$alert";
		}
		?>
	</td>
</tr>
</table>
<?php
session_unregister('err');
session_unregister('alert');

pgFooter();
?>