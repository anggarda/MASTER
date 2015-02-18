<?php
require('pustaka.php');
connectDB();
isValidSession();

pgHeader('PT.Tomo Lestari Citra | Ubah Produk1');

$prodtype	= $_POST['prodtype'];
$prodbrand	= $_POST['prodbrand'];
$prodname   = $_POST['prodname'];
$prodimage  = $_FILES['prodimage']['name'];
$desc		= $_POST['desc'];
$price		= $_POST['price'];
$stock		= $_POST['stock'];
$satuan		= $_POST['satuan'];
$details    = $_POST['details'];
$prodid		= $_POST['prodid'];

$update		= $_POST['update'];

session_name('err');
session_name('alert');
$_SESSION['err'] = $err;
$_SESSION['alert'] = $alert;

if (isset($update))
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
		$err .= "<li>Silahkan isi harga.</li>";
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
		if (!$prodimage)
		{
			$uProduct  = "UPDATE t_product";
			$uProduct .= " SET ProdType = '$prodtype', ProdBrand = '$prodbrand', ProdName = '$prodname', Description = '$desc', Price = '$price', Details = '$details', Stock = '$stock', satuan= '$satuan'";
			$uProduct .= " WHERE ProdID = '$prodid'";
		}
		else
		{
			$prodimages = $_FILES['prodimage']['tmp_name'];
			$path  = "image/";
			$paths = $path . basename($prodimage); 
			move_uploaded_file($prodimages, $paths);
			
			$uProduct  = "UPDATE t_product";
			$uProduct .= " SET ProdType = '$prodtype', ProdBrand = '$prodbrand', ProdName = '$prodname', ProdImage = '$prodimage', Description = '$desc', Price = '$price', Details = '$details', Stock = '$stock'";
			$uProduct .= " WHERE ProdID = '$prodid'";
		}
		
		$result = mysql_query($uProduct);
		
		if ($result)
		{
			$alert .= "<script type='text/javascript'>window.alert('Update produk berhasil.')</script>";
			header ("location: http:admin_lihatproduk.php");
		}
		else
		{
			$alert .= "<script type='text/javascript'>window.alert('Update produk gagal. Mohon coba lagi.')</script>";
			header ("location: http:admin_ubahproduk.php");
		}
	}
	else 
	{
		$alert .= "<script type='text/javascript'>window.alert('Update produk gagal.')</script>";
		header ("location: http:admin_ubahproduk.php");
	}
}

mysql_close();
pgFooter();
?>