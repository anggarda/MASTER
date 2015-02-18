<?php
require('pustaka.php');
connectDB();

pgHeader('CV.Astra Batam | Pencarian');

$page 	 = $_GET['page'];

if (isset($_POST['search']))
{
	$search = $_POST['search'];
}
else
{
	$search = $_GET['keyword'];
}
$find  = str_replace(' ','%20',$search);

echo '<table align="center">
		<tr>
			<td><img src="picture/produk.gif" width="250" height="50"></td>
		</tr>
	</table>';

$sql    = "SELECT * FROM t_product WHERE ProdName like '%$search%' OR ProdBrand like '%$search%' ORDER BY ProdID DESC";
$result1 = mysql_query($sql);
$rows 	= mysql_num_rows($result1);
$ceils  = ceil($rows/10);

if ($page == 0)
{
	$page = 1;
}
elseif ($page > $ceils)
{
	$page = 1;
}
$first = ($page-1)*6;

$result2 = mysql_query($sql." LIMIT $first,6");

echo "<p>$rows results for: <b>$search</b></p>";
echo '<table border="0" cellspacing="0" cellpadding="3" align="center" width="500">';

if ($result2)
{
	while ($type = mysql_fetch_array($result2))
	{
		$price  = number_format($type['Price']);
		$prices = str_replace(',','.',$price);
					
		if ($i++%3==0)
		{
		echo '<tr>';
		}
				echo '<td width="150" align="center">
					<a href="rincian.php?id='.$type['ProdID'].'"><img border="0" src="picture/'.$type['ProdImage'].'" width="130" height="130"></a><br />
					<a href="rincian.php?id='.$type['ProdID'].'">'.$type['ProdName'].'</a><br />
					<a>'.$type['ProdBrand'].'</a><br />
					<a>Rp&nbsp;'.$prices.',-</a><br /><br />
				</td>';
		if ($i%3==0)
		{
			echo '</tr>';
		}
	}

	for($i;$i%3!=0;$i++)
	{
		echo '<td>&nbsp;</td>';
	}
}

echo	'<tr>
			<td colspan="3" align="right">Page: ';
        	
			for ($i=1;$i<=$ceils;$i++)
			{
				if ($i==1) echo ("[ ");
				if ($page!=$i) echo "<a href=pencarian.php?keyword=$find&page=$i>";
				echo "$i</a>";
				if ($i==$ceils)echo (" ]");
				else echo (" | ");
			}
echo 		'</td>
      	</tr>';
echo '</table>';

mysql_close();
pgFooter();
?>