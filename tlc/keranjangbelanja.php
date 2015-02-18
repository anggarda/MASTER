<?php
require('pustaka.php');
connectDB();

pgHeader('PT.Tomo Lestari Citra | Keranjang Belanja');

echo '<table align="center" width="550">
		<tr>
			<td align="center"><p style="font-size:24px">Belanja</p></td>
		</tr>
		</table>';

$cart   = $_SESSION['cart'];
$action = $_GET['action'];

switch ($action)
{
	case 'add':
		if ($cart)
		{
			$cart .= ','.$_GET['id'];
		}
		else
		{
			$cart = $_GET['id'];
		}
		break;
		
	case 'delete':
		if ($cart)
		{
			$items = explode(',',$cart);
			$newcart = '';
			foreach ($items as $item)
			{
				if ($_GET['id'] != $item)
				{
					if ($newcart != '')
					{
						$newcart .= ','.$item;
					}
					else
					{
						$newcart = $item;
					}
				}
			}
			$cart = $newcart;
		}
		break;
		
	case 'update':
		if ($cart)
		{
			$newcart = '';
			foreach ($_POST as $key=>$value)
			{
				if (stristr($key,'quantity'))
				{
					$prodid = str_replace('quantity','',$key);
					$items = ($newcart != '') ? explode(',',$newcart) : explode(',',$cart);
					$newcart = '';
					foreach ($items as $item)
					{
						if ($prodid != $item)
						{
							if ($newcart != '')
							{
								$newcart .= ','.$item;
							}
							else
							{
								$newcart = $item;
							}
						}
					}
					for ($i=1;$i<=$value;$i++)
					{
						if ($newcart != '')
						{
							$newcart .= ','.$prodid;
						}
						else
						{
							$newcart = $prodid;
						}
					}
				}
			}
		}
		$cart = $newcart;
		break;
}
$_SESSION['cart'] = $cart;

echo showCart();

mysql_close();
pgFooter();
?>
