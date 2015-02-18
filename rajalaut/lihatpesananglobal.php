<?php
require('pustaka.php');
connectDB();
isValidSession();

pgHeader('CV.Astra Batam | View Order');

$oid  = $_GET['id'];

$sql  = "SELECT * FROM t_order, t_customer";
$sql .= " WHERE OrderID = '$oid' AND t_customer.CustID = t_order.CustID";
$sql .= " ORDER BY OrderDate DESC";

$result = mysql_query($sql);
$type   = mysql_fetch_array($result);

$date  = $type['OrderDate'];
$dates = date("d-m-Y",strtotime($date));

echo '<table align="center" width="550">
		<tr>
			<td align="center"><img src="picture/lihatpesanan1.gif" width="250" height="40" /><br /><br /></td>
			
			</tr>
		<tr>
			<td>Order Date:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$dates.'</td>
		</tr>
		<tr>
			<td><br />';
				echo viewOrder();
		echo '<br /></td>
		</tr>
	<tr>
		<td>
			<table width="550" border="1" cellspacing="0" align="center">
				<tr>
					<td width="270">
						<table align="center" width="260" cellpadding="2" cellspacing="0">
							<tr>
								<td colspan="2" align="center"><u>Customer Information</u><br /><br /></td>
							</tr>
							<tr>
								<td width="80">Name :</td>
								<td width="180">'.$type[CustName].'</td>
							</tr>
							<tr>
								<td valign="top">Address :</td>
								<td>'.nl2br($type[CustAdd]).'</td>
							</tr>
							<tr>
								<td>City :</td>
								<td>'.$type[City].'</td>
							</tr>
							<tr>
								<td>Contact No:</td>
								<td>'.$type[CustContact].'</td>
							</tr>	
						</table>
					</td>
 					<td width="270" valign="top">
						<table align="center" width="260" cellpadding="2" cellspacing="0">
							<tr>
								<td colspan="2" align="center"><u>Delivery Information</u><br /><br /></td>
							</tr>
							<tr>
								<td width="80">Name :</td>
								<td width="180">'.$type[DeliverName].'</td>
							</tr>
							<tr>
								<td valign="top">Address :</td>
								<td>'.nl2br($type[DeliverAdd]).'</td>
							</tr>
							<tr>
								<td>City :</td>
								<td>'.$type[DeliverCity].'</td>
							</tr>
							<tr>
								<td>Province :</td>
								<td>'.$type[Province].'</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td><br />Payment transfer to:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Bank '.$type[Payment].'</td>
		<div align="center"><a href="admin_lihattransaksi.php">Back</a></div>
	</tr>
</table>';

mysql_close();
pgFooter();
?>