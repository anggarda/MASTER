<?php
require('pustaka.php');
connectDB();
isValidSession();

pgHeader('PT.Tomo Lestari Citra | Konfirmasi');

$custid = $_SESSION['custid'];
$sql    = "SELECT * FROM t_customer, t_user WHERE t_customer.CustID = '$custid' AND t_user.CustID = t_customer.CustID";
$result = mysql_query($sql);

echo '<table align="center" width="400">
		<tr>
			<td align="center" colspan=2><img src="picture/konfirmasi.gif" width="250" height="40" /><br /><br /></td>
		</tr>';
while ($type = mysql_fetch_array($result))
{
echo '<tr>
		<td colspan="2">
			<fieldset><legend>Informasi Customer</legend>
			<table align="center" width="320" cellpadding="2">
				<tr>
					<td width="80">Nama :</td>
					<td width="230">'.$type[CustName].'</td>
				</tr>
				<tr>
					<td valign="top">Alamat :</td>
					<td >'.nl2br($type[CustAdd]).'</td>
				</tr>
				<tr>
					<td>Kota :</td>
					<td>'.$type[City].'</td>
				</tr>
				<tr>
					<td>No Kontak:</td>
					<td>'.$type[CustContact].'</td>
				</tr>	
			</table>
			</fieldset><br />
		</td>
	</tr>';
}
echo '<form method="post" action="konfirmasi1.php">
	<tr>
		<td colspan="2">
			<fieldset><legend>Informasi Prngiriman</legend>
			<table align="center" width="320" cellpadding="2">
				<tr>
					<td width="80">Nama :</td>
					<td width="230"><input type="text" name="delivername" size="25"></td>
				</tr>
				<tr>
					<td valign="top">Alamat :</td>
					<td><textarea cols="25" rows="4" name="deliveradd"></textarea></td>
				</tr>
				<tr>
					<td>Kota :</td>
					<td><input type="text" name="delivercity" size="20"></td>
				</tr>
				<tr>
					<td>Provinsi :</td>
					<td>
						<select name="province">
						<option selected>----- Silahkan Pilih -----</option>';
						$sql1 = "SELECT Province FROM t_province ORDER BY Province ASC"; 
						$result1 = mysql_query($sql1); 
						while ($row = mysql_fetch_array($result1))  
						{
							$prov = $row['Province'];
							echo "<option value='$prov'>$prov</option>";
						}
				echo '	</select>
					</td>
				</tr>
			</table>
			</fieldset><br />
		</td>
	</tr>
		<tr>
		<td align="center" colspan="2">
			<br/>
			<input type="submit" name="submit" value="Submit" style="background:url(picture/background1.gif); border:outset; color:#000000">	
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<table align="center" width="300"
				<tr>
					<td class="error"><br/>';
						$err = $_SESSION['err'];
						if ($err)
						{
							echo "$err";
						}
			echo '	</td>
				</tr>
			</table>			
		</td>
	</tr>
	</form>		
</table>';

mysql_close();
session_unregister('err');

pgFooter();
?>
