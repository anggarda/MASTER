<?php

$db_server = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "rjl";

$conn = mysql_connect($db_server, $db_user, $db_pass);

if($conn)
{
	$conn_db = mysql_select_db($db_name,$conn);
	if ($conn_db){}
	else
	{
		die("Could not find database".mysql_error()); 
	}
}
else
{
	die("Could not connect".mysql_error());
}

?>
