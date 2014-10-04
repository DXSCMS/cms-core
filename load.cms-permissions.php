<?php

if( $_CMSPERMS->loadModulePermissions() ){
	$_SET['permission'] = $_CMSPERMS->hasToPage();
	if(! $_SET['permission'] ){		
		$_SET['cms-module'] = null;
		$_SET["error-page"] = '500';
		
		if( DXS_isAjax() ){
			echo $_CMSLNG["access-restricted"];
			exit();
		}
	}
}else{
	$_SET['permission'] = true; // Don't Support Permissions
}

?>