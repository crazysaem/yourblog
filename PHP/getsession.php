<?php session_start(); ?>
<?php
if(isset($_SESSION['ID'])){
	echo $_SESSION['ID'];
}
else{
	echo ("NULL");
	}
?>