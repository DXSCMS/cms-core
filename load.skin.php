<?php
//echo "_load.skin.php_";
// print_r($_SET);
if( !DXS_isAjax() ){ // print_r( $_CMSSET );
	$skinTemplate = isset($_CMSSKIN["skin-template"])?$_CMSSKIN["skin-template"]:$_CMSSET["skin-template"];
	$_skin_id = isset($_CMSSKIN["skin-id"])?$_CMSSKIN["skin-id"]:$_CMSSET["skin"];

	define("SKIN",SKINS."/".$_skin_id);
	define("iSKIN",$_skin_id);

	define("MEDIASKIN",MEDIASKINS.'/'.$_skin_id);$MEDIASKIN = MEDIASKIN;
	define("HMEDIASKIN",HMEDIASKINS.'/'.$_skin_id);$HMEDIASKIN = HMEDIASKIN;
	@include_once SKINS."/".$_skin_id."/data/skin.info.php";
	@include_once SKINS."/".$_skin_id."/data/skin.data.php";

	if( isset($_SET['error-page']) ){
		if( is_file(SKINS."/".$_skin_id."/skin-templates/error.".$_SET['error-page'].".php") ){
			$_include_file = SKINS."/".$_skin_id."/skin-templates/error.".$_SET['error-page'].".php";
		}else{
			$_include_file = SKINS."/".$_skin_id."/skin-templates/$skinTemplate";
		}
	}else{
		$_include_file = SKINS."/".$_skin_id."/skin-templates/$skinTemplate";
	}
	if(!is_file($_include_file)){
		throw new Exception("Skin Template File Not Found");
	}else{
		include_once $_include_file;
	}
}
?>