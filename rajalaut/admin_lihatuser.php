<?php
require('pustaka.php');
isValidSession();
connectDB();

pgHeader('PT.Tomo Lestari Citra | Lihat User');

$page = $_GET['page'];

$sql    = "SELECT * FROM t_customer, t_user WHERE t_customer.CustID = t_user.CustID ORDER BY t_user.CustID DESC";
$result1 = mysql_query($sql);
$rows 	= mysql_num_rows($result1);
$ceils  = ceil($rows/25);

if ($page == 0)
{
	$page = 1;
}
elseif ($page > $ceils)
{
	$page = 1;
}
$first = ($page-1)*25;

$result2 = mysql_query($sql." LIMIT $first,25");

echo '<p align="center" style="font-size:24px">Lihat User</p>';
echo '<table border="1" cellspacing="0" cellpadding="4" align="center" width="550">';
echo '<tr>
		<td width="50" align="center">Proses</td>
		<td width="200" align="center">Nama</td>
		<td width="90" align="center">Alamat</td>
		<td width="50" align="center">Kota</td>
		<td width="50" align="center">No. Telp</td>
		<td width="50" align="center">Tanggal Lahir</td>
		<td width="50" align="center">Email</td>
	</tr>';
	
while ($type = mysql_fetch_array($result2))
{
	$date  = $type['Birthdate'];
	$dates = date("d-m-Y",strtotime($date));
	echo '<tr>';
	echo '<td align="center"><a href="admin_hapususer.php?cid='.$type['Username'].'">Delete</a></td>
			<td>'.$type['CustName'].'</td>
			<td>'.$type['CustAdd'].'</td>
			<td>'.$type['City'].'</td>
			<td>'.$type['CustContact'].'</td>
			<td align="center">'.$dates.'</td>
			<td>'.$type['Email'].'</td>
		</tr>';
}

echo	'<tr><div align="center"><a href="profil.php">Back</a></div></tr>';
echo	'<tr>
			<td colspan="7" align="right">Page: ';
        	
			for ($i=1;$i<=$ceils;$i++)
			{
				if ($i==1) echo ("[ ");
				if ($page!=$i) echo "<a href=admin_lihatuser.php?page=$i>";
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