<?php
if($_POST){
	//$_SS->st('uPOST',$_POST);unset($_POST);
	$_SS->savePOST();
	header('location:'.$_SERVER['PHP_SELF']);
	exit(0);
}
?>