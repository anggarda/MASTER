<?php
session_start();
@header("Content-type: text/html; charset=utf-8;");

ob_start("ob_gzhandler");

date_default_timezone_set('Asia/Krasnoyarsk');

function connectDB()
{
	mysql_pconnect('localhost','root','')
		or die("Cannot connect to MySQL");
	mysql_select_db('rjl');
}

if (isset($_GET['act']))
{
	require $_GET['act'].'.php';
}

/******** header ********/
function pgHeader($title)
{
	echo <<<_HEADER1
<html>
<head>
<title>$title</title>
<link type="text/css" rel="stylesheet" href="style.css">
</head>

<body>
<body>
<table width="950" cellspacing="0" cellpadding="5" align="center" bgcolor="#ffffff">
	<tr>
		<td>
		
			<table border="0" width="950" cellspacing="5" cellpadding="0" bgcolor="#ffffff" align="center">
				<tr>
        <td><img src="picture/logotoko.jpg"></td>
          
			   
       	<td colspan="3" height="30" style="font-size:12pt;text-align:right"></a> 

          
_HEADER1;
						$username = $_SESSION['username'];
						$lower = strtolower($username);
						$first = ucwords($lower);
						if (isset($_SESSION['usertype']))
						{
							echo "Selamat Datang, $first ";
							echo "[<a href='profil.php'>Profilku</a>|<a href='logout.php'>Logout</a>]";
						}
						else
						{
							echo "	$first ";
							echo "[<a href='registerasi.php'>Registrasi</a>|<a href='login.php'>Login</a>]";
						}
						
						
						
						echo <<<_HEADER2
					</td>
				</tr>
				
				

				<tr>
					<td colspan="3">
						<img border="0" src="picture/logo.jpg" width="950" height="200"></a>
					</td>
				</tr>
				<tr>
					<td colspan="3" height="30" align="center">
						<a href="index.php">HOME</a> | 
						<a href="produk.php">PRODUK</a> | 
						<a href="carapesan.php">CARA PESAN</a> | 
						<a href="pengiriman.php">PENGIRIMAN</a> |
						<a href="pembayaran.php">PEMBAYARAN</a> |
						<a href="komentar.php">KOMENTAR</a> | 
						<a href="aboutus.php">TENTANG KAMI</a> | 
						<a href="contactus.php">KONTAK KAMI</a>
					</td>
				</tr>	
					
				<tr>
					<td width="190" align="center" valign="top" bgcolor="#ffffff" ></br>
					<img src="picture/fotoindex.jpg" width="150" height="100" /></br></br></br><hr/>
						<table align="center" >
						<p style="font-size:24px">Pencarian</p>
						<table align="center" width="120">
						<tr><td align="center">	
								<form name="search" method="post" action="pencarian.php">
								<input type="text" name="search" value="" size="15"><br /><br/>
								<input type="submit" value="Pencarian" name="cari" style="background:url(picture/background1.gif); border:outset; color:#000000"/>
								</form>
							</td></tr>
						</table>
						<br/><hr/>
					<p style="font-size:24px">Merek</p>
						<table align="center" >
						</td>
						</tr>										
						</table>				
						<table align="center" width="120" cellspacing="0" cellpadding="0">
						<select name="brand" onchange="location=this.value">
						<option selected>--- Pilih Merek ---</option>
						
_HEADER2;
							connectDB();
							$sql = "SELECT ProdBrand FROM t_product ORDER BY ProdBrand ASC";
							$result = mysql_query($sql);
							while ($row = mysql_fetch_array($result))
							{
								if (!in_array($row['ProdBrand'], $repeated))
								{
									$repeated[] = $row['ProdBrand'];
          							echo "<option value='merek.php?brand=" . $row['ProdBrand'] . "'>" . $row['ProdBrand'] . "</option>";	
								}
							}
						
						echo <<<_HEADER3
						</select>
						</table>
						<br/>
			
 
      
      <table>
						<tr>
					<td width="190" align="center" valign="top" bgcolor="#2e2e2e" >
						<table align="center" >
						</td>
						</tr>
						</table>
            
         <!--   
            	
							<tr>
								<td align="center"><object id="pingbox1pxvu2f3xsawW" type="application/x-shockwave-flash" data="http://wgweb.msg.yahoo.com/badge/Pingbox.swf" width="180" height="240"><param name="movie" value="http://wgweb.msg.yahoo.com/badge/Pingbox.swf" /><param name="allowScriptAccess" value="always" /><param name="flashvars" value="wid=zHzl78izRnCpqmOMWBwyid4q6Oo-" /></object>
							</td>
							</tr>
							-->
							
                            </table>
							</td>
					<td width="570" valign="top">
						<table border="0" width="560" align="center" >
							<tr>
								<td>
								

_HEADER3;
}

