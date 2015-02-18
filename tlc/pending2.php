<?php

include 'roadconn.php';


// Check if no record
$lastd_month = date('t');
$year = date('Y');
$month = date('m');

$query = mysql_query("SELECT * FROM t_order WHERE OrderStatus BETWEEN 'pending' AND 'pending 'ORDER BY OrderDate  ASC");
$row = mysql_num_rows($query);

if ($row < 1)
{
	echo "<div style=\"color:#F00;border:solid 1px #500;margin-left:300px;margin-right:300px;\" id=\"table_listing\">No records in this month</div>";
	exit();
}

$page_name="report_show.php"; //  If you use this code with a different page ( or file ) name then change this 
$start=$_GET['start'];

if (strlen($start) > 0 and !is_numeric($start))
{
	echo "Data Error";
	exit;
}

$eu = ($start - 0); 
$limit = 20;                                 // No of records to be shown per page.
$this1 = $eu + $limit; 
$back = $eu - $limit; 
$next = $eu + $limit; 


/////////////// WE have to find out the number of records in our table. We will use this to break the pages///////
$query2 = "SELECT * FROM t_order WHERE OrderStatus  BETWEEN 'pending ' AND 'pending' ORDER BY OrderDate  ASC";
$result2 = mysql_query($query2);
echo mysql_error();
$nume = mysql_num_rows($result2);
/////// The variable nume above will store the total number of records in the table////

/////////// Now let us print the table headers ////////////////
$bgcolor="#CCC";
echo "<table  border=\"2\" align=\"center\">";
echo "<tr>	<td align=\"center\" bgcolor='#ffffff' >&nbsp;<font face='arial,verdana,helvetica' color='#100000' size='4'>Date</font></td>
			<td align=\"center\" bgcolor='#ffffff' >&nbsp;<font face='arial,verdana,helvetica' color='#000000' size='4'>Name</font></td>
			<td align=\"center\" bgcolor='#ffffff' >&nbsp;<font face='arial,verdana,helvetica' color='#000000' size='4'>Address</font></td>
			<td align=\"center\" bgcolor='#ffffff' >&nbsp;<font face='arial,verdana,helvetica' color='#000000' size='4'>Total(Rp)</font></td>
			<td align=\"center\" bgcolor='#ffffff' >&nbsp;<font face='arial,verdana,helvetica' color='#000000' size='4'>Status</font></td></tr>";


////////////// Now let us start executing the query with variables $eu and $limit  set at the top of the page///////////
$query = "SELECT * FROM t_order WHERE OrderStatus  BETWEEN 'pending' AND 'pending 'ORDER BY OrderDate  ASC LIMIT $eu, $limit ";
$result=mysql_query($query);
echo mysql_error();

//////////////// Now we will display the returned records in side the rows of the table/////////
while($noticia = mysql_fetch_array($result))
{
if($bgcolor=='#ffffff'){$bgcolor='#ffffff';}
else{$bgcolor='#ffffff';}

echo "<tr >
		<td align=left bgcolor=$bgcolor id='title'>&nbsp;<font face='Verdana' size='3'> $noticia[OrderDate] 		</font></td>
		<td align=left bgcolor=$bgcolor id='title'>&nbsp;<font face='Verdana' size='3'>".ucfirst($noticia['DeliverName'])."</font></td>
		<td align=left bgcolor=$bgcolor id='title'>&nbsp;<font face='Verdana' size='3'>".strtoupper($noticia['DeliverAdd'])."</font></td>
		<td align=left bgcolor=$bgcolor id='title'>&nbsp;<font face='Verdana' size='3'>".strtoupper($noticia['Grandtotal'])."</font></td>
		<td align=left bgcolor=$bgcolor id='title'>&nbsp;<font face='Verdana' size='3'>".strtoupper($noticia['OrderStatus'])."</font></td></TR>";

echo "</tr>";
}
echo "</table>";
////////////////////////////// End of displaying the table with records ////////////////////////

/////////////////////////////// 
if($nume > $limit ){ // Let us display bottom links if sufficient records are there for paging

/////////////// Start the bottom links with Prev and next link with page numbers /////////////////
echo "<table align = 'center' width='50%'><tr><td  align='left' width='30%'>";
//// if our variable $back is equal to 0 or more then only we will display the link to move back ////////
if($back >=0) { 
print "<a href='javascript:showPaging(\"$page_name?start=$back\")'><font face='Verdana' size='2'>PREV</font></a>"; 
} 
//////////////// Let us display the page links at  center. We will not display the current page as a link ///////////
echo "</td><td align=center width='30%'>";
$i=0;
$l=1;
for($i=0;$i < $nume;$i=$i+$limit){
if($i <> $eu){
echo " <a href='javascript:showPaging(\"$page_name?start=$i\")'><font face='Verdana' size='2'>$l</font></a> ";
}
else { echo "<font face='Verdana' size='4' color=red>$l</font>";}        /// Current page is not displayed as link and given font color red
$l=$l+1;
}


echo "</td><td  align='right' width='30%'>";
///////////// If we are not in the last page then Next link will be displayed. Here we check that /////
if($this1 < $nume) { 
print "<a href='javascript:showPaging(\"$page_name?start=$next\")'><font face='Verdana' size='2'>NEXT</font></a>";} 
echo "</td></tr></table>";

}// end of if checking sufficient records are there to display bottom navigational link. 

?>
