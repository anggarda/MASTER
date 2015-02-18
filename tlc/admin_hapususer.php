<?php
require('pustaka.php');
isValidSession();
connectDB();

session_name('alert');
$_SESSION['alert'] = $alert;
$username = $_GET['cid'];
pgHeader('PT.Tomo Lestari Citra | Hapus user');

$prodid = $_POST['prodid'];

	$del = "DELETE FROM t_user WHERE Username = '$username'";
	$res = mysql_query($del);
	
	if (mysql_affected_rows() == 1)
	{
		$alert .= "<script type='text/javascript'>window.alert('Hapus user berhasil.')</script>";
	}
	else
	{
		$alert .= "<script type='text/javascript'>window.alert('Hapus user gagal. Mohon coba lagi.')</script>";
	}

header ("location: http:admin_lihatuser.php");

mysql_close();
pgFooter();
?>