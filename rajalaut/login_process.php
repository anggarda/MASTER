<?php
require('pustaka.php');
connectDB();

$username	= $_POST['username'];
$password	= $_POST['password'];

session_name('err');
$_SESSION['err'] = $err;

$sql = "SELECT * FROM t_user WHERE username = '$username' AND password = '$password'";

$result = mysql_query($sql);
$row 	= mysql_num_rows($result);

// If they do match, begin the session and go to the main menu page
if ($row == 1)
{
	$type 	  = mysql_fetch_row($result);
	$custid   = $type[2];
	$userType = $type[3];
	
	$_SESSION['usertype'] = $userType;
	$_SESSION['username'] = $username;
	$_SESSION['custid']   = $custid;
	header ("location: http:profil.php");
}
else
{	// If they don’t match, display the error and the login form again
	$err .= "Login gagal. Mohon coba lagi!";
	header ("location: http:login.php");
}

mysql_close();
?>