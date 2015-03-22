<?php

//echo '_load.module-settings.php_';

/*
included for: init.role.php
*/

//$_SET["module"] = false;
if(!isset($_SET['set-module'])){
	$_SET['set-module'] = false;
	$_SET['cms-module'] = null;
}
if(!isset($_SET['set-page'])){
	$_SET['set-page'] = false;
	$_SET['cms-page'] = null;
}

/*
$_SET["set-module"] = true;
$_SET["cms-module"] = 'free-mod';
$_SET["set-page"] = true;
$_SET["cms-page"] = 'nuevo';
*/

if(!$_SET["set-module"]){

	if(isset($_REQUEST[$_CMSSET['module-handler']]) && $_REQUEST[$_CMSSET['module-handler']] !=""){
		$_SET['set-module'] = true;

		$_module = $_REQUEST[$_CMSSET['module-handler']];
		
		if(is_dir(MODULESROL."/".$_module)){
			
			/* Load Module Settings */
			//$MOD_SET = Array();
			include_once MODULESROL."/".$_module."/data/settings.php";
			include_once MODULESROL."/".$_module."/data/settings.cms.php";

			//$_SET = $_SET + $MOD_SET;

			//$_SET = array_replace_recursive($_SET,$MOD_SET); // Use in PHP 5.3
			$_SET = array_merge($_SET,$MOD_SET);			

			//$_SET["module"] = true;
			//$_SET['set-module'] = true;
			$_SET['cms-module'] = $_module;
			
			define("MOD",$_module);
			define("MODULE",$_module); /* Best */
			
			$_module_cms = MODULESROL."/".$_module;
			define("MODULECMS",$_module_cms); /* New */
			
			/* Load Module Lang */
			if( is_file(MODULESROL."/".$_module."/lang/".$_CMSSET["lang"].".cms.php") ){
				include_once MODULESROL."/".$_module."/lang/".$_CMSSET["lang"].".cms.php";				
				if( !isset($_LANG_CMS) || !is_array($_LANG) ){ $_LANG = array(); }
				//@$_LANG = array_replace_recursive($_LANG,$MOD_LANG);  // Use in PHP 5.3				
				@$_LANG = array_merge($_LANG,$MOD_LANG);				
			}
			if( is_file(MODULESROL."/".$_module."/lang/".$_CMSSET["lang"].".php") ){
				include_once MODULESROL."/".$_module."/lang/".$_CMSSET["lang"].".php";
				if( !isset($_LANG_CMS) || !is_array($_LANG_CMS) ){ $_LANG_CMS = array(); }				
				//@$_LANG_CMS = array_replace_recursive($_LANG_CMS,$CMS_LANG);  // Use in PHP 5.3
				@$_LANG_CMS = array_merge($_LANG_CMS,$CMS_LANG);		
				unset($CMS_LANG);
			}						
			//print_r($MOD_SET);
		}		
	}
	
	if(! isset($_REQUEST[$_CMSSET['module-handler']]) ){
		if( $_CMSSET['def-mod'] ){
			$_SET['set-module'] = true;
			$_SET['cms-module'] = $_CMSSET['def_mod'];
			if( $_SS->gt("_cms_logged") ){
				$redirect = $_URLCMS->gtLink( $_CMSSET["def-module"] , false , false );	//echo '$redirect:'.$redirect ;
				header("Location: $redirect");
				exit(0);
			}
		}
	}

}else{
	$_module = $_SET['cms-module'];
	
	if(is_dir(MODULESROL."/".$_module)){
	
		/* Load Module Settings */
		//$MOD_SET = Array();
		include_once MODULESROL."/".$_module."/data/settings.php";
		include_once MODULESROL."/".$_module."/data/settings.cms.php";
		//$_SET = $_SET + $MOD_SET;
		
		$_SET = array_merge_recursive($_SET,$MOD_SET);
		
		//$_SET["module"] = true;
		$_SET["set-module"] = true;
		$_SET["cms-module"] = $_module;
		
		define("MOD",$_module);
		
		/* Load Module Lang */
		include_once MODULESROL."/".$_module."/lang/".$_CMSSET["lang"].".php";
		//$_LANG = $_LANG + $MOD_LANG;
		$_LANG = array_merge_recursive($_LANG,$MOD_LANG);		
		//print_r($MOD_SET);		
	}
}


?>