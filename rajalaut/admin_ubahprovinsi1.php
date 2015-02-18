<?php
require('pustaka.php');
connectDB();
isValidSession();
pgHeader('Fokus | Ubah Provinsi1');

$province   = $_POST['provid'];
$delprice   = $_POST['delprice'];
$duration   = $_POST['duration'];

$update	  = $_POST['update'];

session_name('err');
session_name('alert');
$_SESSION['err'] = $err;
$_SESSION['alert'] = $alert;

if (isset($update))
{
	$error = 0;
	
	/********** validate form **********/
	// validate delprice
	if (!empty ($delprice))
	{
		if (!ereg ("^[0-9]{4,}$", $delprice))
		{
			$err .= "<li>Harga pengiriman harus diisi dengan angka.</li>";
			$error++;
		}
	}
	else
	{
		$err .= "<li>Silahkan isi harga pengiriman.</li>";
		$error++;
	}
	
	// validate duration
	if (!empty ($duration))
	{
		if (!ereg ("^[0-9 -]{1,}$", $duration))
		{
			$err .= "<li>Durasi harus diisi dengan angka.</li>";
			$error++;
		}
	}
	else
	{
		$err .= "<li>Silahkan isi durasi.</li>";
		$error++;
	}
	
	if ($error == 0)
	{
		/********** update news **********/
		$uProv  = "UPDATE t_province";
		$uProv .= " SET DelPrice = '$delprice', Duration = '$duration'";
		$uProv .= " WHERE Province = '$province'";
				
		$result = mysql_query($uProv);
		
		if ($result)
		{
			$alert .= "<script type='text/javascript'>window.alert('Update provinsi berhasil.')</script>";
			header ("location: http:admin_lihatprovinsi.php");
		}
		else
		{
			$alert .= "<script type='text/javascript'>window.alert('Update provinsi gagal. Mohon coba lagi.')</script>";
			header ("location: http:admin_ubahprovinsi.php");
		}
	}
	else
	{
		$alert .= "<script type='text/javascript'>window.alert('Update provinsi gagal. Mohon coba lagi.')</script>";
		header ("location: http:admin_ubahprovinsi.php");
	}
}

mysql_close();
pgFooter();
?>