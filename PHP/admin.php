<?php session_start(); ?>
<?php
$lvl=4;
if(isset($_SESSION['Level']))
	$lvl=$_SESSION['Level'];
if($lvl==0){
	include("connect.php");
	//creates the SELECT statement
	$statement="SELECT U.Name,
						U.ID,
						User_Level_ID AS Ulvl,
						U.Password,
						(SELECT COUNT(1) 
							FROM Comments C
							WHERE C.User_ID = U.ID
							GROUP BY C.User_ID) AS ComCount 
				FROM Users U 
				WHERE U.User_Level_ID > 0 
				ORDER BY Ulvl";
	$result = mysql_query($statement,$con);
	//output result
	echo('<div class="entry">
    <div id="c_top" > <b class="topic">Administration</b>
    	<hr />
    </div>
    <div id="c_center">');
	echo("<table>
				<tr>
					<th>Username</th>
					<th>Level</th>
					<th>Status</th>
					<th colspan='4'>Actions</th>
				</tr>");
	while($row = mysql_fetch_array($result)){
		echo('<tr>
				<td>'.htmlspecialchars($row['Name']).'</td>
				<td>');
				$mk="";
				$mkid="";
				$is="";
				if($row['Ulvl']==1){
					$mk="User";
					$mkid=2;
					$is="Author";
				}
				else{
					$is="User";
					$mk="Author";
					$mkid=1;
				}
				echo($is);
				echo('</td>
					<td>');
				
				if($row['Password']=="")
					echo("deactivated");
				else
					echo("active");
				
				echo('</td><td>
					<button id="mk_'.$row['ID'].'" >make '.$mk.'</button>
				</td>
				<td>');
					if($row['ComCount']>0)
						echo('<button id="rmvcom_'.$row['ID'].'" >remove comments</button>');
					else
						echo('0 Comments');
				echo('</td>
				<td>');
					if($row['Password']=="")
						echo('<button id="ac_'.$row['ID'].'" >aktivate</button>');
					else
						echo('<button id="deac_'.$row['ID'].'" >deactivate</button>');						
				echo('</td>
				<td>
					<button id="rmv_'.$row['ID'].'" >remove</button>
				</td>
			</tr>');
		echo('<script type="text/javascript"">
				$("#rmv_'.$row['ID'].'").button().click(function(){removeUser('.$row['ID'].');});
				$("#rmvcom_'.$row['ID'].'").button().click(function(){removeUserComments('.$row['ID'].');});
				$("#mk_'.$row['ID'].'").button().click(function(){changeULevel('.$row['ID'].','.$mkid.');});
			');
		if($row['Password']=="")
			echo('$("#ac_'.$row['ID'].'").button().click(function(){activateUser('.$row['ID'].');});');
		else
			echo('$("#deac_'.$row['ID'].'").button().click(function(){deactivateUser('.$row['ID'].');});');
		echo('</script>');
	}

	echo('</table></div>
    <div id="c_bottom">
    	<hr />
    </div>
</div>');
mysql_close($con);
}
else{
echo "NULL";	
}
?>