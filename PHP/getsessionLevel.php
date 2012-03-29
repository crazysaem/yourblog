<?php session_start(); ?>
<?php
if(isset($_SESSION['Level'])){
	echo ($_SESSION['Level']);
}
else{
	echo ("NULL");
	}
?>