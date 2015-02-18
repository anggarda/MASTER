<?php
require('pustaka.php');

pgHeader('CV.Astra Batam | Register');
?>
<style type="text/css">
<!--
.style1 {
	color: #FFFFFF;
	font-weight: bold;
}
-->
</style>


<form id="register" name="register" method="post" action="registerasi1.php">
<table width="400" align="center">
<tr>
	<td align="center"<p style="font-size:24px">Register</p></td>
</tr>
<tr>
	<td>
		<fieldset>
		<legend >Informasi User</legend>
<table align="center">
			<tr>
				<td width="250">Username :</td>
				<td width="300"><input type="text" name="username" size="20" maxlength="15" /></td>
			</tr>
			<tr>
				<td>Password :</td>
				<td><input type="password" name="password" maxlength="15" /></td>
			</tr>
			<tr>
				<td >Confirm Password :</td>
				<td><input type="password" name="conpassword" maxlength="15" /></td>
			</tr>
		
			<tr>
				<td><input type="hidden" name="usertype" value="Cust" /></td>
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
		<legend >Informasi personal</legend>
		<table>
			<tr>
				<td width="250">Nama :</td>
				<td width="300"><input type="text" name="name" size="30" /></td>
			</tr>
			<tr>
				<td valign="top">Alamat :</td>
				<td><textarea name="address" cols="25" rows="4" /></textarea></td>
			</tr>
			<tr>
				<td valign="top">Kota :</td>
				<td><input type="text" name="city" size="20" maxlength="25" /></td>
			</tr>
			<tr>
				<td>No Kontak :</td>
				<td><input type="text" name="contact" size="20" maxlength="15" /></td>
			</tr>
			<tr>
				<td>Email :</td>
				<td><input type="text" name="email" size="30" /></td>
			</tr>
			<tr>
				<td>Tanggal Lahir :</td>
				<td><input type="text" name="BOD" size="15" /> &nbsp; (yyyy-mm-dd)</td>
			</tr>			
		</table>
		</fieldset>
	</td>
</tr>
<tr>
	<td colspan="2" align="center">
		<br/>
		<input type="submit" value="Submit" name="send" style="background:url(picture/background1.gif); border:outset; color:#000000"/>
		<input type="reset" value="Reset" style="background:url(picture/background1.gif); border:outset; color:#000000"/>
	</td>												
</tr>
<tr>
	<td></td>
</tr>
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
</form>

<?php
session_unregister('err');
session_unregister('alert');

pgFooter();
?>