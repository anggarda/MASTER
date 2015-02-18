<?php
require('pustaka.php');
connectDB();
isValidSession();

pgHeader('PT.Tomo Lestari Citra | Lihat Transaksi1');

$page   = $_GET['page'];
$custid = $_SESSION['custid'];

$sql     = "SELECT * FROM t_order WHERE CustID = '$custid' ORDER BY OrderID DESC";
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
$check   = mysql_num_rows($result2);

echo '<p align="center"><img src="picture/orderhistory.gif" width="250" height="40" /></p>';

if ($check != 0)
{
echo '<table border="1" cellspacing="0" cellpadding="3" align="center" width="550">';

echo '<tr>
		<td width="60" align="center">&nbsp;</td>
		<td width="80" align="center">Tanggal Pesan</td>
		<td width="130" align="center">Nama Penerima</td>
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
			<td align="center" width=""><a href="lihatpesananglobal.php?id='.$type['OrderID'].'">Lihat</a></td>
			<td align="center">'.$dates.'</td>
			<td>'.$type['DeliverName'].'</td>
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
      	</tr>
	</table>';
}
else
{
	echo '<p align="center" style="font-size:22"><br />Tidak ada transaksi!</p>';
}

$alert = $_SESSION['alert'];
if ($alert)
{
	echo $alert;
}

session_unregister('alert');
mysql_close();
pgFooter();
?>
