<?php
/*
included for: init.cms.php
*/
//echo "_init.tools.php_";

//include_once CORE."/dxs.redirect.php";
include_once CORE."/tools/dxs.helpers.php";
include_once CORE."/tools/dxs.URLCMS.class.php";			$_URLCMS = new URLCMS();
include_once CORE."/tools/dxs.CMSPermissions.class.php";	$CMSPermissions = $_CMSPermissions = new CMSPermissions();$_CMSPERMS = $_CMSPermissions;
include_once CORE."/tools/dxs.CMSURL.class.php";			$CMSURL = $_CMSURL = new CMSURL();
include_once CORE."/tools/dxs.CMSInput.class.php";			$CMSInput = $_CMSInput = new CMSInput();
include_once CORE."/tools/dxs.CMSLanguage.class.php";		$CMSLanguage = $_CMSLanguage = new CMSLanguage();$_CMSLang = $_CMSLanguage;

// Custom Tools //
if( is_file( DATACORE."/init.tools.php" ) ){
	include_once DATACORE."/init.tools.php"; 
}

?>