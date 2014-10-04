<?php include_once 'block.head-title.php';?>
<?php include_once 'block.head-meta.php';?>
<?php 
if(@$_SET["module"] != null){
   if(is_file(MODS."/".$_SET["module"]."/data/module.head.php")){
	  include_once MODS."/".$_SET["module"]."/data/module.head.php";
   }
   
   if($_SET["mod-page"] != null){
	   if(is_file(MODS."/".$_SET["module"]."/".$_SET["mod-page"].".head.php")){
		  include_once MODS."/".$_SET["module"]."/".$_SET["mod-page"].".head.php";
	   }
   }else if($_SET["error-page"] == false){
	   if(is_file(MODS."/".$_SET["module"]."/index.head.php")){
		  include_once MODS."/".$_SET["module"]."/index.head.php";
	   }
   }
   
}
?>
