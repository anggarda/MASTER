<?php
require('pustaka.php');
connectDB();

pgHeader('CV.Astra Batam | Rincian Produk');

$prodid  = $_GET['id'];

$sql    = "SELECT * FROM t_product WHERE ProdID = '$prodid'";
$result = mysql_query($sql);

echo '<table border="0" cellspacing="0" cellpadding="3" align="center" width="470">';

while ($type = mysql_fetch_array($result))
{
	$price  = number_format($type['Price']);
	$prices = str_replace(',','.',$price);
	
	$detail  = $type['Details'];
	$details = nl2br($detail);
					
	echo '<tr>
			<td colspan="2" align="center" style="font-size:22"><br />'.$type['ProdBrand'].' '.$type['ProdName'].'<hr/></td>
		</tr>';
	echo '<tr>
			<td width="170" valign="middle">
				<img border="0" src="picture/'.$type['ProdImage'].'" width="170" height="170">
			</td>
			<td width="280">
				<table cellpadding="5">
				<tr>
					<td width="80"><b>Deskripsi:</b></td>
					<td>'.$type['Description'].'</td>
				</tr>
				<tr>
					<td width="80"><b>Harga:</b></td>
					<td>Rp&nbsp;'.$prices.',-</td>
				</tr>
				<tr>
					<td width="80"><b>Status:</b></td>
					<td>';
						$stock = $type['Stock'];
						if ($stock >= 1)
						{
							echo 'Available';	
						}
						else
						{
							echo 'Not Available';
						}
				echo '</td>
				</tr>
				<tr>
					<td colspan="2" align="center">
						<br /><a href="keranjangbelanja.php?action=add&id='.$type['ProdID'].'"><img border="0" src="picture/addtocart.jpg"></a><br />
					</td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2"><br /><b>Rincian:</b></td>
		</tr>
		<tr>
			<td colspan="2" align="justify">'.$details.'</td>
		</tr>
		<tr>
			<td colspan="2"><hr /></td>
		</tr>';
}

echo '</table>';

mysql_close();
pgFooter();
?>