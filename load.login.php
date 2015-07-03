<?php
if( !DXS_isAjax() ){
	if( !isset($_CMSSET["skin"]) || !is_dir(SKINS."/".$_CMSSET["skin"]) ){
		throw new Exception("Skin Folder Not Found");
	}

	define("SKIN",SKINS."/".$_CMSSET["skin"]);
	define("iSKIN",$_CMSSET["skin"]);

	define("MEDIASKIN",MEDIASKINS.'/'.$_CMSSET["skin"]);$MEDIASKIN = MEDIASKIN;
	define("HMEDIASKIN",HMEDIASKINS.'/'.$_CMSSET["skin"]);$HMEDIASKIN = HMEDIASKIN;

	@include_once SKINS."/".$_CMSSET["skin"]."/data/skin.info.php";
	@include_once SKINS."/".$_CMSSET["skin"]."/data/skin.data.php";
	
	$loginTemplate = $_CMSSET["login-template"];
	if( is_file(SKINS."/".$_CMSSET["skin"]."/login-templates/".$loginTemplate) ){		
		include SKINS."/".$_CMSSET["skin"]."/login-templates/".$loginTemplate;
	}else{
		throw new Exception("Login Template Not Found");
	}
}else{
	echo json_encode($CMS_AJAX_RESPONSE);exit;
}	
?>