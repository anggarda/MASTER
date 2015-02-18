<?php
require('pustaka.php');
connectDB();
isValidSession();

pgHeader('Fokus | Konfirmasi2');

$submit		 = $_POST['submit'];

if (isset($submit))
{
	echo insertOrder();
	echo insertCart();

}
$province = $_SESSION['province'];

$sql = "SELECT * FROM t_province WHERE Province = '$province'";
$result = mysql_query($sql);
$type   = mysql_fetch_array($result);

$duration = $type['Duration'];

echo '<table align="center" width="550">
		<tr>
			<td align="center"><img src="picture/sukses.gif" width="250" height="40" /></td>
		</tr>
		<tr>
			<td>
				<p>
					<br />
					Anda telah berhasil melakukan pemesanan.
					Pengiriman barang anda akan tiba lakukan setelah pembayaran diterima.
					Anda dapat menghubungi kami mengenai status pesanan anda jika barang belum tiba di tujuan dalam periode yang ditentukan.
				</p>
				<p><h2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp <u><a href="index.php">TERIMA KASIH</a></u></h2></p>
			</td>
		</tr>
		
		</table>';
		


session_unregister('cart');
mysql_close();
pgFooter();
?>