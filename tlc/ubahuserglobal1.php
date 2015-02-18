<?php
require('pustaka.php');
connectDB();
isValidSession();
pgHeader('Fokus | Ubah Admin1');

$username		= $_POST['username'];
$password		= $_POST['password'];
$conpassword   	= $_POST['conpassword'];

$name		= ucwords($_POST['name']);
$address	= $_POST['address'];
$city   	= ucwords($_POST['city']);
$contact	= $_POST['contact'];
$email		= $_POST['email'];
$bod		= $_POST['BOD'];
$custid		= $_POST['custid'];

$update		= $_POST['update'];

session_name('err');
session_name('alert');
$_SESSION['err'] = $err;
$_SESSION['alert'] = $alert;

if (isset($update))
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
		$err .= "<li>Silahkan isi username anda.</li>";
		$error++;
	}
	
	// Lets check to see if the username already exists
	$query  = "SELECT Username FROM t_user WHERE Username = '$username'";
	$queryy = "SELECT Username FROM t_user WHERE Username = '$username' AND CustID = '$custid'";
	$check  = mysql_query($query);
	$checkk = mysql_query($queryy);
	$existUsername = mysql_num_rows($check);
	$isUser = mysql_fetch_array($checkk);
	
	if ($isUser['Username'] != $username)
	{
		if($existUsername > 0)
		{
			$err .= "<li>Username yang anda isi telah ada. Mohon pilih yang lain.</li>";
			$error++;
		}
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
	$query2 = "SELECT Email FROM t_customer WHERE Email = '$email' AND CustID = '$custid'";
	$check1 = mysql_query($query1);
	$check2 = mysql_query($query2);
	$existEmail = mysql_num_rows($check1);
	$isEmail = mysql_fetch_array($check2);
	
	if ($isEmail['Email'] != $email)
	{
		if($existEmail > 0)
		{
			$err .= "<li>Email telah ada.</li>";
			$error++;
		}
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
		$uCustomer  = "UPDATE t_customer";
		$uCustomer .= " SET CustName = '$name', CustAdd = '$address', City = '$city', CustContact = '$contact', Email = '$email', Birthdate = '$bod'";
		$uCustomer .= " WHERE CustID = '$custid'";
		
		$uUser  = "UPDATE t_user";
		$uUser .= " SET Username = '".ucwords($username)."', Password = '$password'";
		$uUser .= " WHERE CustID = '$custid'";
		
		$result1 = mysql_query($uCustomer);
		$result2 = mysql_query($uUser);
		
		if ($result1)
		{
			if ($result2)
			{
				$alert .= "<script type='text/javascript'>window.alert('Update informasi user berhasil.')</script>";
				header ("location: http:profil.php");
			}
			else
			{
				$alert .= "<script type='text/javascript'>window.alert('Update informasi user gagal. Mohon coba lagi.')</script>";
				header ("location: http:ubahuserglobal.php");
			}
		}
		else
		{
			$alert .= "<script type='text/javascript'>window.alert('Update informasi user gagal. Mohon coba lagi.')</script>";
			header ("location: http:ubahuserglobal.php");
		}
	}
	else
	{
		$alert .= "<script type='text/javascript'>window.alert('Update informasi user gagal.')</script>";
		header ("location: http:ubahuserglobal.php");
	}
}

mysql_close();
pgFooter();
?>
