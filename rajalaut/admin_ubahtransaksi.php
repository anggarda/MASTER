<?php
require('pustaka.php');
connectDB();
isValidSession();

pgHeader('CV.Astra Batam | Ubah Transaksi');

$orderid  = $_GET['id'];

echo '<form method="post" action="admin_ubahtransaksi1.php">
	<table align="center" width="550">
		<tr>
			<td align="center"><p align="center" style="font-size:24px">Ubah Transaksi</p></td>
		</tr>';

$sql    = "SELECT * FROM t_order, t_customer WHERE OrderID = '$orderid' AND t_order.CustID = t_customer.CustID ORDER BY OrderDate DESC";
$result = mysql_query($sql);

while ($type = mysql_fetch_array($result))
{
	$date   = $type['OrderDate'];
	$dates  = date("d-m-Y",strtotime($date));
	$grandtotal  = number_format($type['Grandtotal']);
	$grandtotals = str_replace(',','.',$grandtotal);
	$status = $type['OrderStatus'];
	
echo '<tr>
		<td>
		<table width="400" align="center">
		<tr>
			<td><hr/></td>
		</tr>
		<tr>
			<td>
				<table align="center" width="300" cellpadding="3">
					<tr>
						<td valign="top" width="140">Tanggal Pesan:</td>
						<td width="160">'.$dates.'</td>
					</tr>
					<tr>
						<td>Nama Customer:</td>
						<td>'.$type[CustName].'</td>
					</tr>
					<tr>
						<td>Kontak Customer:</td>
						<td>'.$type[CustContact].'</td>
					</tr>
					<tr>
						<td>Nama Penerima:</td>
						<td>'.$type[DeliverName].'</td>
					</tr>
					<tr>
						<td valign="top">Alamat Penerima:</td>
						<td>'.nl2br($type[DeliverAdd]).'</td>
					</tr>
					<tr>
						<td>Kota Penerima:</td>
						<td>'.$type[DeliverCity].'</td>
					</tr>
					<tr>
						<td>Provinsi:</td>
						<td>'.$type[Province].'</td>
					</tr>
										<tr>
						<td>Grandtotal:</td>
						<td>Rp&nbsp;'.$grandtotals.',-</td>
					</tr>
					<tr>
						<td>Status:</td>
						<td>
							<select name="status">
								<option selected>'.$status.'</option>';
								
								if ($status == "Pending")
								{
									echo '<option value="Paid">Paid</option>';
									echo '<option value="Delivered">Delivered</option>';
									echo '<option value="Cancelled">Cancelled</option>';
								}
								elseif ($status == "Paid")
								{
									echo '<option value="Pending">Pending</option>';
									echo '<option value="Delivered">Delivered</option>';
									echo '<option value="Cancelled">Cancelled</option>';
								}
								elseif ($status == "Delivered")
								{
									echo '<option value="Pending">Pending</option>';
									echo '<option value="Paid">Paid</option>';
									echo '<option value="Cancelled">Cancelled</option>';
								}
								elseif ($status == "Cancelled")
								{
									echo '<option value="Pending">Pending</option>';
									echo '<option value="Paid">Paid</option>';
									echo '<option value="Delivered">Delivered</option>';
								}
					echo '</select>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td><hr/></td>
		</tr>
		<tr>
			<td align="center">
				<input type="hidden" name="orderid" value="'.$type[OrderID].'"/>
				<input type="submit" value="Update" name="update" style="background:url(picture/background1.gif); border:outset; color:#000000"/>
			</td>
		</tr>
		<div align="center"><a href="profil.php">Back</a></div>
		</table>
	</td>
	</tr>';
}
echo '</table>';
echo '</form>';

$alert = $_SESSION['alert'];
if ($alert)
{
	echo $alert;
}

session_unregister('alert');
mysql_close();
pgFooter();
?>