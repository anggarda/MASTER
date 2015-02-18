<?php
require('pustaka.php');
isValidSession();
connectDB();

pgHeader('PT.Tomo Lestari Citra | Hapus Komentar');

$page = $_GET['page'];

$sql    = "SELECT * FROM t_feedback ORDER BY Date DESC";;
$result1 = mysql_query($sql);
$rows 	= mysql_num_rows($result1);
$ceils  = ceil($rows/15);

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

echo '<p align="center" style="font-size:24px">Lihat Komentar</p></p><div align="center"><a href="profil.php">Back</a></div>';
echo '<table border="1" cellspacing="0" cellpadding="3" align="center" width="500">';
echo '<tr>
		<td width="80" align="center">Tanggal</td>
		<td width="100" align="center">Nama</td>
		<td width="250" align="center">Komentar</td>
		<td width="70" align="center">&nbsp;</td>
	</tr>';
	
while ($type = mysql_fetch_array($result2))
{
	$date  = $type['Date'];
	$dates = date("d-m-Y",strtotime($date));
	echo '<tr>
			<td align="center">'.$dates.'</td>
			<td>'.$type['Name'].'</td>
			<td>'.$type['Comments'].'</td>';
	echo '<form method="post" action="admin_hapuskomentar1.php">';
	echo '<td align="center">
			<input type="hidden" name="commentID" value="'.$type['CommentID'].'">
			<input type="submit" value="Hapus" style="background:url(picture/background1.gif); border:outset; color:#000000">
		</td>';
	echo '</form>';
	echo '</tr>';
}
echo	'<tr>
			<td colspan="4" align="right" width="530">Page: ';
        	
			for ($i=1;$i<=$ceils;$i++)
			{
				if ($i==1) echo ("[ ");
				if ($page!=$i) echo "<a href=admin_hapuskomentar.php?page=$i>";
				echo "$i</a>";
				if ($i==$ceils)echo (" ]");
				else echo (" | ");
			} 
	echo '</td>
      	</tr>';
echo '</table>'
;

$alert = $_SESSION['alert'];
if ($alert)
{
	echo "$alert";
}

mysql_close();
session_unregister('alert');
pgFooter();
?>