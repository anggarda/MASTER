<?php
require('pustaka.php');

pgHeader('PT.Tomo Lestari Citra | Home');

echo '<table align="center" width="550">
		<tr>
			<td>
			<!--
				<p align="justify">PT.Tomo Lestari Citra <br />
				Menjual Produk Notebook Terbaru. <br/>
				</p>
				
				-->
				
			</td>
		</tr>
	</table>';

echo '<table border="0" cellspacing="0" cellpadding="3" align="center" width="500">';
echo '<tr>
		<td colspan="2">
		<fieldset>
			<legend style="font-size:17;">Main Products</legend><br/>';
		echo '<table border="0" cellspacing="0" cellpadding="3" align="center" width="500">';
				$sql    = "SELECT * FROM t_product WHERE ProdType='NB' ORDER BY ProdID DESC ";
				$result1 = mysql_query($sql);
				$result2 = mysql_query($sql." LIMIT 0,6");
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

echo 		'</table>';

			echo '<table border="0" cellspacing="0" cellpadding="3" align="center" width="500">';
				$sql1    = "SELECT * FROM t_product WHERE ProdType='Mix' ORDER BY ProdID DESC ";
				$result3 = mysql_query($sql1);
				$result4 = mysql_query($sql1." LIMIT 0,3");
				while ($type = mysql_fetch_array($result4))
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

echo 		'</table>
		</fieldset>
		</td>
      </tr>
	</table>';

mysql_close();

pgFooter();
?>
