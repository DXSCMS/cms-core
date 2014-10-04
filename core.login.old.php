<?php

if( !$_SESSION[$_CMSSET["idcms"]][$_CMSSET["subdom"]][$_CMSSET["access"]]["login"] && $_POST['mode']=='ajax'){
	if($_SESSION[$_CMSSET["idcms"]][$_CMSSET["subdom"]][$_CMSSET["access"]]["ses-exp"]){
		echo "Sesion Expirada!";
	}else{
		echo "Sesion no Iniciada!";
	}
	exit();
}
		
if($_SESSION[$_CMSSET["idcms"]][$_CMSSET["subdom"]][$_CMSSET["access"]]["ses-exp"]){
	unset($_SESSION[$_CMSSET["idcms"]][$_CMSSET["subdom"]][$_CMSSET["access"]]["log-error"]);
	unset($_SESSION[$_CMSSET["idcms"]][$_CMSSET["subdom"]][$_CMSSET["access"]]["log-error-msg"]);
	$_SESSION[$_CMSSET["idcms"]][$_CMSSET["subdom"]][$_CMSSET["access"]]["ses-exp"] = false;
}


$_SESSION[$_CMSSET["idcms"]][$_CMSSET["subdom"]][$_CMSSET["access"]]["mpass_msg"] = "";
$_SESSION[$_CMSSET["idcms"]][$_CMSSET["subdom"]][$_CMSSET["access"]]["log-error"] = false;	

if( isset($_SESSION[$_CMSSET["idcms"]][$_CMSSET["subdom"]][$_CMSSET["access"]]["login"]) && $_SESSION[$_CMSSET["idcms"]][$_CMSSET["subdom"]][$_CMSSET["access"]]["login"]){
	if( time() - $_SESSION[$_CMSSET["idcms"]][$_CMSSET["subdom"]][$_CMSSET["access"]]["tlog"] > $_CMSSET["timemax-log"] ){
		//session expired;
		$_SESSION[$_CMSSET["idcms"]][$_CMSSET["subdom"]][$_CMSSET["access"]]["login"] = false;
		$_SESSION[$_CMSSET["idcms"]][$_CMSSET["subdom"]][$_CMSSET["access"]]["log-error"] = true;
		$_SESSION[$_CMSSET["idcms"]][$_CMSSET["subdom"]][$_CMSSET["access"]]["log-error-msg"] = $_CMSLNG["session-expired"];
		$_SESSION[$_CMSSET["idcms"]][$_CMSSET["subdom"]][$_CMSSET["access"]]["ses-exp"] = true;
	}
}

//print_r($_CMSSET);echo "<br />";

include CORE."/login/".$_CMSSET["login_inc"];

if( isset($_REQUEST['login']) && !$_SESSION[$_CMSSET["idcms"]][$_CMSSET["subdom"]][$_CMSSET["access"]]["login"] )
{
	if( validaLogin() ){
		$_SESSION[$_CMSSET["idcms"]][$_CMSSET["subdom"]][$_CMSSET["access"]]["tlog"] = time();
		header("Location:".$_SET["self"]);
	}else{
		//echo 'error login';
	}
}

if(empty($_SESSION[$_CMSSET["idcms"]][$_CMSSET["subdom"]][$_CMSSET["access"]]["mpass_attempts"])){
	$_SESSION[$_CMSSET["idcms"]][$_CMSSET["subdom"]][$_CMSSET["access"]]["mpass_attempts"] = 0;
}
//print_r($_SESSION);
if(!$_SESSION[$_CMSSET["idcms"]][$_CMSSET["subdom"]][$_CMSSET["access"]]["login"]){

	$_SESSION[$_CMSSET["idcms"]][$_CMSSET["subdom"]][$_CMSSET["access"]]["mpass_attempts"]++;
	include(SKINS."/".$_CMSSET["skin"]."/login/".$_CMSSET["login_skin"]);
	exit();
}else{
	$_SESSION[$_CMSSET["idcms"]][$_CMSSET["subdom"]][$_CMSSET["access"]]["tlog"] = time();
	$_SESSION[$_CMSSET["idcms"]][$_CMSSET["subdom"]][$_CMSSET["access"]]["ses-exp"] = false;
}

?>