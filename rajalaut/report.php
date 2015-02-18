<?php
require('pustaka.php');
connectDB();
isValidSession();

pgHeader('CV.Astra Batam| Lihat Laporan Bulanan');

$lastd_month = date('t');
$year = date('Y');
$month = date('m');

$this_my = date('F Y')
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Monthly Reports</title>
</head>

<body>
<table width="642" height="250" border="2" align="center" cellpadding="1" cellspacing="1" bordercolor="#000000" >
  
  <tr >
   
    <td>
           
    <h2>Sales Transactions Report</h2>
    <h3>Total Transactions in <?php echo $this_my; ?> : <?php echo $row; ?> Transactions</font></div>
    <p>&nbsp;</p><div id="list"><?php include 'report_show.php'; ?></h3>
</div>
<div align="center"><a href="profil.php">Back</a></div>
    </table>
<?php
$alert = $_SESSION['alert'];
if ($alert)
{
	echo $alert;
}

session_unregister('alert');
mysql_close();
pgFooter();

?>
</td>
  </tr></table>

</body>

</html>
