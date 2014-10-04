<?php
if( $_SS->ist("_cms_logged") && $_SS->gt("_cms_logged") ){
	if( time() - $_SS->gt("_cms_tlog") > $_CMSSET["timemax-log"] ){
		$_SS->st("_cms_logged",false);
		$_SS->st("_cms_login-error",true);
		$_SS->st("_cms_login-error-msg",$_CMSLNG["session-expired"]);
		$_SS->st("_cms_ses-exp",true);
		$_SS->st("_cms_ses-exp-bg",true);
	}
}
?>