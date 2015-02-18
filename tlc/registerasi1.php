<?php
require('pustaka.php');
connectDB();

pgHeader('PT.Tomo Lestari Citra | Register1');

$username		= ucwords($_POST['username']);
$password		= $_POST['password'];
$conpassword   	= $_POST['conpassword'];

$userType		= $_POST['usertype'];

$name		= ucwords($_POST['name']);
$address	= $_POST['address'];
$city   	= ucwords($_POST['city']);
$contact	= $_POST['contact'];
$email		= $_POST['email'];
$bod		= $_POST['BOD'];

$send		= $_POST['send'];

session_name('err');
session_name('alert');
$_SESSION['err'] = $err;
$_SESSION['alert'] = $alert;

if (isset($send))
{
	$error = 0;
	
	/********** validate form **********/
	// validate username
	if (!empty ($username))
	{
		if (!ereg ("^[A-Za-z ]+$", $username))
		{
			$err .= "<li>Username harus diisi dengan huruf.</li>";
			$error++;
		}
	}
	else
	{
		$err .= "<li.</li>";
		$error++;
	}
	
	// Lets check to see if the username already exists
	$query = "SELECT Username FROM t_user WHERE Username = '$username'";
	$check = mysql_query($query);
	
	$existUsername = mysql_num_rows($check);
	
	if($existUsername > 0)
	{
		$err .= "<li>Username yang anda isi telah ada. Mohon pilih yang lain.</li>";
		$error++;
	}

	// validate password and confirm password
	if ($password == $conpassword)
	{
		if (!empty ($password))
		{
			if (!ereg ("^[A-Za-z0-9!@#$%^&*]{6,}$", $password))
			{
				$err .= "<li>Password minimal 6 angka atau huruf.</li>";
				$error++;
			}
		}
		else
		{
			$err .= "<li>Silahkan isi password anda.</li>";
			$error++;
		}
		
		if (!empty ($conpassword))
		{
			if (!ereg ("^[A-Za-z0-9!@#$%^&*]{6,}$", $conpassword))
			{
				$err .= "<li>Confirm password minimal 6 angka atau huruf.</li>";
				$error++;
			}
		}
		else
		{
			$err .= "<li>Silahkan isi confirm password anda.</li>";
			$error++;
		}
	}
	else
	{
		$err .= "<li>Password and Confirm password tidak sesuai.</li>";
		$error++;
	}
	// cek keberadaan email dalam database
	
	$query = "SELECT * FROM username WHERE email = '$email'";
	$hasil = mysql_query($query);
	$jumEmail  = mysql_num_rows($hasil);
	
	if ($jumEmail > 0) echo "Maaf email sudah terdaftar";
	else
	
	// validate email dalam dalam register
	 if ($email=="")
	   	   $errorblankemail= "Please fill in your e-mail";
		 if (!ereg("^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$", $email))
		 	$errorblankemail = "Invalid Email Address";
			
	// validate name
	if (!empty ($name))
	{
		if (!ereg ("^[A-Za-z ]+$", $name))
		{
			$err .= "<li>Nama harus diisi dengan huruf.</li>";
			$error++;
		}
	}
	else
	{
		$err .= "<li>Silahkan isi nama anda.</li>";
		$error++;
	}
	
	// validate address
	if (empty ($address))
	{
		$err .= "<li>Silahkan isi alamat anda.</li>";
		$error++;
	}
	
	// validate city
	if (!empty ($city))
	{
		if (!ereg ("^[A-Za-z ]+$", $city))
		{
			$err .= "<li>Kota harus diisi dengan huruf.</li>";
			$error++;
		}
	}
	else
	{
		$err .= "<li>Silahkan isi kota anda.</li>";
		$error++;
	}
	
	// validate contact
	if (!empty ($contact))
	{
		if (!ereg ("^[0-9]{6,}$", $contact))
		{
			$err .= "<li>No kontak minimal 6 angka.</li>";
			$error++;
		}
	}
	else
	{
		$err .= "<li>Silahkan isi no kontak anda.</li>";
		$error++;
	}
	
	// validate email
	if (!empty ($email))
	{
		if (!ereg ("^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$",$email))
		{
			$err .= "<li>Format email salah.</li>";
			$error++;
		}
	}
	else
	{
		$err .= "<li>Silahkan isi email anda.</li>";
		$error++;
	}
	
	// Lets check to see if the email already exists
	$query1 = "SELECT Email FROM t_customer WHERE Email = '$email'";
	$check1 = mysql_query($query1);
	
	$existEmail = mysql_num_rows($check1);
	
	if($existEmail > 0)
	{
		$err .= "<li>Email telah di pakai.</li>";
		$error++;
	}
	
	// validate birthdate
	if (!empty ($bod))
	{
		if (!ereg ("^(19|20)[0-9][0-9]-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[01])$", $bod))
		{
			$err .= "<li>Format tanggal lahir salah (yyyy-mm-dd).</li>";
			$error++;
		}
	}
	else
	{
		$err .= "<li>Silahkan isi tanggal lahir anda.</li>";
		$error++;
	}
	
	if ($error == 0)
	{
		/********** insert data **********/
		$iCustomer  = "INSERT INTO t_customer VALUES ";
		$iCustomer .= " (null, '$name', '$address', '$city', '$contact', '$email', '$bod')";
		
		mysql_query($iCustomer);
		
		// get the customerID
		$sql = "SELECT CustID FROM t_customer WHERE CustName = '$name' AND Birthdate = '$bod'";
		
		$result = mysql_query($sql);
		$row 	= mysql_num_rows($result);
		
		if ($row == 1)
		{
			$result = mysql_query($sql);
			$id 	= mysql_fetch_row($result);
			$custid = $id[0];
			$_SESSION['custid'] = $custid;
		}
		
		$iUser  = "INSERT INTO t_user VALUES ";
		$iUser .= " ('$username', '$password', '$custid', '$userType')";
		
		mysql_query($iUser);
		
		if (mysql_affected_rows() == 1)
		{
			$_SESSION['usertype'] = $userType;
			$_SESSION['username'] = $username;
			$alert .= "<script type='text/javascript'>window.alert('Registrasi berhasil.')</script>";
			header ("location: http:profil.php");
		}
		else
		{
			$alert .= "<script type='text/javascript'>window.alert('Registrasi gagal. Mohon coba lagi.')</script>";
			header ("location: http:registerasi.php");
		}
	}
	else
	{
		$alert .= "<script type='text/javascript'>window.alert('Registrasi gagal. Mohon coba lagi.')</script>";
		header ("location: http:registerasi.php");
	}
}

mysql_close();
pgFooter();
?>