/************ footer ***************/
function pgFooter()
{
	echo <<<_FOOTER1
								</td>
							</tr>
						</table>
					</td>			
                   
                    

					<td width="190" align="center" valign="top" bgcolor="#ffffff" >
						<p style="font-size:24px">Your Cart</p>
						<table align="center" width="165" cellspacing="0" cellpadding="0">
							<tr>
								<td>
								
								
_FOOTER1;
									echo writeItem();
									
								echo <<<_FOOTER2
								</td>
							</tr>
							<tr>
								<td>
_FOOTER2;
									echo writeSubtotal();
								echo <<<_FOOTER3
								</td>
							</tr>
							<tr>
							
								<td align="center">
									<form action="keranjangbelanja.php">
									<br/>
									<input type="submit" value="View Cart" style="background:url(picture/background1.gif); border:outset; color:#000000"/>
									</form>
                                    <hr/>
									<tr>
									
								<!--	
								<td align="center">
                                <a href="form.php"><img src="picture/paypal-custom.gif" width="94" height="79" border="0" /></a>
									<hr /> -->
									
								<br/>
									Kami Melayani<br/>
									Cash on Delivery<br/>
									Khusus Wilayah Batam<br/>
									Pengiriman 1hari kerja<br/>
									Tanpa Biaya Pengiriman !<br/><br/>
									<hr/>
								</td>
							</tr>
							<tr>
								<td align="center">
									<br/>
                                    Silakan hubungi <br/>
									Kami untuk <br/>
									Informasi lebih lanjut di <br/>
									<62>007<br/>
                                    <62> 008<br/>
									Setiap Hari <br/>
									Pk. 8.00 s/d 19.00 <br/><br/>
								
								</td>
							</tr>
						</table>

								</td>
							</tr>
						</table>
						
										
_FOOTER3;
								
					
					echo <<<_FOOTER4
					</td>		
				</tr>
				<tr>
					<td colspan="3" background="picture/background.gif" height="30" style=" font-weight:bold ">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					Copyright &copy; 2012 Toko Raja Laut
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>						
</body>
</html>

_FOOTER4;
}

function isValidSession()
{
	if (!isset($_SESSION['usertype']))
	{
		header("location: http:login.php");
		exit(0);
	}
}

function writeItem()
{
	$cart = $_SESSION['cart'];
	if (!$cart)
	{
		return '<p>Keranjang Belanja Anda: <b>0</b></p>';
	}
	else
	{
		$items = explode(',',$cart);
		return '<p>Keranjang Belanja Anda: <b>'.count($items).'</b></p>';
	}
}

function writeSubtotal()
{
	connectDB();
	$cart = $_SESSION['cart'];
	if (!$cart)
	{
		return '<p>Subtotal: <b>Rp 0,-</b></p>';
	}
	else
	{
		$items = explode(',',$cart);
		$contents = array();
		
		foreach ($items as $item)
		{
			$contents[$item] = (isset($contents[$item])) ? $contents[$item] + 1 : 1;
		}
		
		foreach ($contents as $prodid=>$quantity)
		{
			$sql     = "SELECT * FROM t_product WHERE ProdID = '$prodid'";
			$result  = mysql_query($sql);
			$type    = mysql_fetch_array($result);
			
			$price = $type['Price'];
			$subtotal += ($price * $quantity);
		}
		return '<p>Subtotal: <b>Rp&nbsp;'.str_replace(',','.',number_format($subtotal)).',-</b></p>';
	}
}

