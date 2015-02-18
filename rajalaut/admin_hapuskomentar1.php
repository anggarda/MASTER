<?php
require('pustaka.php');
isValidSession();
connectDB();

session_name('alert');
$_SESSION['alert'] = $alert;

$commentid = $_POST['commentID'];

$sql    = "DELETE FROM t_feedback WHERE CommentID = $commentid";
mysql_query($sql);

if (mysql_affected_rows() == 1)
{
	$alert .= "<script type='text/javascript'>window.alert('Hapus komentar berhasil.')</script>";
}
else
{
	$alert .= "<script type='text/javascript'>window.alert('Hapus komentar gagal. Mohon coba lagi.')</script>";
}

header ("location: http:admin_hapuskomentar.php");
mysql_close();

pgFooter();
?>