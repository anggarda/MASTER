<?php
require('pustaka.php');
isValidSession();
connectDB();

pgHeader('PT.Tomo Lestari Citra | Lihat Provinsi');

$page = $_GET['page'];

$sql    = "SELECT * FROM t_province ORDER BY Province ASC";
$result1 = mysql_query($sql);
$rows 	= mysql_num_rows($result1);
$ceils  = ceil($rows/20);

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

echo '<p align="center"><img src="picture/lihatprovinsi.gif" width="250" height="50" /></p>';
echo '<table border="1" cellspacing="0" cellpadding="3" align="center" width="500">';
echo '<tr>
		<td colspan="4" align="center">
			<a href="admin_tambahprovinsi.php">Tambah Provinsi</a>
		</td>
	</tr>
	<tr>
		<td width="80" align="center">Proses</td>
		<td width="130" align="center">Provinsi</td>
		<td width="100" align="center">Durasi</td>
		<td width="100" align="center">Harga</td>
	</tr>';
	
while ($type = mysql_fetch_array($result2))
{
	$price  = number_format($type['DelPrice']);
	$prices = str_replace(',','.',$price);
	echo '<tr>';
	echo '<td align="center">
				<a href="admin_ubahprovinsi.php?id='.$type['Province'].'">Ubah</a><br />
				<a href="admin_hapusprovinsi.php?id='.$type['Province'].'">Hapus</a>
			</td>
			<td width="100">'.$type['Province'].'</td>
			<td width="30" align="center">'.$type['Duration'].'  day</td>
			<td width="50" align="right">Rp&nbsp;'.$prices.',-</td>
		</tr>';
}
echo	'<tr>
			<td colspan="4" align="right">Page: ';
        	
			for ($i=1;$i<=$ceils;$i++)
			{
				if ($i==1) echo ("[ ");
				if ($page!=$i) echo "<a href=admin_lihatprovinsi.php?page=$i>";
				echo "$i</a>";
				if ($i==$ceils)echo (" ]");
				else echo (" | ");
			}
echo 		'</td>
<div align="center"><a href="profil.php">Back</a></div>
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