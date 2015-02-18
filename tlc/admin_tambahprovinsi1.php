<?php
require('pustaka.php');
connectDB();
isValidSession();

pgHeader('PT.Tomo Lestari Citra | Tambah provinsi1');

$province  = ucwords($_POST['province']);
$delprice  = $_POST['delprice'];
$duration  = $_POST['duration'];

$save     = $_POST['save'];

session_name('err');
session_name('alert');
$_SESSION['err'] = $err;
$_SESSION['alert'] = $alert;

if (isset($save))
{
	$error = 0;
	
	/********** validate form **********/
	// validate province
	if (!empty ($province))
	{
		if (!ereg ("^[A-Za-z ]+$", $province))
		{
			$err .= "<li>Provinsi harus diisi dengan huruf.</li>";
			$error++;
		}
	}
	else
	{
		$err .= "<li>Silahkan isi provinsi.</li>";
		$error++;
	}
	
	// Lets check to see if the province already exists
	$query = "SELECT Province FROM t_province WHERE Province = '$province'";
	$check = mysql_query($query);
	
	$existProvince = mysql_num_rows($check);
	
	if($existProvince > 0)
	{
		$err .= "<li>Provinsi sudah ada.</li>";
		$error++;
	}
	
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
		/********** insert data **********/
		$iProv  = "INSERT INTO t_province VALUES ";
		$iProv .= " ('$province', '$delprice', '$duration')";
		
		mysql_query($iProv);
		
		if (mysql_affected_rows() == 1)
		{
			$alert .= "<script type='text/javascript'>window.alert('Tambah provinsi berhasil.')</script>";
			header ("location: http:admin_lihatprovinsi.php");
		}
		else
		{
			$alert .= "<script type='text/javascript'>window.alert('Tambah provinsi gagal. Mohon coba lagi.')</script>";
			header ("location: http:admin_lihatprovinsi.php");
		}
		
	}
	else 
	{
		$alert .= "<script type='text/javascript'>window.alert('Tambah provinsi gagal. Mohon coba lagi.')</script>";
		header ("location: http:admin_tambahprovinsi.php");
	}
}

mysql_close();
pgFooter();
?>