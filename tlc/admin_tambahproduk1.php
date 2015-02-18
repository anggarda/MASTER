<?php
require('pustaka.php');
connectDB();
isValidSession();
pgHeader('PT.Tomo Lestari Citra| Tambah Produk1');

$prodtype	= $_POST['prodtype'];
$prodbrand	= $_POST['prodbrand'];
$prodname   = $_POST['prodname'];
$prodimage	= $_FILES['prodimage']['name'];
$desc		= $_POST['desc'];
$price		= $_POST['price'];
$stock		= $_POST['stock'];
$details	= $_POST['details'];

$save		= $_POST['save'];

session_name('err');
session_name('alert');
$_SESSION['err'] = $err;
$_SESSION['alert'] = $alert;

if (isset($save))
{
	$error = 0;
	
	/********** validate form **********/
	// validate prodtype
	if (!empty ($prodtype))
	{
		if (!ereg ("^[A-Za-z ]+$", $prodtype))
		{
			$err .= "<li>Tipe produk harus diisi dengan huruf.</li>";
			$error++;
		}
	}
	else
	{
		$err .= "<li>Silahkan isi tipe produk.</li>";
		$error++;
	}
	
	// validate prodbrand
	if (empty ($prodbrand))
	{
		$err .= "<li>Silahkan isi merek produk.</li>";
		$error++;
	}
	
	// validate prodname
	if (empty ($prodname))
	{
		$err .= "<li>Silahkan isi nama produk.</li>";
		$error++;
	}
	
	// validate prodimage
	if (empty ($prodimage))
	{
		$err .= "<li>Silahkan isi gamabar produk.</li>";
		$error++;
	}
	
	// validate price
	if (!empty ($price))
	{
		if (!ereg ("^[0-9]{4,}$", $price))
		{
			$err .= "<li>Harga harus diisi dengan angka.</li>";
			$error++;
		}
	}
	else
	{
		$err .= "<li>PSilahkan isi harga produk.</li>";
		$error++;
	}
	
	// validate stock
	if (!empty ($stock))
	{
		if (!ereg ("^[0-9]{1,}$", $stock))
		{
			$err .= "<li>Stock harus diisi dengan angka.</li>";
			$error++;
		}
	}
	else
	{
		$err .= "<li>Silahkan isi stock.</li>";
		$error++;
	}
	
	// validate desc
	if (empty ($desc))
	{
		$err .= "<li>Silahkan isi deskripsi produk.</li>";
		$error++;
	}
	
	// validate details
	if (empty ($details))
	{
		$err .= "<li>Silahkan isi rincian produk.</li>";
		$error++;
	}
		
	if ($error == 0)
	{
		$prodimages = $_FILES['prodimage']['tmp_name'];
		$path  = "picture/";
		$paths = $path . basename($prodimage); 
		move_uploaded_file($prodimages, $paths);
		
		/********** insert data **********/
		
		$iProduct  = "INSERT INTO t_product VALUES ";
		$iProduct .= " (null, '$prodtype', '$prodbrand', '$prodname', '$prodimage', '$desc', '$price', '$details', '$stock', '$satuan')";
		
		mysql_query($iProduct);
		
		if (mysql_affected_rows() == 1)
		{
			$alert .= "<script type='text/javascript'>window.alert('Tambah produk berhasil.')</script>";
			header ("location: http:admin_lihatproduk.php");
		}
		else
		{
			$alert .= "<script type='text/javascript'>window.alert('Tambah produk gagal. Mohon coba lagi.')</script>";
			header ("location: http:admin_tambahproduk.php");
		}
		
	}
	else 
	{
		$alert .= "<script type='text/javascript'>window.alert('Tambah produk gagal. Mohon coba lagi.')</script>";
		header ("location: http:admin_tambahproduk.php");
	}
}

mysql_close();
pgFooter();
?>