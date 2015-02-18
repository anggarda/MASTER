<?php
require('pustaka.php');
connectDB();
isValidSession();

pgHeader('PT.Tomo Lestari Citra | Ubah Transaksi1');

$status  = $_POST['status'];
$orderid = $_POST['orderid'];

$update	 = $_POST['update'];

session_name('alert');
$_SESSION['alert'] = $alert;

if (isset($update))
{
	$sql  = "UPDATE t_order";
	$sql .= " SET OrderStatus = '$status'";
	$sql .= " WHERE OrderID = '$orderid'";
	
	$result = mysql_query($sql);
	
	if ($result)
	{
		$alert .= "<script type='text/javascript'>window.alert('Update status berhasil.')</script>";
		header ("location: http:admin_lihattransaksi.php");
	}
	else
	{
		$alert .= "<script type='text/javascript'>window.alert('Update status gagal. Mohon coba lagi.')</script>";
		header ("location: http:admin_ubahtransaksi.php");
	}
}
else 
{
	$alert .= "<script type='text/javascript'>window.alert('Update status gagal. Mohon coba lagi.')</script>";
	header ("location: http:admin_ubahtransaksi.php");
}

mysql_close();
pgFooter();
?>