function showCart()
{
	connectDB();
	$cart = $_SESSION['cart'];
	if ($cart)
	{
		$error = 0;
		$items = explode(',',$cart);
		$contents = array();
		
		foreach ($items as $item)
		{
			$contents[$item] = (isset($contents[$item])) ? $contents[$item] + 1 : 1;
		}
		
		$output[] = '<form action="keranjangbelanja.php?action=update" method="post" id="cart">';
		$output[] = '<table align="center" border="1" cellspacing="0" cellpadding="2" width="550">
				<tr align="center">
					<td width="50">&nbsp;</td>
					<td width="270">Nama</td>
					<td width="80">Harga Satuan</td>
					<td width="50">Quantity</td>
					<td width="100">Total</td>
				</tr>';
		
		foreach ($contents as $prodid=>$quantity)
		{
			$sql    = "SELECT * FROM t_product WHERE ProdID = '$prodid'";
			$result = mysql_query($sql);
			$type   = mysql_fetch_array($result);
			
			if ($type['Stock'] == 0)
			{
				echo '<a class="error">"'.$type['ProdName'].' by '.$type['ProdBrand'].'" kehabisan stock.</a><br />';
				$error++;
			}
			elseif (($type['Stock'])-$quantity < 0)
			{
				echo '<a class="error">"'.$type['ProdName'].' by '.$type['ProdBrand'].'" hanya tersisa '.$type['Stock'].' .</a><br />';
				$error++;
			}
			
			$output[] = '<tr>';
			$output[] = '<td><a href="keranjangbelanja.php?action=delete&id='.$prodid.'">Hapus</a></td>';
			$output[] = '<td><b>'.$type['ProdName'].' by '.$type['ProdBrand'].'</b><br/><div class="description"><small>'.$type['Description'].'</small></div></td>';
			$output[] = '<td align="right">Rp&nbsp;'.str_replace(',','.',number_format($type['Price'])).',-</td>';
			$output[] = '<td align="center"><input type="text" name="quantity'.$prodid.'" value="'.$quantity.'" size="1" maxlength="2" /></td>';
			$output[] = '<td align="right">Rp&nbsp;'.str_replace(',','.',number_format($type['Price'] * $quantity)).',-</td>';
			$subtotal += ($type['Price'] * $quantity);
			$output[] = '</tr>';
		}
		$output[] = '<tr><td colspan="5" align="right"><p>Subtotal: Rp&nbsp;'.str_replace(',','.',number_format($subtotal)).',-</p></td></tr>';
		$output[] = '</table>';
		$output[] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		 		     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 	 
					 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    				 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
					 <input type="submit" value="Update cart" style="background:url(picture/background1.gif); border:outset; color:#0000000" />';
		$output[] = '</form>';
		
		if ($error == 0)
		{
			$output[] = '<table align="center"><tr>';
			$output[] = '<td><form action="produk.php" method="post">';
			$output[] = '<input type="submit" value="Belanja lagi" style="background:url(picture/background1.gif); border:outset; color:#000000" />';
			$output[] = '</form></td>';
			$output[] = '<td><form action="konfirmasi.php" method="post">';
			$output[] = '<input type="submit" value="Konfirmasi" style="background:url(picture/background1.gif); border:outset; color:#000000" />';
			$output[] = '</form></td>';
			$output[] = '</tr></table>';
		}
		else
		{
			$output[] = '<table align="center"><tr>';
			$output[] = '<td><form action="produk.php" method="post">';
			$output[] = '<input type="submit" value="Belanja Lagi" style="background:url(picture/background1.gif); border:outset; color:#000000" />';
			$output[] = '</form></td>';
			$output[] = '<td><form>';
			$output[] = '<input type="submit" value="Konfirmasi" style="background:url(picture/background1.gif); border:outset; color:#000000" />';
			$output[] = '</form></td>';
			$output[] = '</tr></table>';
		}
	}
	else
	{
		$output[] = '<p align="center" style="font-size:22"><br />Keranjang Belanja Anda Kosong</p>';
	}
	return join('',$output);
}

