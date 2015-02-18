<?php
require('pustaka.php');
connectDB();
isValidSession();
pgHeader('Raja Laut | Ubah User1');

echo '<form method="post" action="ubahuserglobal1.php">
	<table width="400" align="center">
		<tr>
			<td align="center"><p align="center" style="font-size:24px">Ubah User</p></td>
		</tr>';

$custid = $_SESSION['custid'];

$sql    = "SELECT * FROM t_customer, t_user WHERE t_customer.CustID = '$custid' AND t_user.CustID = t_customer.CustID";
$result = mysql_query($sql);

while ($type = mysql_fetch_array($result))
{
echo '<tr>
		<td>
			<fieldset>
			<legend class = "style1" >Informasi User</legend>
			<table align="center">
				<tr>
					<td width="250">Username :</td>
					<td width="300"><input type="text" name="username" size="20" maxlength="15" value="'.$type[Username].'" /></td>
				</tr>
				<tr>
					<td>Password :</td>
					<td><input type="password" name="password" maxlength="15" value="'.$type[Password].'" /></td>
				</tr>
				<tr>
					<td>Confirm Password :</td>
					<td><input type="password" name="conpassword" maxlength="15" value="'.$type[Password].'" /></td>
				</tr>
			</table>
			</fieldset>
		</td>
	</tr>
	<tr>
		<td></td>
	</tr>
	<tr>
		<td>
			<fieldset>
			<legend>Informasi Personal</legend>
			<table>
				<tr>
					<td width="250">Nama :</td>
					<td width="300"><input type="text" name="name" size="30" value="'.$type[CustName].'" /></td>
				</tr>
				<tr>
					<td valign="top">Alamat :</td>
					<td><textarea name="address" cols="25" rows="4">'.$type[CustAdd].'</textarea></td>
				</tr>
				<tr>
					<td>Kota :</td>
					<td><input type="text" name="city" size="30" value="'.$type[City].'" /></td>
				</tr>
				<tr>
					<td>No.Kontak :</td>
					<td><input type="text" name="contact" size="20" maxlength="15" value="'.$type[CustContact].'" /></td>
				</tr>
				<tr>
					<td>Email :</td>
					<td><input type="text" name="email" size="30" value="'.$type[Email].'" /></td>
				</tr>
				<tr>
					<td>Tanggal Lahir :</td>
					<td><input type="text" name="BOD" size="15" value="'.$type[Birthdate].'" /> &nbsp; (yyyy-mm-dd)</td>
				</tr>			
			</table>
			</fieldset>
		</td>
	</tr>
	<tr>
		<td colspan="2" align="center">
			<br/>
			<input type="hidden" name="custid" value="'.$type['CustID'].'" />
			<input type="submit" value="Update" name="update" style="background:url(picture/background1.gif); border:outset; color:#000000"/>
			<input type="reset" value="Reset" style="background:url(picture/background1.gif); border:outset; color:#000000"/>
		</td>												
	</tr>';
}

echo '<tr>
		<td>';
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
</table>
<div align="center"><a href="profil.php">Back</a></div>
</form>';

session_unregister('err');
session_unregister('alert');
mysql_close();
pgFooter();
?>
