<?php
//connects to the server and selects the yourblog database
include("connect.php");
$lvl=4;
if(isset($_GET['gid'])){
$checkPermission="SELECT UL.ID 
					FROM Users U,User_Levels UL
					WHERE U.User_Level_ID = UL.ID
					AND U.ID=".$_GET['gid']."";
$result = mysql_query($checkPermission,$con);
$Level=mysql_fetch_array($result);
$lvl=$Level['ID'];
}
if($lvl==0){
	//creates the SELECT statement
	$statement="SELECT U.Name,U.ID
				FROM Users U WHERE U.User_Level_ID > 0";
	//echo($statement);
	//queries the result from the database
	$result = mysql_query($statement,$con);
	
	//output all results
	echo('<div class="entry">
    <div id="c_top" > <b class="topic">Administration</b>
    	<hr />
    </div>
    <div id="c_center">');
	echo("<table>
				<tr>
					<th>Username</th>
					<th>Action</th>
				</tr>");
	while($row = mysql_fetch_array($result)){
		echo('<tr>
				<td>'.$row['Name'].'</td>
				<td><button id="rmv_'.$row['ID'].'" >remove</button></td>
			</tr>');
		echo('<script type="text/javascript"">$("#rmv_'.$row['ID'].'").button().click(function(){removeUser('.$row['ID'].');});</script>');
	}

	echo('</table></div>
    <div id="c_bottom">
    	<hr />
    </div>
</div>');
}
//close database connection
mysql_close($con);
?>


