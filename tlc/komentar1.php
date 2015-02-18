<?php
require('pustaka.php');
connectDB();

pgHeader('Fokus | Komentar1');

$name		= ucwords($_POST['name']);
$email		= $_POST['email'];
$comments  	= ucfirst($_POST['comments']);

$submit		= $_POST['submit'];

session_name('err');
session_name('alert');
$_SESSION['err'] = $err;
$_SESSION['alert'] = $alert;

$today = date("Y-m-d");

if (isset($submit))
{
	$error = 0;
	
	/********** validate form **********/
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
	
	// Lets check to see if the name already exists
	//$query = "SELECT name FROM t_feedback WHERE name = '$name'";
	//$check = mysql_query($query);
	
	//$existname = mysql_num_rows($check);
	
	//if($existname > 0)
	//{
	//	$err .= "<li>Nama yang anda isi telah ada. Mohon pilih yang lain.</li>";
	//	$error++;
	//}

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
	
	// validate comments
	if (empty ($comments))
	{
		$err .= "<li>Silahkan isi komentar anda.</li>";
		$error++;
	}
	
	if ($error == 0)
	{
		/********** insert data **********/
		$iFeedback  = "INSERT INTO t_feedback VALUES ";
		$iFeedback .= " (null, '$name', '$email', '$comments', '$today')";
		
		mysql_query($iFeedback);
			
		if (mysql_affected_rows() == 1)
		{
			$alert .= "<script type='text/javascript'>window.alert('Terima kasih atas komentarnya.')</script>";
		}
		else
		{
			$alert .= "<script type='text/javascript'>window.alert('Komentar error. Mohon coba lagi.')</script>";
		}
	}
	else
	{
		$alert .= "<script type='text/javascript'>window.alert('Komentar error. Mohon coba lagi.')</script>";
	}
}

mysql_close();
header ("location: http:komentar.php");
pgFooter();
?>