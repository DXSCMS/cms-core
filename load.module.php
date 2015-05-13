<?php
/*
included for: init.cms.php
*/

//echo "_load.module.php_";

if($_SET["set-module"]){
	//echo 'module is setted...';
	$_module = $_SET["cms-module"];

	$_login  = $_SS->gt("_cms_logged");
	$_shwmod = $_SET["mod-show-mode"];
	 if( ($_shwmod == "on" && $_login) || ($_shwmod == "off" && !$_login) || ($_shwmod == "both") ){ // module on
	 
		if(is_dir(MODULESROL."/".$_module )){ // exist module folder		
			$_SET["module"] = $_module;	//echo 'module-preheader found...';				
			if(!$_SET['set-page']){	//echo 'page not is setted...';
				if(isset($_REQUEST[$_CMSSET['page-handler']])){						
					$_page = $_REQUEST[ $_CMSSET['page-handler'] ];					
					 if(is_file(MODULESROL."/".$_module."/".$_page.".body.php")){ // exists page file													
						$_SET["mod-page"] = $_page;

						$_SET["set-page"] = true;
						$_SET["cms-page"] = $_page;
						
						$_SET["error-page"] = null;
					 }else{ // not exists page file
						$_SET["mod-page"] = null;
						
						$_SET["set-page"] = true;
						$_SET["cms-page"] = null;
						
						$_SET["error-page"] = "404";
					 }
				}else{
					if(is_file(MODULESROL."/".$_module."/index.body.php")){ // exists index							
						$_SET["mod-page"] = 'index';
						
						$_SET["set-page"] = false;
						$_SET["cms-page"] = 'index';
						
						$_SET["error-page"] = null;
					 }else{ // not exists index						
						$_SET["mod-page"] = null;
						
						$_SET["set-page"] = false;
						$_SET["cms-page"] = null;
						
						$_SET["error-page"] = "404";
					}
				}											
			}else{
				//echo 'page is setted...';
				$_page = $_SET["cms-page"];
				if(is_file(MODULESROL."/".$_module."/".$_page.".body.php")){ //exist page file
					$_SET["mod-page"] = $_page;
				}else
				if(is_file(MODULESROL."/".$_module."/index.body.php")){ // exist index										
					$_SET["mod-page"] = 'index';
					
					$_SET["set-page"] = true;
					$_SET["cms-page"] = 'index';
				}else{
					$_SET["mod-page"] = null;
					$_SET["set-page"] = false;
				}			
			}
			
		}else{
			//echo 'module-preheader not found...';			
			$_SET["module"] = null;
			$_SET["set-module"] = false;
		}		
	 }else if($_SET["mod-show-mode"] == "null"){
		$_SET["module"] = null;
		$_SET["set-module"] = false;
	 }else if( !isset($_SET["mod-show-mode"]) ){
		
	 }else{
		header("Location: ".$_CMSURL->to().'');
	 }
}
//echo '$_SET["cms-module"]:'.$_SET["cms-module"].'...';
//echo '$_SET["cms-page"]:'.$_SET["cms-page"].'...';
?>