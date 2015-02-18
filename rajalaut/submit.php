<?php

// we check if everything is filled in

if(empty($_POST['fname']) || empty($_POST['lname']) || empty($_POST['email']) || empty($_POST['pass']))
{
	die(msg(0,"All the fields are required"));
}


// is the sex selected?

if(!(int)$_POST['sex-select'])
{
	die(msg(0,"You have to select your sex"));
}





// is the email valid?

if(!(preg_match("/^[\.A-z0-9_\-\+]+[@][A-z0-9_\-]+([.][A-z0-9_\-]+)+[A-z]{1,4}$/", $_POST['email'])))
	die(msg(0,"You haven't provided a valid email"));



// Here you must put your code for validating and escaping all the input data,
// inserting new records in your DB and echo-ing a message of the type:

// echo msg(1,"/member-area.php");

// where member-area.php is the address on your site where registered users are
// redirected after registration.




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
$username  = $_POST['username'];
$password1 = $_POST['pass1'];
$password2 = $_POST['pass2'];
$email     = $_POST['email'];

// cek kesamaan password
if ($password1 == $password2)
{
	mysql_connect('localhost','root','');
	mysql_select_db("user");
	
	
	{
	// perlu dibuat sebarang pengacak
	$pengacak  = "NDJS3289JSKS190JISJI";
	
	// mengenkripsi password dengan md5() dan pengacak
	$password1 = md5($pengacak . md5($password1) . $pengacak);
	
	// menyimpan username, password terenkripsi, dan email  ke database
	$query = "INSERT INTO username VALUES('$username', '$password1', '$email')";
	$hasil = mysql_query($query);
	
	// menampilkan status pendaftaran
	if ($hasil) echo "User sudah berhasil terdaftar";
	else echo "Username sudah ada yang memiliki";
	}

}
else echo "Password yang dimasukkan tidak sama";

?>

<?php
session_unregister('err');
session_unregister('alert');

pgFooter();
?>
?>
