<?php
//echo "_load.preheaders.php_";

if( @$_SET["module"] != null && $_SET['permission'] ){	
	if( is_file( MODULESROL."/".$_SET['module']."/data/module.preh.php" ) ){
		include( MODULESROL."/".$_SET['module']."/data/module.preh.php" );
	}
	if( $_SET["mod-page"] != null ){
		if( is_file( MODULESROL."/".$_SET['module']."/".$_SET['mod-page'].".preh.php" ) ){
			include( MODULESROL."/".$_SET['module']."/".$_SET['mod-page'].".preh.php" );
		}
	}
}

?>