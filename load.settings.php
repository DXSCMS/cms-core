<?php    
/*
included for: init.cms.php
*/

//echo '_load.config.php_';

include_once $_CMS["settings"]["role-sett"];
//include_once $_CMS["settings"]["cms-sett"];

$_CMSSET = $_CMS["settings"]; 
//$_CMSSET = array_merge_recursive($_CMSSET,$_CMS["settings"]);
unset($_CMS["settings"]);// print_r($_CMSSET);

/*
define("SKIN",SKINS."/".$_CMSSET["skin"]);
define("iSKIN",$_CMSSET["skin"]);

define("MEDIASKIN",MEDIASKINS.'/'.$_CMSSET["skin"]);$MEDIASKIN = MEDIASKIN;
define("HMEDIASKIN",HMEDIASKINS.'/'.$_CMSSET["skin"]);$HMEDIASKIN = HMEDIASKIN;
*/

$_SET["self"] = $_CMSSET["root-file"].".".$_CMSSET["page-ext"];

?>