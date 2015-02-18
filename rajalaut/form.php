<?php
require('pustaka.php');

pgHeader('CV.Astra Batam | Pembayaran');
?>

<body>
<table align="center">
<form action="https://www.paypal.com/cgi-bin/webscr"
method="post" id="payPalForm">
<input type="hidden" name="item_number"
value="01 - General Payment to Astrabatam.com">
<input type="hidden" name="cmd"
value="_xclick">
<input type="hidden" name="no_note"
value="1">
<input type="hidden" name="business"
value="paypal@indonesiapal.com">
<input type="hidden" name="currency_code"
value="USD">
<input type="hidden" name="return"
value="http://indonesiapal.com/payment-complete/">
Item Details:<br /><input name="item_name"
type="text" id="item_name"  size="45">
<br /><br />
Amount (USD $): <br /><input name="amount"
type="text" id="amount" size="45">
<br /><br />
<input type="submit" name="Submit"
value="Submit">
</form>
</table>
</body>
</html>
<?php
pgFooter();
?>
