<?php
require('pustaka.php');
connectDB();
isValidSession();

pgHeader('PT.Tomo Lestari Citra | Konfirmasi1');

$custid 	  = $_SESSION['custid'];
$delivername  = ucwords($_POST['delivername']);
$deliveradd   = ucfirst($_POST['deliveradd']);
$delivercity  = ucwords($_POST['delivercity']);
$province     = $_POST['province'];
$payment      = $_POST['payment'];

$_SESSION['delivername'] = $delivername;
$_SESSION['deliveradd']  = $deliveradd;
$_SESSION['delivercity'] = $delivercity;
$_SESSION['province']    = $province;
$_SESSION['payment']     = $payment;

$submit		= $_POST['submit'];

session_name('err');
$_SESSION['err'] = $err;

if (isset($submit))
{
	$error = 0;
		
	// validate delivername
	if (!empty ($delivername))
	{
		if (!ereg ("^[A-Za-z ]+$", $delivername))
		{
			$err .= "<li>Nama penerima harus diisi dengan huruf.</li>";
			$error++;
		}
	}
	else
	{
		$err .= "<li>Silahkan isi nama penerima.</li>";
		$error++;
	}
	
	// validate deliveradd
	if (empty ($deliveradd))
	{
		$err .= "<li>Silahkan isi alamat penerima.</li>";
		$error++;
	}
	
	// validate delivercity
	if (!empty ($delivercity))
	{
		if (!ereg ("^[A-Za-z ]+$", $delivercity))
		{
			$err .= "<li>Kota penerima harus diisi dengan huruf.</li>";
			$error++;
		}
	}
	else
	{
		$err .= "<li>Silahkan isi kota penerima.</li>";
		$error++;
	}
	
	// validate province
	if ($province == "----- Silahkan pilih -----")
	{
		$err .= "<li>Silahkan pilih provinsi.</li>";
		$error++;
	}

	if ($error == 0)
	{
		$sql    = "SELECT * FROM t_customer, t_user WHERE t_customer.CustID = '$custid' AND t_user.CustID = t_customer.CustID";
		$result = mysql_query($sql);
	
		echo '<table align="center" width="550">
				<tr>
					<td align="center"><img src="picture/konfirmasi.gif" width="250" height="40" /><br /><br /></td>
				</tr>
				<tr>
					<td>';
						echo viewCart();
				echo '<br/></td>
				</tr>';
				
		while ($type = mysql_fetch_array($result))
		{
		echo '<tr>
				<td>
					<table width="550" border="1" cellspacing="0" align="center">
						<tr>
							<td width="270">
								<table align="center" width="260" cellpadding="2" cellspacing="0">
									<tr>
										<td colspan="2" align="center"><u>Informasi Customer</u><br /><br /></td>
									</tr>
									<tr>
										<td width="80">Nama :</td>
										<td width="180">'.$type[CustName].'</td>
									</tr>
									<tr>
										<td valign="top">Alamat :</td>
										<td>'.nl2br($type[CustAdd]).'</td>
									</tr>
									<tr>
										<td>Kota :</td>
										<td>'.$type[City].'</td>
									</tr>
									<tr>
										<td>No Kontak:</td>
										<td>'.$type[CustContact].'</td>
									</tr>	
								</table>
							</td>';
		}
		 				echo '<td width="270" valign="top">
								<table align="center" width="260" cellpadding="2" cellspacing="0">
									<tr>
										<td colspan="2" align="center"><u>Informasi Pengiriman</u><br /><br /></td>
									</tr>
									<tr>
										<td width="80">Nama :</td>
										<td width="180">'.$delivername.'</td>
									</tr>
									<tr>
										<td valign="top">Alamat :</td>
										<td>'.nl2br($deliveradd).'</td>
									</tr>
									<tr>
										<td>Kota :</td>
										<td>'.$delivercity.'</td>
									</tr>
									<tr>
										<td>Provinsi :</td>
										<td>'.$province.'</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
						<tr>
				<td align="center">
					<br/>
					<form method="post" action="konfirmasi2.php">
					<input type="submit" name="submit" value="Selesai" style="background:url(picture/background1.gif); border:outset; color:#000000">
					</form>	
				</td>
			</tr>
		</table>';
	}
	else
	{
		header ("location: http:konfirmasi.php");
	}
}

mysql_close();
pgFooter();
?>
