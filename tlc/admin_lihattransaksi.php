<?php
require('pustaka.php');
connectDB();
isValidSession();

pgHeader('PT.Tomo Lestari Citra | Lihat Transaksi');

$page = $_GET['page'];

$sql     = "SELECT * FROM t_order, t_customer WHERE t_order.CustID = t_customer.CustID ORDER BY OrderID DESC";
$result1 = mysql_query($sql);
$rows 	 = mysql_num_rows($result1);
$ceils   = ceil($rows/15);

if ($page == 0)
{
	$page = 1;
}
elseif ($page > $ceils)
{
	$page = 1;
}
$first = ($page-1)*15;

$result2 = mysql_query($sql." LIMIT $first,15");

echo '<p align="center"><img src="picture/lihattransaksi.gif" width="250" height="40" /></p>';
echo '<table border="1" cellspacing="0" cellpadding="3" align="center" width="550">';
echo '<tr>
		<td width="60" align="center">Proses</td>
		<td width="80" align="center">Tanggal pesan</td>
		<td width="130" align="center">Nama Customer</td>
		<td width="100" align="center">Grand Total</td>
		<td width="80" align="center">Status</td>
	</tr>';
	while ($type = mysql_fetch_array($result2))
	{
		$date  = $type['OrderDate'];
		$dates = date("d-m-Y",strtotime($date));
		$grandtotal  = number_format($type['Grandtotal']);
		$grandtotals = str_replace(',','.',$grandtotal);
		
	echo '<tr>
			<td align="center" width="">
				<a href="lihatpesananglobal.php?id='.$type['OrderID'].'">Lihat</a><br />
				<a href="admin_ubahtransaksi.php?id='.$type['OrderID'].'">Ubah</a><br/>
				</td>
			<td align="center">'.$dates.'</td>
			<td>'.$type['CustName'].'</td>
			<td align="right">Rp&nbsp;'.$grandtotals.',-</td>
			<td>'.$type['OrderStatus'].'</td>
		 </tr>';
	}

	
echo	'<tr>
			<td colspan="7" align="right" width="530">Page: ';
        	
			for ($i=1;$i<=$ceils;$i++)
			{
				if ($i==1) echo ("[ ");
				if ($page!=$i) echo "<a href=admin_lihattransaksi.php?page=$i>";
				echo "$i</a>";
				if ($i==$ceils)echo (" ]");
				else echo (" | ");
			} 
echo 		'</td>
<div align="center"><a href="profil.php">Back</a></div>
      	</tr>
	</table>';

$alert = $_SESSION['alert'];
if ($alert)
{
	echo $alert;
}

session_unregister('alert');
mysql_close();
pgFooter();
?>