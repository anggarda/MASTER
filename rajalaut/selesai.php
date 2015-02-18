<?php
require('pustaka.php');
connectDB();
isValidSession();

pgHeader('Fokus | Selesai');

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
					Barang anda akan tiba sekitar ';
					echo $duration;
					echo ' hari.
					Anda dapat menghubungi kami mengenai status pesanan anda, jika barang belum tiba di tujuan.
				</p>
				<p><h2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>TERIMA KASIH</u></h2></p>
			</td>
		</tr>
		
		</table>';
		

mysql_close();
pgFooter();
?>