<?php
require('pustaka.php');
isValidSession();
pgHeader('PT.Tomo Lestari Citra | Tambah Produk');
?>

<form id="addproduct" name="addproduct" method="post" action="admin_tambahproduk1.php" enctype="multipart/form-data">
<table width="490" align="center" border="0">
<tr>
	<td>
		<table>
			<tr>
				<td colspan="2" align="center"><img src="picture/tambahproduk.gif" width="250" height="40" /></td>
			</tr>
			<tr>
				<td width="120">Tipe Produk :</td>
				<td width="230"><input type="text" name="prodtype" size="30" /></td>
			</tr>
			<tr>
				<td valign="top">Merek produk :</td>
				<td><input type="text" name="prodbrand" size="30" /></td>
			</tr>
			<tr>
				<td>Nama Produk :</td>
				<td><input type="text" name="prodname" size="30" /></td>
			</tr>
			<tr>
				<td>Gambar Produk :</td>
				<td><input type="file" name="prodimage" size="18" style="background:#FFFFFF"/></td>
			</tr>
			<tr>
				<td>Harga :</td>
				<td><input type="text" name="price" size="15" /></td>
			</tr>
			<tr>
				<td>Stock :</td>
				<td><input type="text" name="stock" size="15" /></td>
			</tr>
			<tr>
				<td>Deskripsi :</td>
				<td><input type="text" name="desc" size="30" /></td>
			</tr>
			<tr>
				<td valign="top">Rincian :</td>
				<td><textarea cols="40" rows="10" name="details"></textarea></td>
			</tr>
		</table>
	</td>
</tr>
<tr>
	<td colspan="2" align="center">
		<br/>
		<input type="submit" value="Simpan" name="save" style="background:url(picture/background1.gif); border:outset; color:#000000"/>
		<input type="reset" value="Reset" style="background:url(picture/background1.gif); border:outset; color:#000000"/>
	</td>												
</tr>
<tr><td  align="center"><br/><a href="admin_lihatproduk.php">Kembali</a></td></tr>	

<tr>
	<td>
		<?php
		$err = $_SESSION['err'];
		$alert = $_SESSION['alert'];
		if ($err)
		{
			echo "<div class='error'><ul>$err</ul></div>";
		}
		else
		{
			echo "$alert";
		}
		?>
	</td>
</tr>

</table>
</form>

<?php
session_unregister('err');
session_unregister('alert');

pgFooter();
?>