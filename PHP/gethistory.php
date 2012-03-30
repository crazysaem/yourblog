<?php
include("connect.php");
$statement="SELECT YEAR(E.Date) AS YEAR, 
				MONTH(E.Date) AS MONTH,
				COUNT(1) AS COUNT
			FROM Entries E
			GROUP BY YEAR,
					MONTH";
//queries the result from the database
$result = mysql_query($statement,$con);
$ycount=0;
echo('<ul class="collapsibleList"><li><a href="javascript:reset_date_search();">Archive:</a><ul>');
$curyear="start";
while($row = mysql_fetch_array($result))
  {
	if($curyear=="start"){
		$ycount++;
		$curyear=$row['YEAR'];
		echo('<li>'.
    		$curyear
			.'<ul>');
		}
	else if($curyear!=$row['YEAR']){
		$ycount++;
		$curyear=$row['YEAR'];
		echo('</ul>
			</li>
			<li>'.
    		$curyear
			.'<ul>');
		}
		$mname=getmonthString($row['MONTH']);
		echo('<li><a style="text-decoration:none;" href="javascript:update_date_search('.$curyear.','.$row['MONTH'].');" >'.$mname.' ('.$row['COUNT'].')</a></li>');
}
if($ycount>0){
	echo("</ul></li>");
	}
echo("</ul></li></ul>");
mysql_close($con);

function getmonthString($n){
	$timespamp = mktime(0,0,0,$n,1,2012);
	return date("M",$timespamp);
	}
?>