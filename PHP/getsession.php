<?php session_start(); ?>
<?php
if(isset($_SESSION['ID'])){
	echo ("ID = "+$_SESSION['ID']);
}
else{
	echo ("NULL");
	}
?>