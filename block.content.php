<?php
//echo "_block.content.php_";

if( !$_SET['set-module'] ){ //echo 'module no setted, 4theme...';
	include MODULESROL."/welcome.php";
}else{
	
	if( $_SET['cms-module'] ){
		if( $_SET['cms-page'] ){
			include_once MODULESROL."/".$_SET["cms-module"]."/".$_SET["cms-page"].".body.php";
		}
	}
	
	if( $_SET["error-page"] ){
		if( is_file( MODULESROL."/error.".$_SET['error-page'].".php" ) ){
			include_once MODULESROL."/error.".$_SET['error-page'].".php";
		}
	}
}
?>
