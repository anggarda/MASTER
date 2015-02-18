<?php
require('pustaka.php');
connectDB();

pgHeader('PT.Tomo Lestari Citra | Komentar');
?>
	
<form name="contactus" method="post" action="komentar1.php">
<table  align="center">
<tr>
	<td colspan="2" align="center"><p style="font-size:24px">Komentar</p></td>
</tr>
<tr>
	<td colspan="2">
		<?php
		$page = $_GET['page'];
		
		$sql    = "SELECT * FROM t_feedback ORDER BY Date DESC";;
		$result1 = mysql_query($sql);
		$rows 	= mysql_num_rows($result1);
		$ceils  = ceil($rows/3);
		
		if ($page == 0)
		{
			$page = 1;
		}
		elseif ($page > $ceils)
		{
			$page = 1;
		}
		$first = ($page-1)*3;
		
		$result2 = mysql_query($sql." LIMIT $first,3");
		
		echo '<table border="1" cellspacing="0" cellpadding="3" width="500" align="center">';
		echo '<tr>
					<td width="80" align="center">Tanggal</td>
					<td width="100" align="center">Nama</td>
					<td width="320" align="center">Komentar</td>
					</tr>';
		while ($type = mysql_fetch_array($result2))
		{
			$date  = $type['Date'];
					echo '<tr>
					<td align="center">'.$date.'</td>
					<td>'.$type['Name'].'</td>
					<td>'.$type['Comments'].'</td>
				</tr>';            
		}
		echo	'<tr>
					<td colspan="3" align="right" width="530">Page: ';
		        	
					for ($i=1;$i<=$ceils;$i++)
					{
						if ($i==1) echo ("[ ");
						if ($page!=$i) echo "<a href=komentar.php?page=$i>";
						echo "$i</a>";
						if ($i==$ceils)echo (" ]");
						else echo (" | ");
					} 
			echo '</td>
		      	</tr>';
		echo '</table>';
		?>
	</td>
</tr>
<tr>
	<td><br /><br /></td>
</tr>
<tr>
	<td colspan="2" align="left" >
    Tinggalkan komentar anda baik berupa kesan, saran maupun kritik demi perbaikan sistem layanan kami ke depannya.
    Terima kasih dan sampai jumpa !!<br/><br/>
	</td>
<tr>
	<td width="100">Nama :</td>
	<td width="250"><input type="text" name="name" size="30"/></td>
</tr>
<tr>
	<td>Email :</td>
	<td><input type="text" name="email" size="30" /></td>
</tr>
<tr>
	<td valign="top">Komentar :</td>
	<td><textarea name="comments" cols="30" rows="4"></textarea></td>
</tr>
<tr>
	<td colspan="2" align="center">
		<br/>
		<input type="submit" name="submit" value="Kirim" style="background:url(picture/background1.gif); border:outset; color:#000000"/>
		<input type="reset" name="reset" value="Reset" style="background:url(picture/background1.gif); border:outset; color:#000000"/>
	</td>												
</tr>
<tr>
	<td><br/></td>
</tr>
<tr>
	<td colspan="2">
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
