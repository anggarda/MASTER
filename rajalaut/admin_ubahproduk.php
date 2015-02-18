<?php
require('pustaka.php');
connectDB();
isValidSession();

pgHeader('PT.Tomo Lestari Citra | Ubah Produk');

if (isset($_POST['prodid']))
{
	$prodoid = $_POST['prodid'];
	$_SESSION['prodoid'] = $prodoid;
}
else
{
	$prodoid = $_SESSION['prodoid'];
}

echo '<form method="post" action="admin_ubahproduk1.php" enctype="multipart/form-data">
	<table width="400" align="center" cellpadding="3">
		<tr>
			<td colspan="2" align="center"><p align="center" style="font-size:24px">Ubah Produk</p><br/><br/></td>
		</tr>';

$sql    = "SELECT * FROM t_product WHERE ProdID = '$prodoid'";
$result = mysql_query($sql);

while ($type = mysql_fetch_array($result))
{
	echo '<tr>
			<td width="160" align="right">Tipe Produk :</td>	
	<td width="200"><input type="text" name="prodtype" size="30" value="'.$type[ProdType].'" /></td>
		</tr>
		<tr>
			<td width="20" align="right" valign="top">Merek produk :</td>
		  <td><input type="text" name="prodbrand" size="30" value="'.$type[ProdBrand].'" /></td>
		</tr>
		<tr>
			<td align="right">Nama Produk :</td>
		  <td><input type="text" name="prodname" size="30" value="'.$type[ProdName].'" /></td>
		</tr>
		<tr>
			<td align="right" valign="top">Gambar Produk :</td>
			<td>
				<input type="file" name="prodimage" size="18" style="background:#FFFFFF" /><br />
				<img border="0" src="picture/'.$type[ProdImage].'" width="100" height="100">
			</td>
		</tr>
		<tr>
			<td align="right">Deskripsi :</td>
		  <td><input type="text" name="desc" size="30" value="'.$type[Description].'" /> </td>
		</tr>			
		<tr>
			<td align="right">Harga :</td>
		  <td><input type="text" name="price" size="15" value="'.$type[Price].'" /> </td>
		</tr>	
		<tr>
			<td align="right" valign="top">Rincian :</td>
		  <td><textarea cols="28" rows="4" name="details">'.$type[Details].'</textarea></td>
		</tr>
		<tr>
			<td align="right">Stock :</td>
		  <td><input type="text" name="stock" size="15" value="'.$type[Stock].'" /> </td>
		</tr>	
		<tr>
			<td align="right">Satuan :</td>
		  <td><input type="text" name="satuan" size="15" value="'.$type[Satuan].'" /> </td>
		</tr>	
		<tr>
			<td colspan="2" align="center">
				<br/>
				<input type="hidden" name="prodid" value="'.$type['ProdID'].'" />
				<input type="submit" value="Update" name="update" style="background:url(picture/background1.gif); border:outset; color:#000000"/>
				<input type="reset" value="Reset" style="background:url(picture/background1.gif); border:outset; color:#000000"/>
			</td>												
		</tr>';
}
echo '<tr>
		<td colspan="2">';
			$err   = $_SESSION['err'];
			$alert = $_SESSION['alert'];
			if ($err)
			{
				echo "<div class='error'><ul>$err</ul></div>";
			}
			else
			{
				echo $alert;
			}
echo '</td>
	</tr>
	<tr>
		<td colspan="2" align="center"><br /><a href="admin_lihatproduk.php">Kembali</a></td>
	</tr>
	</table>
	</form>';

session_unregister('err');
session_unregister('alert');
mysql_close();
pgFooter();
?>