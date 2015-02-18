<?php
require('pustaka.php');
isValidSession();
connectDB();

pgHeader('PT.Tomo Lestari Citra | Hapus Provinsi');

session_name('alert');
$_SESSION['alert'] = $alert;

$provid = $_GET['id'];

$sql    = "DELETE FROM t_province WHERE Province = '$provid'";
$result = mysql_query($sql);

if ($result)
{
	$alert .= "<script type='text/javascript'>window.alert('Hapus provinsi berhasil.')</script>";
}
else
{
	$alert .= "<script type='text/javascript'>window.alert('Hapus provinsi gagal. Mohon coba lagi.')</script>";
}

header ("location: http:admin_lihatprovinsi.php");
mysql_close();
pgFooter();
?>