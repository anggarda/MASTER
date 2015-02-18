<?php
require('pustaka.php');
connectDB();
isValidSession();

pgHeader('PT.Tomo Lestari Citra | Lihat Produk');

$page = $_GET['page'];

$sql    = "SELECT * FROM t_product ORDER BY ProdID DESC";;
$result1 = mysql_query($sql);
$rows 	= mysql_num_rows($result1);
$ceils  = ceil($rows/5);

if ($page == 0)
{
	$page = 1;
}
elseif ($page > $ceils)
{
	$page = 1;
}
$first = ($page-1)*4;

$result2 = mysql_query($sql." LIMIT $first,4");

echo '<p align="center"><img src="picture/lihatproduk.gif" width="250" height="40" /></p>';
echo '<table border="1" cellspacing="0" cellpadding="2" align="center" width="550">';
echo '<tr>
		<td colspan="3" align="center">
			<a href="admin_tambahproduk.php">Tambah Produk</a>
		</td><div align="center"><a href="profil.php">Back</a></div>
	</tr>';

while ($type = mysql_fetch_array($result2))
{
	$price  = number_format($type['Price']);
	$prices = str_replace(',','.',$price);
	
	echo '<tr>
			<td width="140"><img border="0" src="picture/'.$type['ProdImage'].'" width="140" height="140"></td>
			<td width="350">
				<table cellpadding="3">
				<tr>
					<td width="80"><b>Merek:</b></td>
					<td>'.$type['ProdBrand'].'</td>
				</tr>
				<tr>
					<td width="80"><b>Nama:</b></td>
					<td>'.$type['ProdName'].'</td>
				</tr>
				<tr>
					<td width="80"><b>Deskripsi:</b></td>
					<td>'.$type['Description'].'</td>
				</tr>
				<tr>
					<td width="80"><b>Harga:</b></td>
					<td>Rp&nbsp;'.$prices.',-</td>
				</tr>
				<tr>
					<td width="80"><b>Stock:</b></td>
					<td>'.$type['Stock'].'</td>
				</tr>
				</table>
			</td>';
	echo '<td width="100" align="center">
				<form method="post" action="admin_ubahproduk.php">
				<input type="hidden" name="prodid" value="'.$type['ProdID'].'" />
				<input style="background:url(picture/background1.gif); border:outset; color:#000000" type="submit" value="Ubah" /><br/>
				</form>
				<form method="post" action="admin_hapusproduk.php">
				<input type="hidden" name="prodid" value="'.$type['ProdID'].'" />';?>
            <input name="submit" type="submit" onclick="return (confirm('Are you sure to delete?'))" value="Delete"/>
            </form>
			<?php '</td>
	</tr>';
}
	
echo	'<tr>
			<td colspan="3" align="right" width="530">Page: ';
        	
			for ($i=1;$i<=$ceils;$i++)
			{
				if ($i==1) echo ("[ ");
				if ($page!=$i) echo "<a href=admin_lihatproduk.php?page=$i>";
				echo "$i</a>";
				if ($i==$ceils)echo (" ]");
				else echo (" | ");
			} 
echo 		'</td>
      	</tr>';
echo '</table>';

$alert = $_SESSION['alert'];
if ($alert)
{
	echo "$alert";
}

mysql_close();
session_unregister('alert');

pgFooter();
?>