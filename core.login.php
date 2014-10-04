<?php
//echo "_core.login.php_";

if( !$_SS->gt("_cms_logged") && DXS_isAjax() ){
	if( $_SS->gt("_cms_ses-exp") ){
		echo $_CMSLNG["session-expired"];
	}else{
		echo $_CMSLNG["not-logged"];
	}
	exit();
}

if( $_SS->gt("_cms_ses-exp") ){

	$_SS->nst("_cms_login-error");
	$_SS->nst("_cms_login-error-msg");
	$_SS->st ("_cms_ses-exp",false);
}

$_SS->st("_cms_login-error",false);

if( ($_SS->ist("_cms_logged") && $_SS->gt("_cms_logged")) || $_SS->gt("_cms_ses-exp-bg") ){
	if( $_SS->ist("_cms_tlog")) if( time() - $_SS->gt("_cms_tlog") > $_CMSSET["timemax-log"] ){

		$_SS->st("_cms_logged",false);
		$_SS->st("_cms_login-error",true);
		$_SS->st("_cms_login-error-msg",$_CMSLNG["session-expired"]);
		$_SS->st("_cms_ses-exp",true);
		$_SS->st("_cms_ses-exp-bg",false);
	}
}

include LOGIN."/".$_CMSSET["login-eval"];

if( isset($_REQUEST['login']) && !$_SS->gt("_cms_logged") ){
	if( validaLogin() ){
		
		$_SS->st("_cms_logged",true);
		$_SS->st("_cms_tlog",time());
		
		$_SS->nst("_cms_login-attempts");
		$_SS->nst("_cms_login-error");
		$_SS->nst("_cms_login-error-msg");
		$_SS->nst("_cms_login-error-type");
		
		if($_SS->ist("_cms_login-redirect")){
			$redirect = $_SS->gt("_cms_login-redirect",true);			
		}else{
			$redirect = $_SET["self"];
		}
		header("Location: $redirect");
	}else{
		$_SS->up("_cms_login-attempts");		
	}
}

if( $_SS->mpty("_cms_login-attempts") && !$_SS->gt("_cms_logged") ){
	$_SS->st("_cms_login-attempts",0);
}
//print_r($_SESSION);

if( !$_SS->gt("_cms_logged") ){
	
	$_SS->st( "_cms_login-redirect" , $_URLCMS->gtLinkCurrent() );	
	include CORE.'/load.login.php';
	exit();
}else{
	$_SS->st("_cms_tlog",time());
	$_SS->st("_cms_ses-exp",false);
}

?>