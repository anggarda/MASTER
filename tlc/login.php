<?php
require('pustaka.php');

pgHeader('PT.Tomo Lestari Citra | Login');
?>

<form action="login_process.php" name="login" method="post" >
<table width="250" align="center">
	<tr>
		<td colspan="2" align="center"><p style="font-size:24px">Login Form</p></td>
	</tr>
	
	<tr>
		<td width="150">Username :</td>
		<td width="250"><input type="text" name="username" /></td>
	</tr>
	<tr>
		<td>Password :</td>
		<td><input type="password" name="password" /></td>
	</tr>
	<tr>
		<td colspan="2">
			<?php
			$err = $_SESSION['err'];
			if ($err)
			{
				echo "<div class='error'>$err</div>";
			}
			?>
		</td>
	</tr>
	<tr>
		<td colspan="2" align="center">
			Untuk user baru, <a href="registerasi.php" style="color:#FF0000">Klik disini</a> untuk Registrasi.
		</td>
	</tr>
	<tr>
		<td colspan="2" align="center">
			<br/>
			<input type="submit" value="Login" style="background:url(picture/background1.gif); border:outset; color:#000000"/>
		</td>												
	</tr>
</table>				
</form>																									

<?php
session_unregister('err');

pgFooter();
?>
