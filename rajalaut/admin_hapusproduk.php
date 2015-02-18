<?php
require('pustaka.php');
isValidSession();
connectDB();

session_name('alert');
$_SESSION['alert'] = $alert;

pgHeader('PT.Tomo Lestari Citra | Hapus Produk');

$prodid = $_POST['prodid'];

$sql    = "SELECT * FROM t_product, t_cart WHERE t_cart.ProdID = '$prodid' AND t_cart.ProdID = t_product.ProdID";
$result = mysql_query($sql);
$check  = mysql_num_rows($result);

if ($check == 0)
{
	$del = "DELETE FROM t_product WHERE ProdID = $prodid";
	$res = mysql_query($del);
	
	if (mysql_affected_rows() == 1)
	{
		$alert .= "<script type='text/javascript'>window.alert('Hapus produk berhasil.')</script>";
	}
	else
	{
		$alert .= "<script type='text/javascript'>window.alert('Hapus produk gagal. Mohon coba lagi.')</script>";
	}
}
else
{
	$alert .= "<script type='text/javascript'>window.alert('Data tidak bisa dihapus karena masih diperlukan.')</script>";
}

header ("location: http:admin_lihatproduk.php");
mysql_close();
pgFooter();
?>