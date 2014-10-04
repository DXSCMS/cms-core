<?php
/*
included for: init.cms.php
*/
//echo "_init.tools.php_";

//include_once CORE."/dxs.redirect.php";
include_once CORE."/tools/dxs.helpers.php";
include_once CORE."/tools/dxs.URLCMS.class.php";	$_URLCMS = new URLCMS();
include_once CORE."/tools/dxs.CMSPERMS.class.php";	$_CMSPERMS = new CMSPERMS();

// Custom Tools //
if( is_file( DATACORE."/init.tools.php" ) ){
	include_once DATACORE."/init.tools.php"; 
}

?>