function viewCart()
{
	connectDB();
	$province = $_SESSION['province'];
	$cart     = $_SESSION['cart'];
	
	if ($cart)
	{
		$items = explode(',',$cart);
		$contents = array();
		
		foreach ($items as $item)
		{
			$contents[$item] = (isset($contents[$item])) ? $contents[$item] + 1 : 1;
		}
		
		$output[] = '<table align="center" border="1" cellspacing="0" cellpadding="2" width="550">
				<tr align="center">
					<td width="270">Nama</td>
					<td width="80">Harga Satuan</td>
					<td width="50">Quantity</td>
					<td width="100">Total</td>
				</tr>';
		
		foreach ($contents as $prodid=>$quantity)
		{
			$sql    = "SELECT * FROM t_product WHERE ProdID = '$prodid'";
			$result = mysql_query($sql);
			$type   = mysql_fetch_array($result);
			
			$sql1    = "SELECT * FROM t_province WHERE Province = '$province'";
			$result1 = mysql_query($sql1);
			$row     = mysql_fetch_array($result1);
			
			$output[] = '<tr>';
			$output[] = '<td><b>'.$type['ProdName'].' by '.$type['ProdBrand'].'</b><br/><div class="description"><small>'.$type['Description'].'</small></div></td>';
			$output[] = '<td align="right">Rp&nbsp;'.str_replace(',','.',number_format($type['Price'])).',-</td>';
			$output[] = '<td align="center">'.$quantity.'</td>';
			$output[] = '<td align="right">Rp&nbsp;'.str_replace(',','.',number_format($type['Price'] * $quantity)).',-</td>';
			$subtotal += ($type['Price'] * $quantity);
			$deliveryfee = $row['DelPrice'];
			$grandtotal = ($deliveryfee + $subtotal);
			$output[] = '</tr>';
		}
		$output[] = '<tr><td colspan="3" align="right"><p>Subtotal:</p></td>';
		$output[] = '<td align="right"><p>Rp&nbsp;'.str_replace(',','.',number_format($subtotal)).',-</p></td></tr>';
		$output[] = '<tr><td colspan="3" align="right"><p>Biaya Pengiriman:</p></td>';
		$output[] = '<td align="right"><p>Rp&nbsp;'.str_replace(',','.',number_format($deliveryfee)).',-</p></td></tr>';
		$output[] = '<tr><td colspan="3" align="right"><p>Grandtotal:</p></td>';
		$output[] = '<td align="right"><p>Rp&nbsp;'.str_replace(',','.',number_format($grandtotal)).',-</p></td></tr>';
		$output[] = '</table>';
	}
	else
	{
		$output[] = '<p align="center" style="font-size:22"><br />Keranjang Belanja Anda Kosong!</p>';
	}
	return join('',$output);
}

function insertOrder()
{
	connectDB();
	$cart        = $_SESSION['cart'];
	$custid      = $_SESSION['custid'];
	$delivername = $_SESSION['delivername'];
	$deliveradd  = $_SESSION['deliveradd'];
	$delivercity = $_SESSION['delivercity'];
	$province    = $_SESSION['province'];
	$today 	     = date("Y-m-d");
		
	if ($cart)
	{
		$items = explode(',',$cart);
		$contents = array();
		
		foreach ($items as $item)
		{
			$contents[$item] = (isset($contents[$item])) ? $contents[$item] + 1 : 1;
		}
		
		foreach ($contents as $prodid=>$quantity)
		{
			$sql     = "SELECT * FROM t_product WHERE ProdID = '$prodid'";
			$result  = mysql_query($sql);
			$type    = mysql_fetch_array($result);
			
			$sql1     = "SELECT * FROM t_province WHERE Province = '$province'";
			$result1  = mysql_query($sql1);
			$row      = mysql_fetch_array($result1);
			
			$price = $type['Price'];
			$subtotal += ($price * $quantity);
			$deliveryfee = $row['DelPrice'];
			$grandtotal = ($deliveryfee + $subtotal);
			
			$stok  = $type['Stock'];
			$stock = ($stok - $quantity);
			
			$uStock  = "UPDATE t_product";
			$uStock .= " SET Stock = '$stock'";
			$uStock .= " WHERE ProdID = '$prodid'";
			mysql_query($uStock);
		}
		/****** insert data order ******/
		$iOrder  = "INSERT INTO t_order VALUES ";
		$iOrder .= " (null, '$custid', '$delivername', '$deliveradd', '$delivercity', '$province', '$today', '$subtotal', '$grandtotal', 'Pending')";
		mysql_query($iOrder);
		
		/****** get the orderID ******/
		$sql    = "SELECT OrderID FROM t_order WHERE OrderDate = '$today' AND Grandtotal = '$grandtotal' AND CustID = '$custid' AND DeliverName = '$delivername'";
		$result = mysql_query($sql);
		$id 	= mysql_fetch_row($result);
		$orderid = $id[0];
		$_SESSION['orderid'] = $orderid;
	}
}

