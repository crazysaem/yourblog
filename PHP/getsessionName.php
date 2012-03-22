<?php session_start(); ?>
<?php
if(isset($_SESSION['Name'])){
	echo ($_SESSION['Name']);
}
else{
	echo ("NULL");
	}
?>