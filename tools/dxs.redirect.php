<?php

//echo "_tool.redirect.php_";

function CMSTOOL_makeLink($module,$page,$vars = null){
	global $_CMSSET;
	if($vars != null){
		foreach($vars as $id => $var){
			$query[] = $id."=".$var;
		}
		$query_string = implode('&',$query);
	}
	$url  = $_CMSSET["root-file"].".php";
	$url .= "?".$_CMSSET['module-handler']."=".$module;
	$url .= "&".$_CMSSET['page-handler']."=".$page;
	if($vars != null){
		$url .= "&".$query_string;
	}
	return $url;
}

?>