function insertCart()
{
	connectDB();
	$cart    = $_SESSION['cart'];
	$orderid = $_SESSION['orderid'];
	if ($cart)
	{
		$items = explode(',',$cart);
		$contents = array();
		
		foreach ($items as $item)
		{
			$contents[$item] = (isset($contents[$item])) ? $contents[$item] + 1 : 1;
		}
		
		foreach ($contents as $prodid=>$quantity)
		{
			$sql     = "SELECT * FROM t_product WHERE ProdID = '$prodid'";
			$result  = mysql_query($sql);
			$type    = mysql_fetch_array($result);
			
			$price  = $type['Price'];
			$total  = ($price * $quantity);
		
			/****** insert cart ******/
			$iUser  = "INSERT INTO t_cart VALUES ";
			$iUser .= " ('$orderid', '$prodid', '$quantity', '$total')";
			mysql_query($iUser);
		}
	}
}

function viewOrder()
{
	$orderid  = $_GET['id'];
	
	$sql1  = "SELECT * FROM t_cart, t_product, t_order, t_province";
	$sql1 .= " WHERE t_cart.OrderID = '$orderid' AND t_product.ProdID = t_cart.ProdID AND t_order.OrderID = t_cart.OrderID AND t_province.Province = t_order.Province";
	$result1 = mysql_query($sql1);
	
	echo '<table border="1" cellspacing="0" cellpadding="2" align="center" width="550">
			<tr>
				<td width="270" align="center">Name</td>
				<td width="80" align="center">Unit Price</td>
				<td width="50" align="center">Quantity</td>
				<td width="100" align="center">Total</td>
			</tr>';
	
	while ($data = mysql_fetch_array($result1))
	{
		$subtotal   = $data[Subtotal];
		$province   = $data[Province];
		$grandtotal = $data[Grandtotal];
		
		$sql2 = "SELECT * FROM t_province WHERE Province = '$province'";
		$result2 = mysql_query($sql2);
		$row = mysql_fetch_array($result2);
		
		$deliveryfee = $row[DelPrice];
		
	echo '<tr>
			<td><b>'.$data[ProdName].' by '.$data[ProdBrand].'</b><br/><div class="description"><small>'.$data[Description].'</small></div></td>
			<td align="right">Rp&nbsp;'.str_replace(',','.',number_format($data[Price])).',-</td>
			<td align="center">'.$data[Quantity].'</td>
			<td align="right">Rp&nbsp;'.str_replace(',','.',number_format($data[Total])).',-</td>
		</tr>';
	}
	echo '<tr>
			<td colspan="3" align="right">Subtotal:</td>
			<td align="right">Rp&nbsp;'.str_replace(',','.',number_format($subtotal)).',-</td>
		</tr>
		<tr>
			<td colspan="3" align="right">Delivery Fee:</td>
			<td align="right">Rp&nbsp;'.str_replace(',','.',number_format($deliveryfee)).',-</td>
		</tr>
		<tr>
			<td colspan="3" align="right">Grandtotal:</td>
			<td align="right">Rp&nbsp;'.str_replace(',','.',number_format($grandtotal)).',-</td>
		</tr>';
	echo '</table>';
}


?>
