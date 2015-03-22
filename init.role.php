<?php
//session_start();
//define('ROOTPATH', dirname(dirname(__FILE__))); 

/*
included for: init.cms.php
*/

//echo '_init.role.php_';

include_once CORE."/init.session.php";
include_once CORE."/load.settings.php";

$_SS->st("_cms_req-login",$_CMSSET["req-login"]);
if( !$_CMSSET["req-login"] ){ $_SS->st("_cms_logged",true); }

if(isset($_REQUEST[ $_CMSSET["logout-handler"] ])){
	include CORE."/core.logout.php";
	exit(0);
}

include_once CORE."/load.lang-cms.php";
include_once CORE."/load.module-settings.php";
//print_r($_CMSSET);
//print_r($MOD_SET);
if( isset($MOD_SET["mod-req-login"]) ){ $_SS->st("_cms_mod-req-login", $MOD_SET["mod-req-login"] ); }else{ $_SS->st("_cms_mod-req-login", false);}
if($_CMSSET["req-login"] || @$MOD_SET["mod-req-login"]){
	
	include_once CORE."/core.login-eval.php";
	include CORE."/core.login.php";
}

?>
