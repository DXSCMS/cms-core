<?php 
//echo '_core.navigator.php_';

if(isset($_GET['popup'])){$_SET['popup'] = true;}

function fixNavArrJson($arr){//fix stdClass (el json_decode lo lee asi)
	foreach($arr as $key => $it){$ret[$key] = $it;}
	return $ret;
}

function fixNavOrderJson($mods){global $_CMSSET;
	$linkuser = MODULESROL;
	$filejmods = "$linkuser/order.json";
	$jmods = json_decode(file_get_contents($filejmods),true);
	//print_r($jmods);
	$jmods = fixNavArrJson($jmods);
	
	foreach($jmods as $jmod => $name){
		if(isset($mods[$jmod])){$fmods[$jmod]=$mods[$jmod];}
	}
	//print_r($fmods);
	/*
	return $fmods;
	*/
	$rmods = array_merge($fmods,$mods); // return mods
	//print_r($rmods);
	return $rmods;
}


$_login  = $_SESSION[$_CMSSET["idcms"]][$_CMSSET["subdom"]][$_CMSSET["access"]]["_cms_logged"];

$dir=opendir(MODULESROL); 
while ($folder = readdir($dir)){
  if(is_dir(MODULESROL."/".$folder) && $folder != '.' && $folder != '..'){
	 if(is_file(MODULESROL."/".$folder."/data/settings.cms.php")){
		 include(MODULESROL."/".$folder."/data/settings.cms.php");
		 $_shwmod = $MOD_SET["mod-tab-mode"];
		 if(($_shwmod == "on" && $_login) || ($_shwmod == "off" && !$_login) || ($_shwmod == "both") ){
			 
			 unset($MOD_LANG); // *
			 unset($CMS_LANG);
			 
			 @include( MODULESROL."/".$folder."/lang/".$_CMSSET["lang"].".cms.php"); // * only for compatibility
			 @include( MODULESROL."/".$folder."/lang/".$_CMSSET["lang"].".php");
			//echo '_'; print_r($CMS_LANG); echo '_';
			$_LANG_CMS["module"] = $CMS_LANG["module"];
			
			//*
			if(isset($MOD_LANG["mod-title"])){ 
				$name_tab = $MOD_LANG["mod-title"];
			}else 
			//*
			if( isset($CMS_LANG["module"]) ){ 
				$name_tab = $CMS_LANG["module"];
			}else{
				$name_tab = $folder;
			}
			 //echo $name_tab;
			 $cmsNavs[$folder] = $name_tab;
			 
			 
			 if($_SET['cms-module'] == $folder){
				 
				 $thmNavs[$folder] = Array(
										 "a"=>$name_tab,
										 "href" => $_URLCMS->gtLink($folder,false,false),
										 "title"=>$name_tab,"current"=>true
										 );
			 }else{
				 $thmNavs[$folder] = Array(
										"a"=>$name_tab,
										"href"=> $_URLCMS->gtLink($folder,false,false),
										"title"=>$name_tab,"current"=>false
										);
			 }
			 
			 
		 }
		 unset($MOD_SET);
		 unset($MOD_LANG); // *
		 unset($CMS_LANG);
	}
  }
}
closedir($dir);

if($_CMSSET["use-json"]){
	$cmsNavs = fixNavOrderJson($cmsNavs);
}else{
	ksort($cmsNavs); // ASC SORT BY KEY
}

//print_r($navs);
//echo "<br />";
//print_r($thmNavs);

?>