<?php
require('pustaka.php');
connectDB();
isValidSession();

pgHeader('CV.Astra Batam | Account');

echo '<table align="center" width="550">
		<tr>
			<td align="center"><img src="picture/myacc.gif" width="250" height="50" /></td>
		</tr>';

$alert = $_SESSION['alert'];
if ($alert)
{
	echo "$alert";
}

$custid = $_SESSION['custid'];


$sql    = "SELECT * FROM t_customer, t_user WHERE t_customer.CustID = '$custid' AND t_user.CustID = t_customer.CustID";
$result = mysql_query($sql);

while ($type = mysql_fetch_array($result))
{
	$username = $type['Username'];
	$lower = strtolower($username);
	$first = ucwords($lower);
	
	$date  = $type['Birthdate'];
	$dates = date("d-m-Y",strtotime($date));
echo '<tr>
		<td>
		<table width="400" align="center">
		<tr>
			<td align="left" style="font-size:16;">
				Selamat Datang, '.$first.'.
			</td>
		</tr>
		<tr>
			<td><hr/></td>
		</tr>
		<tr>
			<td>
				<table align="center" width="350" cellpadding="3">
					<tr>
						<td width="100">Nama :</td>
						<td width="200">'.$type[CustName].'</td>
					</tr>
					<tr>
						<td valign="top">Alamat :</td>
						<td>'.nl2br($type[CustAdd]).'</td>
					</tr>
					<tr>
						<td>Kota :</td>
						<td>'.$type[City].'</td>
					</tr>
					<tr>
						<td>No.Kontak :</td>
						<td>'.$type[CustContact].'</td>
					</tr>
					<tr>
						<td>Email :</td>
						<td>'.$type[Email].'</td>
					</tr>
					<tr>
						<td>Tgl Lahir :</td>
						<td>'.$dates.'</td>
					</tr>			
				</table>
			</td>
		</tr>
		<tr>
			<td><hr/></td>
		</tr>
		</table>
	</td>
	</tr>';
}

if ($_SESSION['usertype'] == 'Cust')
{
	echo '<tr><td align="center"><a href="ubahuserglobal.php"> Modifikasi Data Pribadi </a></td></tr>';
	echo '<tr><td align="center"><a href="lihattransaksiuser.php"> History Pemesanan </a></td></tr>';
}

if ($_SESSION['usertype'] == 'Admin')
{
	
	echo '<tr><td align="center"><a href="admin_hapuskomentar.php"> Modifikasi Komentar </a></td></tr>';
	echo '<tr><td align="center"><a href="admin_lihatuser.php"> Modifikasi User </a></td></tr>';
	echo '<tr><td align="center"><a href="admin_lihatproduk.php"> Modifikasi Produk </a></td></tr>';
	echo '<tr><td align="center"><a href="admin_lihatprovinsi.php"> Modifikasi Provinsi </a></td></tr>';
	echo '<tr><td align="center"><a href="admin_lihattransaksi.php"> Modifikasi Transaksi </a></td></tr>';
	echo '<tr><td align="center"><a href="report.php"> Laporan bulanan </a></td></tr>';
	echo '<tr><td align="center"><a href="pending3.php"> Transaksi Pending </a></td></tr>';
}
echo '</table>';

session_unregister('alert');
pgFooter();
?>